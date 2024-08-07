<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhuyenMai;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title  = 'Khuyến mãi sản phẩm';
        $listKhuyenMai = KhuyenMai::orderByDesc('id')->get();
        return view('admins.khuyenmais.index',compact('title','listKhuyenMai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm khuyến mãi sản phẩm';
        return view('admins.khuyenmais.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();
        // dd($params);
        $result = KhuyenMai::create($params);
        if($result){
            return redirect()->route('admins.khuyenmais.index')->with('success','Thêm khuyến mãi thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Chỉnh sửa khuyến mãi sản phẩm';
        $loadOneKhuyenMai = KhuyenMai::findOrFail($id);

            // Chuyển đổi ngày thành định dạng 'Y-m-d' nếu cần
    $ngay_bat_dau = $loadOneKhuyenMai->ngay_bat_dau ? Carbon::parse($loadOneKhuyenMai->ngay_bat_dau)->format('Y-m-d') : '';
    $ngay_ket_thuc = $loadOneKhuyenMai->ngay_ket_thuc ? Carbon::parse($loadOneKhuyenMai->ngay_ket_thuc)->format('Y-m-d') : '';

        return view('admins.khuyenmais.show',compact('title','loadOneKhuyenMai','ngay_bat_dau','ngay_ket_thuc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Chỉnh sửa khuyến mãi sản phẩm';
        $loadOneKhuyenMai = KhuyenMai::findOrFail($id);

            // Chuyển đổi ngày thành định dạng 'Y-m-d' nếu cần
    $ngay_bat_dau = $loadOneKhuyenMai->ngay_bat_dau ? Carbon::parse($loadOneKhuyenMai->ngay_bat_dau)->format('Y-m-d') : '';
    $ngay_ket_thuc = $loadOneKhuyenMai->ngay_ket_thuc ? Carbon::parse($loadOneKhuyenMai->ngay_ket_thuc)->format('Y-m-d') : '';

        return view('admins.khuyenmais.edit',compact('title','loadOneKhuyenMai','ngay_bat_dau','ngay_ket_thuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $params = $request->all();
        $LoadOneKhuyenMai = KhuyenMai::findOrFail($id);
        $LoadOneKhuyenMai->update($params);
        return redirect()->route('admins.khuyenmais.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loadOneBanner = KhuyenMai::findOrFail($id);
        $loadOneBanner->delete();
        return redirect()->route('admins.khuyenmais.index')->with('success','Xoá thành công');

    }
}
