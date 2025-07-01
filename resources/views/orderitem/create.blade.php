@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add Order Item</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orderitem.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Order</label>
            <select name="order_id" class="form-control" required>
                <option value="">-- Select Order --</option>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}">#{{ $order->id }} - {{ $order->customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Product</label>
            <select name="product_id" class="form-control" required>
                <option value="">-- Select Product --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" min="1" value="1" required>
        </div>

        <div class="mb-3">
            <label>Subtotal ($)</label>
            <input type="number" step="0.01" name="subtotal" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('orderitem.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
