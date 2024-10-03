<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "code" => "B001",
                "title" => "Pemrograman Web dengan PHP",
                "category" => "Teknologi",
                "publisher" => "Gramedia"
            ],
            [
                "code" => "B002",
                "title" => "Dasar-dasar Algoritma",
                "category" => "Teknologi",
                "publisher" => "Erlangga"
            ],
            [
                "code" => "B003",
                "title" => "Sejarah Dunia Modern",
                "category" => "Sejarah",
                "publisher" => "Bentang Pustaka"
            ],
            [
                "code" => "B004",
                "title" => "Fisika untuk SMA",
                "category" => "Pendidikan",
                "publisher" => "Intan Pariwara"
            ],
            [
                "code" => "B005",
                "title" => "Manajemen Keuangan",
                "category" => "Ekonomi",
                "publisher" => "Salemba Empat"
            ],
            [
                "code" => "B006",
                "title" => "Psikologi Perkembangan Anak",
                "category" => "Psikologi",
                "publisher" => "Prenada Media"
            ],
            [
                "code" => "B007",
                "title" => "Kiat Sukses Berbisnis",
                "category" => "Bisnis",
                "publisher" => "Pustaka Obor"
            ],
            [
                "code" => "B008",
                "title" => "Belajar Bahasa Jepang",
                "category" => "Bahasa",
                "publisher" => "Deepublish"
            ],
            [
                "code" => "B009",
                "title" => "Novel Laskar Pelangi",
                "category" => "Sastra",
                "publisher" => "Bentang Pustaka"
            ],
            [
                "code" => "B010",
                "title" => "Panduan Investasi Saham",
                "category" => "Ekonomi",
                "publisher" => "Kompas"
            ]
        ];

        foreach ($data as $book) {
            Book::create([
                "code" => $book['code'],
                "title" => $book['title'],
                "category" => $book['category'],
                "publisher" => $book['publisher']
            ]);
        }
    }
}
