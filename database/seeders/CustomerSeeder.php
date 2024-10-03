<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "number" => "001",
                "name" => "John Doe",
                "address" => "Jl. Merdeka No. 10, Jakarta",
                "gender" => "L"
            ],
            [
                "number" => "002",
                "name" => "Jane Smith",
                "address" => "Jl. Sudirman No. 21, Bandung",
                "gender" => "P"
            ],
            [
                "number" => "003",
                "name" => "Adi Santoso",
                "address" => "Jl. Gajah Mada No. 15, Surabaya",
                "gender" => "L"
            ],
            [
                "number" => "004",
                "name" => "Siti Aminah",
                "address" => "Jl. Diponegoro No. 7, Yogyakarta",
                "gender" => "P"
            ],
            [
                "number" => "005",
                "name" => "Budi Hartono",
                "address" => "Jl. Malioboro No. 12, Yogyakarta",
                "gender" => "L"
            ],
            [
                "number" => "006",
                "name" => "Lina Sari",
                "address" => "Jl. Kuningan No. 5, Semarang",
                "gender" => "P"
            ],
            [
                "number" => "007",
                "name" => "Ahmad Faisal",
                "address" => "Jl. Kebon Jeruk No. 23, Jakarta",
                "gender" => "L"
            ],
            [
                "number" => "008",
                "name" => "Dewi Kartika",
                "address" => "Jl. Cempaka Putih No. 9, Jakarta",
                "gender" => "P"
            ],
            [
                "number" => "009",
                "name" => "Rudi Pratama",
                "address" => "Jl. Kenanga No. 19, Bali",
                "gender" => "L"
            ],
            [
                "number" => "010",
                "name" => "Ayu Lestari",
                "address" => "Jl. Pandanaran No. 3, Semarang",
                "gender" => "P"
            ]
        ];

        foreach ($data as $customer) {
            Customer::create([
                "number" => $customer['number'],
                "name" => $customer['name'],
                "address" => $customer['address'],
                "gender" => $customer['gender']
            ]);
        }
    }
}
