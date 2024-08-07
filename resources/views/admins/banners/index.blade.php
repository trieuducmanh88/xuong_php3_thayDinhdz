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
                <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục sản phẩm</h4>
            </div>
        </div>

        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title align-content-center mb-0">{{$title}}</h5>
                    <a class="btn btn-success " href="{{route('admins.banners.create')}}"><i data-feather="plus-square"></i>Thêm banner</a>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissib;a fade show" role="alert"> {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Hình ảnh Banner</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listBanner as $index => $items)
                                <tr>
                                    <td>{{$items->id}}</td>
                                    <td style="max-width: 200px;">{{$items->mo_ta}}</td>
                                    <td><img src="{{ Storage::url($items->image)}}" alt="" width="550px" height="200px"></td>
                                    <td>                                                       
                                        <a href="{{route('admins.banners.edit',$items->id)}}"><i class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                        <form action="{{route('admins.banners.destroy',$items->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa k')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-white">
                                                <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                            </button >
                                        </form>
                                        <a href="{{route('admins.banners.show',$items->id)}}"><i class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i></a>

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