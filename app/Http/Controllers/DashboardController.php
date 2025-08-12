<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct() 
    {
        $this->middleware('locale');
    }

    public function index() 
    {
        $year = Carbon::now()->year;

        $orders = Order::all();
        $ordersStatsByMonth = DB::table(DB::raw('
                (SELECT 1 as month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
                UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) months
            '))
            ->leftJoin('orders', function ($join) use ($year) {
                $join->on(DB::raw('MONTH(orders.created_at)'), '=', 'months.month')
                    ->whereYear('orders.created_at', $year);
            })
            ->select(
                'months.month',
                DB::raw('COUNT(orders.id) as total_orders'),
                DB::raw('SUM(CASE WHEN orders.order_status = "delivered" THEN 1 ELSE 0 END) as total_delivered')
            )
            ->groupBy('months.month')
            ->orderBy('months.month')
            ->get();

        $topproducts = Product::select('products.id', 'products.name', 'products.image', DB::raw('SUM(order_items.quantity) as total_ordered'))
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_ordered')
            ->limit(6)
            ->get();
        $topcompanies = Company::select('companies.id', 'companies.name', 'companies.logo', 'companies.contact', DB::raw('COUNT(orders.id) as total_orders'))
            ->join('users', 'users.company_id', '=', 'companies.id')
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->groupBy('companies.id', 'companies.name')
            ->orderByDesc('total_orders')
            ->limit(6)
            ->get();

        return view('dashboard', compact('orders', 'topcompanies', 'topproducts', 'ordersStatsByMonth'));
    }
}
