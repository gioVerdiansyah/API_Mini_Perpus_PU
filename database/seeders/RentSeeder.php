<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Customer;
use App\Models\Rent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all()->pluck('id')->toArray();
        $books = Book::all()->pluck('id')->toArray();

        // Loop untuk menghasilkan 10 data seeder
        for ($i = 0; $i < 10; $i++) {
            Rent::create([
                'customer_id' => fake()->randomElement($customers),
                'book_id' => fake()->randomElement($books),
                'rental_date' => fake()->dateTimeBetween('-1 month', 'now'),
                'return_date' => fake()->dateTimeBetween('now', '+1 month'),
                'total' => fake()->numberBetween(1, 10),
                'tax' => fake()->randomFloat(2, 1, 10)
            ]);
        }
    }
}
