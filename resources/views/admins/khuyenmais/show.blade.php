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
            <h2>{{$title}} : {{$loadOneKhuyenMai->ten}}</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <h5>ID</h5>
                    <p class="text-muted">{{$loadOneKhuyenMai->id}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Mã khuyến mãi</h5>
                    <p class="text-muted">{{$loadOneKhuyenMai->ten}}</p>
                </div>
                <div class="col-md-4">
                    <h5>Mô tả</h5>
                    <p class="text-muted">{{$loadOneKhuyenMai->mo_ta}}</p>
                </div>
                
                
            </div>

            <div class="row mb-3">
                
            <div class="col-md-4">
                    <h5>Sale</h5>
                    <p class="text-muted">{{number_format($loadOneKhuyenMai->gia_tri,0,'','.')}}VNĐ</p>
                </div>

                <div class="col-md-4">
                    <h5>Ngày bắt đầu</h5>
                    <p class="text-muted">{{$ngay_bat_dau}}</p>
                </div>

                <div class="col-md-4">
                    <h5>Ngày kết thúc</h5>
                    <p class="text-muted">{{$ngay_ket_thuc}}</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection