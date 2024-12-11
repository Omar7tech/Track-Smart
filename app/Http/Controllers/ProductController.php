<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get all categories for the dropdown
        $categories = Category::all();

        // Query the products with optional search and category filters
        $query = Product::query()->with("category");

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')->orWhere('barcode', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(10); // Adjust the number per page as needed
        return view('employee.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('employee.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'barcode' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'nullable|date',
            'cost' => 'required|decimal:0,4|min:0',
            'price' => 'required|decimal:0,4|min:0',
        ]);

        // Store the product
        Product::create($validated);

        // Redirect to the products index page
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Show the details of a specific product.
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('employee.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $categories = Category::all(); // Fetch all categories
        return view('employee.products.edit', compact('product', 'categories'));
    }
    /**
     * Update the specified product in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'barcode' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'nullable|date',
            'cost' => 'required|decimal:0,4|min:0',
            'price' => 'required|decimal:0,4|min:0',
        ]);

        // Update the product with validated data
        $product->update($validated);

        // Redirect back with success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified product from the database.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function stockIndex(Request $request)
    {
        // Fetch products with optional search filter
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('barcode', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12); // Adjust pagination as needed

        return view('employee.stock.index', compact('products'));
    }

    public function addStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product->increment('quantity', $validated['quantity']);

        return redirect()->back()->with('success', 'Stock added successfully.');
    }

    public function minusStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($product->quantity < $validated['quantity']) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        $product->decrement('quantity', $validated['quantity']);

        return redirect()->back()->with('success', 'Stock reduced successfully.');
    }

    public function resetStock(Product $product)
    {
        $product->update(['quantity' => 0]);

        return redirect()->back()->with('success', 'Stock reset to zero successfully.');
    }
}
