<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // បង្ហាញតារាង customer ទាំងអស់
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    // បង្ហាញ form បង្កើត customer ថ្មី
    public function create()
    {
        return view('customers.create');
    }

    // រក្សាទុក customer ថ្មីក្នុង database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')
                         ->with('success', 'Customer created successfully.');
    }

    // បង្ហាញ form កែប្រែ customer
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // រក្សាទុកការកែប្រែ customer
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,'.$customer->id,
            'phone' => 'required',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')
                         ->with('success', 'Customer updated successfully.');
    }

    // លុប customer
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
                         ->with('success', 'Customer deleted successfully.');
    }
}
