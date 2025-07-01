@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Order Items</h2>
    <a href="{{ route('orderitem.create') }}" class="btn btn-primary mb-3">Add New Order Item</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Order (Customer)</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Subtotal ($)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderItems as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>#{{ $item->order_id }} ({{ $item->order->customer->name }})</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->subtotal, 2) }}</td>
                <td>
                    <a href="{{ route('orderitem.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('orderitem.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>{{ $orderItems->links() }}</div>
</div>
@endsection
