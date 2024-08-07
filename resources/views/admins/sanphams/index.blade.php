@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Quản lý sản phẩm</h4>
            </div>
        </div>

        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title align-content-center mb-0">{{$title}}</h5>
                    <a class="btn btn-success " href="{{route('admins.sanphams.create')}}"><i data-feather="plus-square"></i>Thêm sản phẩm</a>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissib;a fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Mã sản phẩm</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Danh mục </th>
                                    <th scope="col">Giá sản phẩm</th>
                                    <th scope="col">Giá khuyến mãi</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_san_pham as $index => $items)
                                <tr>
                                    <th scope="row">{{$items->id}}</th>
                                    <td><img src="{{Storage::url($items->hinh_anh)}}" width="100px" height="100px" alt=""></td>
                                    <td>{{$items->ma_san_pham}}</td>
                                    <td>{{$items->ten_san_pham}}</td>
                                    <td>{{$items->danhMuc->ten_danh_muc}}</td>
                                    <td>{{number_format($items->gia_san_pham,0,'','.')}}đ</td>
                                    <td>{{number_format($items->gia_khuyen_mai,0,'','.')}}đ</td>
                                    <td>{{$items->so_luong}}</td>
                                    <td>{{$items->is_type == true ? "Hiển thị" : 'Ẩn' }}</td>
                                    <td>                                                       
                                        <a href="{{route('admins.sanphams.edit',$items->id)}}"><i class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                        <form action="{{route('admins.sanphams.destroy',$items->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa k')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-white">
                                                <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                            </button >
                                        </form>
                                        <a href="{{route('admins.sanphams.show',$items->id)}}"><i class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                       
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
       

    </div> <!-- container-fluid -->
</div> <!-- content -->
@endsection
@section('js')

@endsection