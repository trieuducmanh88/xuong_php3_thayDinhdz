<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách User';
        $listUser = User::orderByDesc('id')->get();
        return view('admins.users.index',compact('title','listUser'));
    }

 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Cập nhật User';
        $loadOneUser = User::findOrFail($id);
        return view('admins.users.edit',compact('title','loadOneUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $params = $request->all();
        $loadOneUseUser =User::findOrFail($id);
    
        if ($request->hasFile('image')) {
            if ($loadOneUseUser->image && Storage::disk('public')->exists($loadOneUseUser->image)) {
                Storage::disk('public')->delete($loadOneUseUser->image);
            }
            $filepath = $request->file('image')->store('uploads/UseUsers', 'public');
        } else {
            $filepath = $loadOneUseUser->image;
        }
    
        $params['image'] = $filepath;
        $loadOneUseUser->update($params);
        return redirect()->route('admins.users.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request ,string $id)
    {
        $params = $request->all();
        $params['role'] = 'Block';
        $loadOneUseUser =User::findOrFail($id);

        $loadOneUseUser->update($params);
        return redirect()->route('admins.users.index')->with('success','Chặn thành công');

    }
}
