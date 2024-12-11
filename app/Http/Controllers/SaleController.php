<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{


    public function create(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $product->quantity,
            ],
        ]);

        $totalPrice = $product->price * $validated['quantity'];

        // Reduce stock in the product table
        $product->decrement('quantity', $validated['quantity']);

       
        // Create a sale record
        Sale::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'total' => $totalPrice,
        ]);

        return redirect()->back()->with('success', 'Sale recorded successfully!');
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sale::where('user_id', Auth::id());

        // Apply date filters if provided
        if ($startDate = $request->get('start_date')) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate = $request->get('end_date')) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $sales = $query->paginate();

        // Calculate statistics
        $totalSales = $query->count();
        $totalRevenue = $query->sum('total');
        $averageSaleValue = $totalSales > 0 ? $totalRevenue / $totalSales : 0;

        return view('employee.sales.index', compact('sales', 'totalSales', 'totalRevenue', 'averageSaleValue'));
    }



    public function printSalePdf(Sale $sale)
{
    $pdf = app('dompdf.wrapper');
    $pdf->loadView('employee.sales.sale_pdf', compact('sale'));
    return $pdf->download('sale_' . $sale->id . '.pdf');
}
    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
