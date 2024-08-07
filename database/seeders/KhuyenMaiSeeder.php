<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhuyenMaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $khuyenMai = [];
        for($i =1 ; $i<=5 ; $i++){
            $khuyenMai[] = [
                'ten' => 'SALE'.$i,
                'mo_ta' => 'Mô tả khuyến mãi '.$i,
                'gia_tri' => '100000',
                'ngay_bat_dau' => Carbon::now()->addDays($i)->format('Y-m-d H:i:s'),
                'ngay_ket_thuc' => Carbon::now()->addDays($i + 10)->format('Y-m-d H:i:s'),
            ];
        }
        DB::table('khuyen_mais')->insert($khuyenMai);
    }
}
