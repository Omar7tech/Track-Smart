<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * Display detailed user statistics.
     *
     * @return \Illuminate\View\View
     */
    public function users()
    {
        // Total users
        $totalUsers = User::count();

        // Users by role
        $rolesCount = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role');

        // Latest users
        $latestUsers = User::orderBy('created_at', 'desc')->limit(5)->get();

        // Monthly registration trends for the past year
        $registrationTrends = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        return view('analyst.users', compact(
            'totalUsers',
            'rolesCount',
            'latestUsers',
            'registrationTrends'
        ));
    }

    public function categories()
    {
        // Total number of categories
        $totalCategories = Category::count();

        // Top 5 categories by product count
        $topCategories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->limit(5)
            ->get();

        // Data for top categories (chart)
        $topCategoriesChartData = $topCategories->map(function ($category) {
            return [
                'label' => $category->name,
                'count' => $category->products_count
            ];
        });

        // Total prices of each category
        $categoryPrices = Category::withSum('products', 'price')
            ->get()
            ->map(function ($category) {
                return [
                    'label' => $category->name,
                    'total_price' => $category->products_sum_price ?? 0
                ];
            });

        // Data for category distribution (chart)
        $categoryDistributionData = Category::withCount('products')
            ->get()
            ->map(function ($category) {
                return [
                    'label' => $category->name,
                    'count' => $category->products_count
                ];
            });

        // Average products per category
        $totalProducts = Product::count();
        $averageProductsPerCategory = $totalCategories > 0 ? round($totalProducts / $totalCategories, 2) : 0;

        return view('analyst.categories', compact(
            'totalCategories',
            'topCategoriesChartData',
            'categoryPrices',
            'categoryDistributionData',
            'averageProductsPerCategory',
            'totalProducts'
        ));
    }

    public function products()
    {
        // Total number of products
        $totalProducts = Product::count();

        // Products by category
        $productsByCategory = Product::select('category_id', DB::raw('count(*) as count'))
            ->groupBy('category_id')
            ->with('category')
            ->get();

        // Total sales per product
        $salesPerProduct = Product::select('products.id', 'products.name', DB::raw('SUM(sales.total) as total_sales'))
            ->join('sales', 'products.id', '=', 'sales.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();


        // Top 5 products by stock quantity
        $topProductsByStock = Product::orderByDesc('quantity')
            ->take(5)
            ->get();

        // Average cost and price
        $averageCostPrice = Product::selectRaw('AVG(cost) as average_cost, AVG(price) as average_price')
            ->first();

        // Prepare data for the chart (Products by Category)
        $productsByCategoryData = $productsByCategory->map(function ($category) {
            return [
                'label' => $category->category->name,
                'count' => $category->count
            ];
        });

        return view('analyst.products', compact(
            'totalProducts',
            'productsByCategoryData',
            'salesPerProduct',
            'topProductsByStock',
            'averageCostPrice'
        ));
    }

    public function money()
    {
        // Total revenue generated from all sales
        $totalRevenue = Sale::sum('total') ?? 0;

        // Most sold product by total revenue (sum of total sales)
        $mostSoldProduct = Product::select('products.id', 'products.name', DB::raw('SUM(sales.total) as total_revenue'))
            ->join('sales', 'products.id', '=', 'sales.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_revenue')
            ->first();

        // Highest profit product based on cost and price
        $highestProfitProduct = Product::select('products.id', 'products.name', DB::raw('SUM(sales.total - (products.cost * sales.quantity)) as profit'))
            ->join('sales', 'products.id', '=', 'sales.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('profit')
            ->first();

        // Lowest profit product based on cost and price
        $lowestProfitProduct = Product::select('products.id', 'products.name', DB::raw('SUM(sales.total - (products.cost * sales.quantity)) as profit'))
            ->join('sales', 'products.id', '=', 'sales.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderBy('profit')
            ->first();

        // Top 5 most profitable products
        $mostProfitableProducts = Product::select('products.id', 'products.name', DB::raw('SUM(sales.total - (products.cost * sales.quantity)) as profit'))
            ->join('sales', 'products.id', '=', 'sales.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('profit')
            ->limit(5)
            ->get();

        // Top 5 least profitable products
        $leastProfitableProducts = Product::select('products.id', 'products.name', DB::raw('SUM(sales.total - (products.cost * sales.quantity)) as profit'))
            ->join('sales', 'products.id', '=', 'sales.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderBy('profit')
            ->limit(5)
            ->get();

        // Top 10 products by profit percentage (Profit Percentage = (Profit / Cost) * 100)
        $top10ProfitPercentageProducts = Product::select(
            'products.id',
            'products.name',
            DB::raw('SUM(sales.total - (products.cost * sales.quantity)) as profit'),
            DB::raw('SUM(products.cost * sales.quantity) as total_cost'),
            DB::raw('((SUM(sales.total - (products.cost * sales.quantity)) / SUM(products.cost * sales.quantity)) * 100) as profit_percentage')
        )
            ->join('sales', 'products.id', '=', 'sales.product_id')
            ->groupBy('products.id', 'products.name')
            ->having('profit', '>', 0) // To ensure we're only showing profitable products
            ->orderByDesc('profit_percentage')
            ->limit(10)
            ->get();

        return view('analyst.money', compact(
            'totalRevenue',
            'mostSoldProduct',
            'highestProfitProduct',
            'lowestProfitProduct',
            'mostProfitableProducts',
            'leastProfitableProducts',
            'top10ProfitPercentageProducts'
        ));
    }

    public function stock()
    {
        // Fetch the highest and lowest stock quantity products
        $mostStockedProduct = Product::orderBy('quantity', 'desc')->first();
        $leastStockedProduct = Product::orderBy('quantity')->first();

        // Fetch top 5 products with stock less than 10
        $lowStockProducts = Product::where('quantity', '<', 10)
            ->orderBy('quantity')
            ->limit(5)
            ->get();

        return view('analyst.stock', compact(
            'mostStockedProduct',
            'leastStockedProduct',
            'lowStockProducts'
        ));
    }


    public function expiry(Request $request)
    {
        // Base query for products with an expiry date
        $query = Product::query();

        // Filter by expiry date if provided
        if ($request->filled('expiry_date')) {
            $query->where('expiry_date', '<=', $request->expiry_date);
        }

        // Fetch expired products
        $expiredProducts = $query->where('expiry_date', '<=', now())->get();

        // Fetch total expired product count
        $totalExpired = $expiredProducts->count();

        // Calculate soon-to-expire products (within 30 days)
        $soonToExpireProducts = Product::whereBetween('expiry_date', [now(), now()->addDays(30)])->get();
        $soonToExpireCount = $soonToExpireProducts->count();

        return view('analyst.expiry', compact('expiredProducts', 'totalExpired', 'soonToExpireProducts', 'soonToExpireCount'));
    }
    // Method to generate PDF for low-stock products

    public function printLowStockPDF()
    {

        // Fetch low stock products with pagination

        $lowStockProducts = Product::where('quantity', '<', 10)
            ->orderBy('quantity')
            ->paginate(10);
        $pdf = app('dompdf.wrapper');

        $pdf->loadView('analyst.low_stock_pdf', compact('lowStockProducts'));

        return $pdf->download('low_stock_products.pdf');

    }

    public function printExpiredProductsPDF()
    {
        // Fetch expired products with pagination
        $expiredProducts = Product::where('expiry_date', '<=', now())
            ->orderBy('expiry_date')
            ->paginate(10);

        $pdf = app('dompdf.wrapper');

        // Load the view with expired products
        $pdf->loadView('analyst.expired_products_pdf', compact('expiredProducts'));

        return $pdf->download('expired_products.pdf');
    }

    public function reports()
    {
        return view('analyst.reports');
    }


    public function generateComprehensiveReport()
    {
         // 1. User Data
         $totalUsers = User::count();
         $usersByRole = User::select('role', DB::raw('count(*) as count'))
                             ->groupBy('role')
                             ->pluck('count', 'role');
         $newUsersLastMonth = User::where('created_at', '>', now()->subMonth())->count();
         $activeUsersLastMonth = User::whereHas('sales', function($query) {
             $query->where('created_at', '>', now()->subMonth());
         })->count();

         // 2. Sales Data
         $totalSales = Sale::sum('total');
         $totalRevenue = Sale::sum('total');
         $averageSalePerUser = Sale::join('users', 'sales.user_id', '=', 'users.id')
                                     ->select(DB::raw('avg(sales.total) as avg_sale'))
                                     ->first()->avg_sale;
         $topSellingProducts = Product::select('name', DB::raw('sum(sales.total) as total_sales'))
                                      ->join('sales', 'products.id', '=', 'sales.product_id')
                                      ->groupBy('products.name')
                                      ->orderBy('total_sales', 'desc')
                                      ->limit(5)
                                      ->get();
         $salesByCategory = Sale::join('products', 'sales.product_id', '=', 'products.id')
                                ->join('categories', 'products.category_id', '=', 'categories.id')
                                ->select('categories.name as category_name', DB::raw('sum(sales.total) as total_sales'))
                                ->groupBy('categories.name')
                                ->get();

         // 3. Product Health Data
         $lowStockProducts = Product::where('quantity', '<', 10)->get();
         $expiredProducts = Product::where('expiry_date', '<', now())->get();
         $productCostVsPrice = Product::select('name', 'cost', 'price', DB::raw('price - cost as profit_margin'))->get();

         // 4. Financial Data
         $grossMargin = $totalRevenue - Sale::join('products', 'sales.product_id', '=', 'products.id')
                                           ->sum(DB::raw('sales.quantity * products.cost'));
         $yearlySalesGrowth = Sale::whereYear('created_at', now()->year)->sum('total') - Sale::whereYear('created_at', now()->subYear()->year)->sum('total');

         // Prepare all data to be passed to the PDF view
         $data = [
             'totalUsers' => $totalUsers,
             'usersByRole' => $usersByRole,
             'newUsersLastMonth' => $newUsersLastMonth,
             'activeUsersLastMonth' => $activeUsersLastMonth,
             'totalSales' => $totalSales,
             'totalRevenue' => $totalRevenue,
             'averageSalePerUser' => $averageSalePerUser,
             'topSellingProducts' => $topSellingProducts,
             'salesByCategory' => $salesByCategory,
             'lowStockProducts' => $lowStockProducts,
             'expiredProducts' => $expiredProducts,
             'productCostVsPrice' => $productCostVsPrice,
             'grossMargin' => $grossMargin,
             'yearlySalesGrowth' => $yearlySalesGrowth,
             'currentDate' => now()->toDateString()
         ];

        // Generate the PDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('analyst.comprehensive_report', $data);

        return $pdf->download("Advanced_Statistical_Report_".now()->format('Y-m-d').".pdf");
    }

}

