<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách banner';
        $listBanner = Banner::orderByDesc('id')->get();
        return view('admins.banners.index',compact('title','listBanner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm banner';
        return view('admins.banners.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();
        // dd($params);
        if($request->hasFile('image')){
            $filepath = $request->file('image')->store('uploads/banners', 'public');
        }
        else{
            $filepath = null;
        }
        $params['image'] = $filepath;
        $result = Banner::create($params);
        // $result = Banner::created($params);
        if($result){
            return redirect()->route('admins.banners.index')->with('success','Thêm thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Chi tiết banner';
        $loadOneBanner = Banner::findOrFail($id);
        return view('admins.banners.show',compact('title','loadOneBanner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Cập nhật banner';
        $loadOneBanner = Banner::findOrFail($id);
        return view('admins.banners.edit',compact('title','loadOneBanner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $params = $request->all();
        $loadOneBanner = Banner::findOrFail($id);
    
        if ($request->hasFile('image')) {
            // Kiểm tra xem hình ảnh cũ có tồn tại không
            if ($loadOneBanner->image && Storage::disk('public')->exists($loadOneBanner->image)) {
                // Xóa hình ảnh cũ
                Storage::disk('public')->delete($loadOneBanner->image);
            }
            
            // Lưu hình ảnh mới
            $filepath = $request->file('image')->store('uploads/banners', 'public');
        } else {
            // Nếu không có hình ảnh mới thì giữ nguyên hình ảnh cũ
            $filepath = $loadOneBanner->image;
        }
    
        // Cập nhật hình ảnh trong params và thực hiện cập nhật
        $params['image'] = $filepath;
        $loadOneBanner->update($params);
        return redirect()->route('admins.banners.index')->with('success','Cập nhật thành công');

    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loadOneBanner = Banner::findOrFail($id);
        $loadOneBanner->delete();
        
        if($loadOneBanner->image && Storage::disk('public')->exists($loadOneBanner->image)){
            Storage::disk('public')->delete($loadOneBanner->image);
        }
        return redirect()->route('admins.banners.index')->with('success','Xoá thành công');

    }
}
