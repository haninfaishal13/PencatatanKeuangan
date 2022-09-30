<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_category = [
            [
                'category_id' => 1,
                'name' => 'Makan Berat'
            ],
            [
                'category_id' => 1,
                'name' => 'Jajan'
            ],
            [
                'category_id' => 2,
                'name' => 'Tagihan Air'
            ],
            [
                'category_id' => 2,
                'name' => 'Tagihan Listrik'
            ],
            [
                'category_id' => 2,
                'name' => 'Gas'
            ],
            [
                'category_id' => 2,
                'name' => 'Kuota Internet'
            ],
            [
                'category_id' => 2,
                'name' => 'Tempat Tinggal'
            ],
            [
                'category_id' => 3,
                'name' => 'Gojek'
            ],
            [
                'category_id' => 3,
                'name' => 'Angkutan Umum'
            ],
            [
                'category_id' => 3,
                'name' => 'Parkir'
            ],
            [
                'category_id' => 3,
                'name' => 'Bensin'
            ],
            [
                'category_id' => 3,
                'name' => 'Servis'
            ],
            [
                'category_id' => 4,
                'name' => 'Kebutuhan Sehari-hari'
            ],
            [
                'category_id' => 4,
                'name' => 'Pakaian'
            ],
            [
                'category_id' => 4,
                'name' => 'Barang Elektronik'
            ],
            [
                'category_id' => 4,
                'name' => 'Aksesoris'
            ],
            [
                'category_id' => 5,
                'name' => 'Bioskop'
            ],
            [
                'category_id' => 5,
                'name' => 'Game'
            ],
            [
                'category_id' => 5,
                'name' => 'Tempat Wisata'
            ],
            [
                'category_id' => 6,
                'name' => 'Obat-obatan & Multivitamin'
            ],
            [
                'category_id' => 6,
                'name' => 'Periksa Dokter & Check Up'
            ],
            [
                'category_id' => 6,
                'name' => 'Sarana Olahraga'
            ],
            [
                'category_id' => 7,
                'name' => 'Uang Bulanan Keluarga'
            ],
            [
                'category_id' => 7,
                'name' => 'Aksesoris Rumah'
            ],
            [
                'category_id' => 7,
                'name' => 'Renovasi Rumah'
            ],
            [
                'category_id' => 7,
                'name' => 'Kebutuhan Anak'
            ],
            [
                'category_id' => 7,
                'name' => 'Pendidikan Anak'
            ],
            [
                'category_id' => 7,
                'name' => 'Peliharaan'
            ],
            [
                'category_id' => 8,
                'name' => 'UKT'
            ],
            [
                'category_id' => 8,
                'name' => 'SPP'
            ],
            [
                'category_id' => 8,
                'name' => 'Buku'
            ],
            [
                'category_id' => 8,
                'name' => 'Kursus'
            ],
            [
                'category_id' => 9,
                'name' => 'Gaji'
            ],
            [
                'category_id' => 9,
                'name' => 'Kebutuhan Pekerjaan'
            ],
            [
                'category_id' => 9,
                'name' => 'Freelance'
            ],
            [
                'category_id' => 10,
                'name' => 'Investasi'
            ],
            [
                'category_id' => 11,
                'name' => 'Pembayaran Hutang'
            ],
            [
                'category_id' => 11,
                'name' => 'Penerimaan Hutang'
            ]
        ];
        foreach($sub_category as $key => $value) {
            SubCategory::create($value);
        }
    }
}
