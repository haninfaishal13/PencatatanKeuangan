<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            ['name' => 'Makanan & Minuman'],
            ['name' => 'Tagihan'],
            ['name' => 'Transportasi'],
            ['name' => 'Belanja'],
            ['name' => 'Hiburan'],
            ['name' => 'Kesehatan & Kebugaran'],
            ['name' => 'Keluarga'],
            ['name' => 'Pendidikan'],
            ['name' => 'Bisnis'],
            ['name' => 'Investasi'],
            ['name' => 'Hutang Piutang'],
        ];
        foreach($category as $key=>$value) {
            Category::create($value);
        }
    }
}
