<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMucRequest;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title  = 'Danh mục sản phẩm';
        $listDanhMuc = DanhMuc::orderByDesc('trang_thai')->get();
        return view('admins.danhmucs.index',compact('title','listDanhMuc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm danh mục sản phẩm';
        return view('admins.danhmucs.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(DanhMucRequest $request)
    {
        if($request->isMethod('POST')){
            $data = $request->except('_token');

            if($request->hasFile('hinh_anh')){
                $file_path = $request->file('hinh_anh')->store('uploads/danhmucs','public');
            }else{
                $file_path = null;
            }
            $data['hinh_anh'] = $file_path;

            DanhMuc::create($data);
            return redirect()->route('admins.danhmucs.index')->with('success','Thêm danh mục thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Thêm danh mục sản phẩm';
        $danhMuc = DanhMuc::findOrFail($id);
        return view('admins.danhmucs.show',compact('title','danhMuc'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $title = 'Chỉnh sửa danh mục sản phẩm';
        $danhMuc = DanhMuc::findOrFail($id);

        return view('admins.danhmucs.edit',compact('title','danhMuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token','_method');

        $danhMuc = DanhMuc::findOrFail($id);

        if($request->hasFile('hinh_anh')){
            if($danhMuc->hinh_anh && Storage::disk('public')->exists($danhMuc->hinh_anh)){
                Storage::disk('public')->delete($danhMuc->hinh_anh);
            }
            $file_path = $request->file('hinh_anh')->store('uploads/danhmucs','public');
        }else{
            $file_path = $danhMuc->hinh_anh;
        }
        $data['hinh_anh'] = $file_path;
        $danhMuc->update($data);

        return redirect()->route('admins.danhmucs.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        $danhMuc->delete();

        if($danhMuc->hinh_anh && Storage::disk('public')->exists($danhMuc->hinh_anh)){
            Storage::disk('public')->delete($danhMuc->hinh_anh);
        }

        return redirect()->route('admins.danhmucs.index')->with('success','Xóa thành công');

    }
}
