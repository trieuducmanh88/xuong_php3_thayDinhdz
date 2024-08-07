<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $sanPhamSeed = [];

        for ($i = 1; $i <= 10; $i++) {
            $sanPhamSeed[] = [
                'ma_san_pham' => "MASP" . $i,
                'ten_san_pham' => 'Sản phẩm ' . $i,
                'hinh_anh' => 'null',
                'gia_san_pham' => rand(1000, 10000),
                'gia_khuyen_mai' => rand(10, 150),
                'mo_ta_ngan' => $faker->sentence(),
                'noi_dung' => 'Nội dung số ' . $i,
                'so_luong' => rand(100, 1000),
                'luot_xem' => rand(100, 10000),
                'ngay_nhap' => $faker->date(),
                'danh_muc_id' => rand(1, 10),
                'is_type' => rand(0, 1),
                'is_new' => rand(0, 1),
                'is_hot' => rand(0, 1),
                'is_hot_deal' => rand(0, 1),
                'is_show_home' => rand(0, 1),
            ];
        }

        DB::table('san_phams')->insert($sanPhamSeed);
    }
}
