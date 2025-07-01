<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // បង្ហាញ Order Items
    public function index()
    {
        $orderItems = OrderItem::with(['order.customer', 'product'])->paginate(10);
        return view('orderitem.index', compact('orderItems'));
    }

    // បង្ហាញ Form បន្ថែម
    public function create()
    {
        $orders = Order::with('customer')->get();
        $products = Product::all();
        return view('orderitem.create', compact('orders', 'products'));
    }

    // រក្សាទុក Order Item ថ្មី
    public function store(Request $request)
    {
        $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'subtotal'   => 'required|numeric|min:0',
        ]);

        $orderItem = OrderItem::create([
            'order_id'   => $request->order_id,
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'subtotal'   => $request->subtotal,
        ]);

        $this->updateOrderTotal($orderItem->order);

        return redirect()->route('orderitem.index')->with('success', 'Order item added.');
    }

    // បង្ហាញ Form កែប្រែ
    public function edit(OrderItem $orderItem)
    {
        $orders = Order::with('customer')->get();
        $products = Product::all();
        return view('orderitem.edit', compact('orderItem', 'orders', 'products'));
    }

    // រក្សាទុកការកែប្រែ
    public function update(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'subtotal'   => 'required|numeric|min:0',
        ]);

        $orderItem->update([
            'order_id'   => $request->order_id,
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'subtotal'   => $request->subtotal,
        ]);

        $this->updateOrderTotal($orderItem->order);

        return redirect()->route('orderitem.index')->with('success', 'Order item updated.');
    }

    // លុប
    public function destroy(OrderItem $orderItem)
    {
        $order = $orderItem->order;
        $orderItem->delete();

        $this->updateOrderTotal($order);

        return redirect()->route('orderitem.index')->with('success', 'Order item deleted.');
    }

    // ប្រើសរុប subtotal ទាំងអស់គ្រាន់តែ Update ទៅ order
    private function updateOrderTotal(Order $order)
    {
        $total = $order->orderItems()->sum('subtotal');
        $order->update(['total_price' => $total]);
    }
}
