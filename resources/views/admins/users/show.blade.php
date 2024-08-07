@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection

@section('css')

@endsection

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>{{$title}} : {{$danhMuc->ten}}</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <h5>ID</h5>
                    <p class="text-muted">{{$danhMuc->id}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Tên danh mục</h5>
                    <p class="text-muted">{{$danhMuc->ten_danh_muc}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Trạng thái</h5>
                    <p class="text-muted">{{$danhMuc->trang_thai == 1 ? 'Hiển thị' : "Tạm Ẩn" }}</p>

                </div>
                
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Hình ảnh</h5>
                    <img src="{{Storage::url($danhMuc->hinh_anh)}}" alt="Banner Image" class="img-fluid rounded">
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection