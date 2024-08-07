<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banner = [];
        for($i=1 ; $i <=5 ; $i++){
            $banner[] = [
                'image' => 'Hình ảnh '.$i
            ];
            DB::table('banner')->insert($banner);
        }
    }
}
