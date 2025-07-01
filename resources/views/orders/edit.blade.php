@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Order</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Customer</label>
            <select name="customer_id" class="form-control" required>
                <option value="">-- Select Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Order Date</label>
            <input type="date" name="order_date" class="form-control" value="{{ $order->order_date }}" required>
        </div>

        <div class="mb-3">
            <label>Total Amount ($)</label>
            <input type="number" step="0.01" name="total_price" class="form-control" value="{{ $order->total_amount }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
