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
                <h4 class="fs-18 fw-semibold m-0">Quản lý User</h4>
            </div>
        </div>

        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title align-content-center mb-0">{{$title}}</h5>
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
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listUser as $index => $items)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$items->name}}</td>
                                    <td>{{$items->email}}</td>
                                    <td>{{$items->address}}</td>
                                    <td>{{$items->phone}}</td>
                                    <td>{{$items->role}}</td>
                                    <td>                                                       
                                        <a href="{{route('admins.users.edit',$items->id)}}"><i class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                        <form action="{{route('admins.users.destroy',$items->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có muốn xóa k')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-white">
                                                <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                            </button >
                                        </form>
                                        <a href="{{route('admins.users.show',$items->id)}}"><i class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i></a>

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