<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\TelegramService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function index(Request $request)
    {
        // Bắt đầu query từ model Order
        $query = Order::query();

        // Lọc theo trạng thái nếu có
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Lọc theo khoảng thời gian nếu có
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Lọc theo số điện thoại nếu có
        if ($request->has('billing_phone') && $request->billing_phone) {
            $query->where('billing_phone', 'like', '%' . $request->billing_phone . '%');
        }

        // Lọc theo email nếu có
        if ($request->has('billing_email') && $request->billing_email) {
            $query->where('billing_email', 'like', '%' . $request->billing_email . '%');
        }

        // Lọc theo tên khách hàng nếu có
        if ($request->has('billing_name') && $request->billing_name) {
            $query->where('billing_name', 'like', '%' . $request->billing_name . '%');
        }

        // Sắp xếp theo ngày tạo mới nhất và phân trang
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        // Trả về view kèm theo các giá trị đã lọc để form giữ nguyên giá trị
        return view('admin.orders.index', compact('orders'));
    }


    public function show($id)
    {
        $order = Order::findOrFail($id); // Lấy chi tiết đơn hàng
        $orderItems = OrderItem::where('order_id', $id)->get();
        return view('admin.orders.show', compact('order', 'orderItems'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Chỉ cho phép cập nhật nếu trạng thái không phải 'completed'
        if ($order->status !== 'completed') {
            $order->status = $request->input('status');
            $order->save();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
        }

        return redirect()->route('orders.show', $order->id)
            ->with('error', 'Không thể thay đổi trạng thái đơn hàng đã hoàn thành.');
    }

    public function destroy($id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);

        // Thực hiện xóa đơn hàng
        $order->delete();

        // Redirect hoặc trả về thông báo sau khi xóa
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xóa thành công');
    }

    public function store(Request $request)
    {
        // ... existing validation and order creation code ...

        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'total' => $request->total,
            'status' => 'pending'
        ]);

        // Gửi thông báo Telegram
        $message = "🛍 <b>Đơn hàng mới!</b>\n\n";
        $message .= "👤 Khách hàng: {$order->name}\n";
        $message .= "📱 Số điện thoại: {$order->phone}\n";
        $message .= "📍 Địa chỉ: {$order->address}\n";
        $message .= "💰 Tổng tiền: " . number_format($order->total) . "₫\n";
        $message .= "📝 Ghi chú: {$order->note}\n";
        $message .= "🔗 Link đơn hàng: " . route('admin.orders.show', $order->id);

        $this->telegramService->sendMessage($message);

        return response()->json([
            'success' => true,
            'message' => 'Đặt hàng thành công!'
        ]);
    }
}
