<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Botol Plastik PET', 'price_per_kg' => 2000],
            ['name' => 'Kertas Koran / Kardus', 'price_per_kg' => 1500],
            ['name' => 'Plastik PP/HDPE', 'price_per_kg' => 1800],
            ['name' => 'Aluminium/Kaleng', 'price_per_kg' => 12000],
            ['name' => 'Kaca', 'price_per_kg' => 500],
            ['name' => 'Organik (Kompos)', 'price_per_kg' => 300],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}

