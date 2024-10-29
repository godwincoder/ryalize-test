<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transcation>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users  = \App\Models\User::pluck('id')->random();
        $locations =\App\Models\Location::pluck('id')->random();
        
        return [
            'user_id'               => $users,
            'location_id'           => $locations,
            'amount'                => $this->faker->randomFloat(2, 10, 1000), // Random amount between 10 and 1000
            'transaction_type'      => $this->faker->randomElement(['credit', 'debit']),
            'status'                => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'created_at'            => $this->faker->dateTimeBetween('first day of this month', 'last day of this month')
        ];
    }
}
