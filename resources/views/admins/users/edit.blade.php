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
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{$title}}</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{route('admins.users.update', $loadOneUser->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$loadOneUser->name}}" >
                                        @error('name') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$loadOneUser->email}}" >
                                        @error('email') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">address</label>
                                        <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{$loadOneUser->address}}" >
                                        @error('address') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>


                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">phone</label>
                                        <input type="number" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$loadOneUser->phone}}" >
                                        @error('phone') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>

                                

                                <div class="col-sm-10 d-flex gap-2">
                                    <label for="role" class="form-label">Role</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role1" value="Admin" {{$loadOneUser->role === 'Admin' ? 'checked' : ''}}>
                                        <label class="form-check-label text-success" for="role1">Admin</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role2" value="User" {{$loadOneUser->role === 'User' ? 'checked' : ''}}>
                                        <label class="form-check-label text-danger" for="role2">User</label>
                                    </div>
                                </div>

                               
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div> <!-- content -->
@endsection

@section('js')
<script>
    function showImage(event){
        const img_danh_muc = document.getElementById('img_danh_muc');
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(){
            img_danh_muc.src = reader.result;
            img_danh_muc.style.display = 'block';
        }
        if(file){
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
