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
                <h4 class="fs-18 fw-semibold m-0">Quản lý khuyến mãi sản phẩm</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{$title}}</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form action="{{route('admins.khuyenmais.store')}}" method="POST" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="ten" class="form-label">Tên khuyến mãi</label>
                                        <input type="text" id="ten" name="ten" class="form-control @error('ten') is-invalid @enderror" value="{{old('ten')}}" placeholder="Nhập tên khuyến mãi">
                                        @error('ten') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="mo_ta" class="form-label">Mô tả</label>
                                        <textarea name="mo_ta" id="input" class="form-control" rows="3" >{{old('mo_ta')}}</textarea>
                                        @error('mo_ta') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="gia_tri" class="form-label">Giá trị</label>
                                        <input type="number" id="gia_tri" name="gia_tri" class="form-control @error('gia_tri') is-invalid @enderror" value="{{old('gia_tri')}}" placeholder="Nhập tên giá trị">
                                        @error('gia_tri') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu</label>
                                        <input type="date" id="ngay_bat_dau" name="ngay_bat_dau" class="form-control @error('ngay_bat_dau') is-invalid @enderror" value="{{old('ngay_bat_dau')}}" >
                                        @error('ngay_bat_dau') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>


                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc</label>
                                        <input type="date" id="ngay_ket_thuc" name="ngay_ket_thuc" class="form-control @error('ngay_ket_thuc') is-invalid @enderror" value="{{old('ngay_ket_thuc')}}" >
                                        @error('ngay_ket_thuc') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>

                               

                                
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary">Thêm</button>
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
