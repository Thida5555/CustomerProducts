@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Order Item</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   <form action="{{ route('orderitem.update', $orderItem) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Order</label>
            <select name="order_id" class="form-control" required>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ $orderItem->order_id == $order->id ? 'selected' : '' }}>
                        #{{ $order->id }} - {{ $order->customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Product</label>
            <select name="product_id" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $orderItem->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $orderItem->quantity }}" required>
        </div>

        <div class="mb-3">
            <label>Subtotal ($)</label>
            <input type="number" step="0.01" name="subtotal" class="form-control" value="{{ $orderItem->subtotal }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('orderitem.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
