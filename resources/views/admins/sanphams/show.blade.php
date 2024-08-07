@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection

@section('css')
    <!-- Quill CSS -->
    <link href="{{asset('assets/admin/libs/quill/quill.core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/libs/quill/quill.snow.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/libs/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
@endsection

@section('content')
<div class="content">
    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-center">
            <h4 class="fs-18 fw-semibold m-0">{{$title}}</h4>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{$title}} : {{$listSanPham->ten_san_pham}}</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- Product Code -->
                                    <div class="mb-3">
                                        <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
                                        <input type="text" id="ma_san_pham" name="ma_san_pham" class="form-control @error('ma_san_pham') is-invalid @enderror" value="{{$listSanPham->ma_san_pham}}" placeholder="Nhập mã sản phẩm">
                                        @error('ma_san_pham') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>

                                    <!-- Product Name -->
                                    <div class="mb-3">
                                        <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                        <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control @error('ten_san_pham') is-invalid @enderror" value="{{$listSanPham->ten_san_pham}}" placeholder="Nhập tên sản phẩm">
                                        @error('ten_san_pham') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>

                                    <!-- Product Price -->
                                    <div class="mb-3">
                                        <label for="gia_san_pham" class="form-label">Giá sản phẩm</label>
                                        <input type="number" id="gia_san_pham" name="gia_san_pham" class="form-control @error('gia_san_pham') is-invalid @enderror" value="{{$listSanPham->gia_san_pham}}" placeholder="Nhập giá sản phẩm">
                                        @error('gia_san_pham') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>

                                    <!-- Promotional Price -->
                                    <div class="mb-3">
                                        <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi</label>
                                        <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai" class="form-control @error('gia_khuyen_mai') is-invalid @enderror" value="{{$listSanPham->gia_khuyen_mai}}" placeholder="Nhập giá khuyến mãi">
                                        @error('gia_khuyen_mai') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>

                                    <!-- Category -->
                                    <div class="mb-3">
                                        <label for="danh_muc_id" class="form-label">Danh mục</label>
                                        <select name="danh_muc_id" id="danh_muc_id" class="form-select @error('danh_muc_id') is-invalid @enderror">
                                            @foreach ($listDanhMuc as $items)
                                                <option value="{{$items->id}}" {{$listSanPham->danh_muc_id == $items->id ? 'selected' : ''}}>
                                                    {{$items->ten_danh_muc}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('danh_muc_id') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>

                                    <!-- Quantity -->
                                    <div class="mb-3">
                                        <label for="so_luong" class="form-label">Số lượng</label>
                                        <input type="number" id="so_luong" name="so_luong" class="form-control @error('so_luong') is-invalid @enderror" value="{{$listSanPham->so_luong}}" placeholder="Nhập số lượng">
                                        @error('so_luong') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>

                                    <!-- Date of Entry -->
                                    <div class="mb-3">
                                        <label for="ngay_nhap" class="form-label">Ngày nhập</label>
                                        <input type="date" id="ngay_nhap" name="ngay_nhap" class="form-control @error('ngay_nhap') is-invalid @enderror" value="{{$listSanPham->ngay_nhap}}">
                                        @error('ngay_nhap') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>

                                    <!-- Short Description -->
                                    <div class="mb-3">
                                        <label for="mo_ta_ngan" class="form-label">Mô tả ngắn</label>
                                        <textarea id="mo_ta_ngan" name="mo_ta_ngan" class="form-control @error('mo_ta_ngan') is-invalid @enderror" placeholder="Mô tả ngắn" rows="3">{{$listSanPham->mo_ta_ngan}}</textarea>
                                        @error('mo_ta_ngan') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label class="form-label">Trạng thái</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_type" value="1" id="is_type1" {{$listSanPham->is_type == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label text-success" for="is_type1">Hiển thị</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_type" value="0" id="is_type2" {{$listSanPham->is_type == 0 ? 'checked' : ''}}>
                                            <label class="form-check-label text-danger" for="is_type2">Ẩn</label>
                                        </div>
                                    </div>

                                    <!-- Custom Options -->
                                    <div class="mb-3">
                                        <label class="form-label">Tùy chỉnh khác</label>
                                        <div class="form-check">
                                            <input class="form-check-input bg-danger" type="checkbox" name="is_new" id="is_new" {{$listSanPham->is_new == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="is_new">New</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input bg-secondary" type="checkbox" name="is_hot" id="is_hot" {{$listSanPham->is_hot == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="is_hot">Hot</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input bg-warning" type="checkbox" name="is_hot_deal" id="is_hot_deal" {{$listSanPham->is_hot_deal == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="is_hot_deal">Hot deal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input bg-success" type="checkbox" name="is_show_home" id="is_show_home" {{$listSanPham->is_show_home == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="is_show_home">Show home</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <!-- Detailed Description -->
                                    <div class="mb-3">
                                        <label for="noi_dung_content" class="form-label">Mô tả chi tiết sản phẩm</label>
                                        <div id="quill-editor" style="height: 400px;"></div>
                                        <textarea name="noi_dung" id="noi_dung_content" class="d-none"></textarea>
                                    </div>

                                    <!-- Main Image -->
                                    <div class="mb-3">
                                        <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                        <input type="file" id="hinh_anh" name="hinh_anh" class="form-control" onchange="showImage(event)">
                                        <img id="img_danh_muc" src="{{Storage::url($listSanPham->hinh_anh)}}" alt="Hình ảnh sản phẩm" class="img-fluid mt-2" style="max-width: 150px;">
                                    </div>

                                   
                                </div>
                            </div>

                           
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-xxl -->
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
        }
        if(file){
            reader.readAsDataURL(file);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill("#quill-editor", {
            theme: "snow",
        });

        // Hiển thị nội dung cũ
        var old_content = `{!! $listSanPham->noi_dung !!}`;
        quill.root.innerHTML = old_content;

        // Cập nhật lại textarea khi nội dung quill-editor thay đổi
        quill.on('text-change', function() {
            var html = quill.root.innerHTML;
            document.getElementById('noi_dung_content').value = html;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var rowCount = '{{ $listSanPham->hinhAnhSanPham->count() }}';
        document.getElementById('add-row').addEventListener('click', function(){
            var tableBody = document.getElementById('image-table-body');
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="d-flex align-items-center">
                    <img id="preview_${rowCount}" src="https://cdn-icons-png.flaticon.com/512/25/25666.png" alt="Hình ảnh sản phẩm" class="me-3" style="width: 50px;">
                    <input type="file" name="list_hinh_anh[id_${rowCount}]" class="form-control" onchange="previewImage(this, ${rowCount})">
                </td>
                <td><i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1" style="cursor: pointer;" onclick="removeRow(this)"></i></td>
            `;
            tableBody.appendChild(newRow);
            rowCount++;
        });
    });

    function previewImage(input, rowIndex){
        if(input.files && input.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
                document.getElementById(`preview_${rowIndex}`).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeRow(item) {
        var row = item.closest('tr');
        if (row) {
            row.remove();
        }
    }
</script>

<!-- Quill Editor JS -->
<script src="{{asset('assets/admin/libs/quill/quill.core.js')}}"></script>
<script src="{{asset('assets/admin/libs/quill/quill.min.js')}}"></script>
@endsection
