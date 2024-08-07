<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listBanner = Banner::orderByDesc('id')->get();
        return BannerResource::collection($listBanner);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();
        if($request->hasFile('image')){
            $filepath = $request->file('image')->store('uploads/Apibanners', 'public');
        }
        else{
            $filepath = null;
        }
        $params['image'] = $filepath;
        $result = Banner::create($params);

        return response()->json([
            'data' => new BannerResource($result),
            'success' => true,
            'message' => 'Banner đã được thêm thành công'
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $loadOneBanner = Banner::findOrFail($id);
        return new BannerResource($loadOneBanner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $params = $request->all();
        $loadOneBanner = Banner::findOrFail($id);
        if($request->hasFile('image')){
            if($loadOneBanner->image && Storage::disk('public')->exists($loadOneBanner->image)){
                Storage::disk('public')->delete($loadOneBanner->image);
            }
            $filepath = $request->file('image')->store('uploads/Apibanners' , 'public');
        }
        else{
            $filepath = $loadOneBanner->image;
        }
        $params['image'] = $filepath;

        $loadOneBanner->update($params);

        return response()->json([
            'data' => new BannerResource($loadOneBanner),
            'success' => true,
            'message' => 'Banner đã được sửa thành công'
        ],200);
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

        return response([
            'success' => true,
            'message' => 'Xoá thành công'
        ],200);
    }
}
