<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CheckoutController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function index()
    {
        $cartItems = Cart::getContent(); // Lấy danh sách sản phẩm trong giỏ
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('message', 'Giỏ hàng của bạn đang trống.');
        }
        $cartItems = Cart::getContent(); // Lấy danh sách sản phẩm trong giỏ
        $cartTotal = Cart::getTotal(); // Tính tổng tiền trong giỏ hàng
        return view('frontend.checkout.index', compact('cartItems','cartTotal', 'cartItems'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name' => 'required|string|max:255',
            'billing_address_1' => 'required|string|max:255',
            'billing_city' => 'required|string|max:255',
            'billing_phone' => 'required|string|max:15',
            'billing_email' => 'required|email|max:255',
            'payment_method' => 'required|string',
        ], [
            'billing_first_name.required' => 'Vui lòng nhập tên.',
            'billing_last_name.required' => 'Vui lòng nhập họ.',
            'billing_address_1.required' => 'Vui lòng nhập địa chỉ.',
            'billing_city.required' => 'Vui lòng nhập tỉnh/thành phố.',
            'billing_phone.required' => 'Vui lòng nhập số điện thoại.',
            'billing_email.required' => 'Vui lòng nhập địa chỉ email.',
            'billing_email.email' => 'Địa chỉ email không hợp lệ.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
        ]);

        // Lưu thông tin đơn hàng
        $order = Order::create([
            'billing_name' => $request->input('billing_first_name') . ' ' . $request->input('billing_last_name'),
            'billing_address' => $request->input('billing_address_1'),
            'billing_city' => $request->input('billing_city'),
            'billing_phone' => $request->input('billing_phone'),
            'billing_email' => $request->input('billing_email'),
            'total_amount' => Cart::getTotal(),
            'payment_method' => $request->input('payment_method'),
            'status' => 'pending',
        ]);

        // Lưu các sản phẩm trong đơn hàng
        foreach (Cart::getContent() as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
            ]);
        }

        // Gửi thông báo Telegram
        $message = "🛍 <b>Đơn hàng mới!</b>\n\n";
        $message .= "👤 Khách hàng: {$order->billing_name}\n";
        $message .= "📱 Số điện thoại: {$order->billing_phone}\n";
        $message .= "📧 Email: {$order->billing_email}\n";
        $message .= "📍 Địa chỉ: {$order->billing_address}\n";
        $message .= "🏙 Tỉnh/Thành phố: {$order->billing_city}\n";
        $message .= "💳 Phương thức thanh toán: {$order->payment_method}\n";
        $message .= "💰 Tổng tiền: " . number_format($order->total_amount) . "₫\n\n";
        $message .= "📦 Chi tiết sản phẩm:\n";
        
        foreach ($order->items as $item) {
            $message .= "- {$item->product_name} x {$item->quantity} = " . number_format($item->price * $item->quantity) . "₫\n";
        }
        
        $this->telegramService->sendMessage($message);

        Cart::clear();
        // Sau khi lưu, chuyển hướng người dùng
        return redirect()->route('checkout.thankyou')->with('success', 'Đơn hàng đã được đặt.');
    }

    public function success()
    {
        return view('frontend.checkout.thankyou'); // Trang thanh toán thành công
    }
}
