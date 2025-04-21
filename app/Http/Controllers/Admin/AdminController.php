<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        $categoryCount = CategoryProduct::count();
        $orderCount = Order::count();
        $productCount = Product::count();
        $newsCount = News::count();

        $ordersByMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->pluck('total', 'month')->toArray();

        // Khởi tạo mảng 12 tháng với giá trị 0
        $monthlyOrders = array_fill(1, 12, 0);

        // Gán giá trị đơn hàng vào mảng theo tháng
        foreach ($ordersByMonth as $month => $total) {
            $monthlyOrders[$month] = $total;
        }


        $revenueByMonth = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('revenue', 'month')->toArray();

        // Tạo mảng đủ 12 tháng, nếu tháng nào chưa có dữ liệu thì mặc định là 0
        $monthlyRevenue = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyRevenue[$i] = $revenueByMonth[$i] ?? 0;
        }

        $orderStatuses = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();

        return view('admin.dashboard', compact('orderStatuses','revenueByMonth','monthlyOrders', 'categoryCount', 'orderCount', 'productCount', 'newsCount'));

    }
}
