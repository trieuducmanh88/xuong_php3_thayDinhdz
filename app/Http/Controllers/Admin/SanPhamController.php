<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Models\DanhMuc;
use App\Models\HinhAnhSanPham;
use App\Models\SanPham;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Thông tin sản phẩm';
        $list_san_pham = SanPham::query()->orderByDesc('id')->get();
        return view('admins.sanphams.index',compact('title','list_san_pham')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới sản phẩm';
        $listDanhMuc = DanhMuc::query()->get();
        return view('admins.sanphams.create',compact('title','listDanhMuc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
{
    if ($request->isMethod('POST')) {
        $params = $request->except('_token');

        // Chuyển đổi giá trị checkbox thành boolean
        $params['is_new'] = $request->has('is_new') ? 1 : 0;
        $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
        $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

        // Xử lý hình ảnh chính
        if ($request->hasFile('hinh_anh')) {
            $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
        } else {
            $params['hinh_anh'] = null;
        }

        // Thêm sản phẩm
        $sanPham = SanPham::create($params);
        // lấy id sản phẩm
        $sanPhamID = $sanPham->id;

        // Xử lý thêm album
        if ($request->hasFile('list_hinh_anh')) {
            foreach ($request->file('list_hinh_anh') as $image) {
                if ($image) {
                    $path = $image->store('uploads/hinhanhsanpham/id_' . $sanPhamID, 'public');
                    $sanPham->hinhAnhSanPham()->create([
                        'san_pham_id' => $sanPhamID,
                        'hinh_anh' => $path
                    ]);
                }
            }
        }

        return redirect()->route('admins.sanphams.index')->with('success', 'Thêm sản phẩm thành công');
    }
}



    public function show(string $id)
    {
        $title = 'Chi tiết thông tin sản phẩm ';
        $listDanhMuc = DanhMuc::query()->get();
        $listSanPham = SanPham::query()->findOrFail($id);
        // dd($listSanPham);
        return view('admins.sanphams.show',compact('title','listDanhMuc','listSanPham'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Cập nhật thông tin sản phẩm';
        $listDanhMuc = DanhMuc::query()->get();
        $listSanPham = SanPham::query()->findOrFail($id);
        // dd($listSanPham);
        return view('admins.sanphams.edit',compact('title','listDanhMuc','listSanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        // Tìm sản phẩm theo ID
        $sanPham = SanPham::query()->findOrFail($id);
        
        // Lấy tất cả các tham số từ request
        $params = $request->except('_token', '_method');
        
        // Chuyển đổi giá trị checkbox thành boolean
        $params['is_new'] = $request->has('is_new') ? 1 : 0;
        $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
        $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        
        // Chuyển đổi giá trị radio button
        $params['is_type'] = $request->input('is_type') === '1' ? 1 : 0;

        // Xử lý hình ảnh chính
        if ($request->hasFile('hinh_anh')) {
            // Xóa hình ảnh cũ nếu có
            if ($sanPham->hinh_anh) {
                Storage::disk('public')->delete($sanPham->hinh_anh);
            }
            // Lưu hình ảnh mới
            $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
        }
        
        // Cập nhật sản phẩm
        $sanPham->update($params);
        
        // Xử lý cập nhật album hình ảnh
        if ($request->hasFile('list_hinh_anh')) {
            // Xóa tất cả hình ảnh cũ liên kết với sản phẩm
            $sanPham->hinhAnhSanPham()->delete();
            
            foreach ($request->file('list_hinh_anh') as $image) {
                if ($image) {
                    $path = $image->store('uploads/hinhanhsanpham/id_' . $sanPham->id, 'public');
                    $sanPham->hinhAnhSanPham()->create([
                        'san_pham_id' => $sanPham->id,
                        'hinh_anh' => $path
                    ]);
                }
            }
        }
        
        return redirect()->route('admins.sanphams.index')->with('success', 'Cập nhật sản phẩm thành công');
        
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        // xóa hỉnh ảnh dại diện của sản phẩm
        if($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)){
            Storage::disk('public')->delete($sanPham->hinh_anh);
        }
        // xóa album
        $sanPham->hinhAnhSanPham()->delete();

        // xóa toàn bộ hình ảnh trong thư mục
        $path = 'uploads/hinhanhsanpham/id_'.$id;
        if( Storage::disk('public')->exists($path)){
            Storage::disk('public')->deleteDirectory($path);
        }
        // xóa sản phẩm
        $sanPham->delete();

        return redirect()->route('admins.sanphams.index')->with('success','Bạn đã xóa thành công');
    }
}
