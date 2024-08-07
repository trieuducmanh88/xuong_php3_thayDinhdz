<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class ClientProductController extends Controller
{
    public function chiTietSanPham( string $id){
        $sanphamChitiet = SanPham::findOrFail($id);
        $listSanPham = SanPham::query()->get();
        return view('clients.sanphams.chiTietSP' ,compact('sanphamChitiet','listSanPham'));
    }


    public function sanPhamHome(){
        $sanPhamHome = SanPham::query()->get();
        $sanPhamHomeDescView = SanPham::where('luot_xem','>=','50')->get();
        // dd($sanPhamHomeDescView);
        return view('clients.home',compact('sanPhamHome','sanPhamHomeDescView'));
    }
}
