<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function listCart(){

        // refresh cho cart bằng 0
        // session()->put('cart',[]); 


        $cart = session()->get('cart',[]);

        $total = 0 ;
        $subTotal = 0 ;
        foreach($cart as $items ){
            $subTotal+= $items['gia'] * $items['so_luong'] ;
        }
        $shipping  = 30000 ;
        $total = $subTotal + $shipping;

        return view('clients.cart',compact('cart','subTotal','shipping','total'));
    }



    public function addCart(Request $request){
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        // dd($request->all());
        $sanPham = SanPham::query()->findOrFail($productId);

        //Khởi tạo session 1 mảng chứa thông tin giỏ hàng 
        $cart = session()->get('cart',[]);

        if(isset($cart[$productId])){
            // sản phẩm đã tồn tại trong giỏ hàng
            $cart[$productId]['so_luong'] +=  $quantity;
        }
        else{
            // sản phẩm chưa có trong giỏ hàng
            $cart[$productId] = [
                'ten_san_pham' => $sanPham->ten_san_pham,
                'so_luong' => $quantity,
                'gia' => (isset($sanPham->gia_khuyen_mai)) ? $sanPham->gia_khuyen_mai : $sanPham->gia_san_pham ,
                'hinh_anh' => $sanPham->hinh_anh,
            ];
        }
        session()->put('cart',$cart);
        return redirect()->back();
    }



    
    public function updateCart(Request $request){
        $cartNew = $request->input('cart',[]);
        session()->put('cart',$cartNew);
        return redirect()->back();
    }
}
