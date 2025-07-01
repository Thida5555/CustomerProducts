@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Order List</h2>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Add New Order</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Order Date</th>
                <th>Total Price ($)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ number_format($order->total_price, 2) }}</td>
                <td>
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div>{{ $orders->links() }}</div>
</div>
@endsection
