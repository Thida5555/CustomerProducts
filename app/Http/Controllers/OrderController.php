<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // បង្ហាញបញ្ជី Orders ទាំងអស់
    public function index()
    {
        $orders = Order::with(['customer', 'orderItems.product'])->paginate(10);
        return view('orders.index', compact('orders'));
    }

    // បង្ហាញ Form បង្កើត Order ថ្មី
    public function create()
    {
        $customers = Customer::all();
        return view('orders.create', compact('customers'));
    }

    // រក្សាទុក Order ថ្មី (total_amount default = 0)
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
        ]);

        Order::create([
            'customer_id' => $request->customer_id,
            'order_date' => $request->order_date,
            'total_price' => 0, // តម្លៃដំបូង
        ]);

        return redirect()->route('orders.index')
                         ->with('success', 'Order created successfully.');
    }

    // បង្ហាញ Form កែប្រែ Order
    public function edit(Order $order)
    {
        $customers = Customer::all();
        return view('orders.edit', compact('order', 'customers'));
    }

    // រក្សាទុកការកែប្រែ Order
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
        ]);

        $order->update([
            'customer_id' => $request->customer_id,
            'order_date' => $request->order_date,
        ]);

        return redirect()->route('orders.index')
                         ->with('success', 'Order updated successfully.');
    }

    // លុប Order
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
                         ->with('success', 'Order deleted successfully.');
    }
}
