<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $danhMuc = [];
        for($i=1 ; $i<=10 ; $i++){
            $danhMuc[] = [
                'hinh_anh'=>null,
                'ten_danh_muc'=>'Ten danh muc số '.$i,
                'trang_thai'=>rand(0,1),
            ];
        }
        DB::table('danh_mucs')->insert($danhMuc);
    }
}
