<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(), // create new customer
            'order_date' => $this->faker->date(),
            'total_price' => 0, // update later after adding order items
        ];
    }
}
