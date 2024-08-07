@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection

@section('css')
 <!-- Quill css -->
 <link href="{{asset('assets/admin/libs/quill/quill.core.js')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/libs/quill/quill.snow.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/libs/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css" />
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

        <form action="{{route('admins.sanphams.update',$listSanPham->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
                        <input type="text" id="ma_san_pham" name="ma_san_pham" class="form-control @error('ma_san_pham') is-invalid @enderror" value="{{$listSanPham->ma_san_pham}}" placeholder="Nhập mã sản phẩm">
                        @error('ma_san_pham') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                        <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control @error('ten_san_pham') is-invalid @enderror" value="{{$listSanPham->ten_san_pham}}" placeholder="Nhập tên sản phẩm">
                        @error('ten_san_pham') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gia_san_pham" class="form-label">Giá sản phẩm</label>
                        <input type="number" id="gia_san_pham" name="gia_san_pham" class="form-control @error('gia_san_pham') is-invalid @enderror" value="{{$listSanPham->gia_san_pham}}" placeholder="Nhập giá sản phẩm">
                        @error('gia_san_pham') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi</label>
                        <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai" class="form-control @error('gia_khuyen_mai') is-invalid @enderror" value="{{$listSanPham->gia_khuyen_mai}}" placeholder="Nhập giá khuyến mãi">
                        @error('gia_khuyen_mai') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

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

                    <div class="mb-3">
                        <label for="so_luong" class="form-label">Số lượng</label>
                        <input type="number" id="so_luong" name="so_luong" class="form-control @error('so_luong') is-invalid @enderror" value="{{$listSanPham->so_luong}}" placeholder="Nhập số lượng">
                        @error('so_luong') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ngay_nhap" class="form-label">Ngày nhập</label>
                        <input type="date" id="ngay_nhap" name="ngay_nhap" class="form-control @error('ngay_nhap') is-invalid @enderror" value="{{$listSanPham->ngay_nhap}}">
                        @error('ngay_nhap') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mo_ta_ngan" class="form-label">Mô tả ngắn</label>
                        <textarea id="mo_ta_ngan" name="mo_ta_ngan" class="form-control @error('mo_ta_ngan') is-invalid @enderror" placeholder="Mô tả ngắn" rows="3">{{$listSanPham->mo_ta_ngan}}</textarea>
                        @error('mo_ta_ngan') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_type" class="form-label">Trạng thái</label>
                        <input class="form-check-input" type="radio" name="is_type" value="1" id="is_type1" {{$listSanPham->is_type == 1 ? 'checked' : ''}}>
<label class="form-check-label text-success" for="is_type1">Hiển thị</label>

<input class="form-check-input" type="radio" name="is_type" value="0" id="is_type2" {{$listSanPham->is_type == 0 ? 'checked' : ''}}>
<label class="form-check-label text-danger" for="is_type2">Ẩn</label>

                    </div>

                    <label for="">Tùy chỉnh khác</label>
                    <div class="form-switch mb-2 d-flex ps-3 justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input bg-danger" type="checkbox" name="is_new" id="is_new"  {{$listSanPham->is_new == 1 ? 'checked' : ''}}>
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
                    

                    <div class="mb-3">
                    <label class="form-check-label" for="is_show_home">Mô tả chi tiết sản phẩm</label>
                        <div id="quill-editor" style="height: 400px;">
                            <h1>Nhập mô tả chi tiết sản phẩm</h1>
                            
                        </div>
                        <textarea name="noi_dung" id="noi_dung_content" class="d-none" > </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="hinh_anh" class="form-label">Hình ảnh</label>
                        <input type="file" id="hinh_anh" name="hinh_anh" class="form-control" onchange="showImage(event)">
                        <img id="img_danh_muc" src="{{Storage::url($listSanPham->hinh_anh)}}" alt="Hình ảnh sản phẩm" style="width: 150px; ">
                    </div>

                    <div class="mb-3">
                        <label for="hinh_anh" class="form-label">Album hình ảnh</label>
                        <i id="add-row"  class="mdi mdi-plus text-muted fs-18 rounded-2 border p-1" style="cursor: pointer;"></i>
                        <table class="table align-middle table-nowrap mb-0">
                            <tbody id="image-table-body">
                                @foreach ($listSanPham->hinhAnhSanPham as $index => $hinhAnh)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <img id="preview_{{$index}}" src="{{Storage::url($listSanPham->hinh_anh)}}" alt="Hình ảnh sản phẩm" style="width: 50px;" class="me-3" >
                                        <input type="file" id="hinh_anh" name="list_hinh_anh[{{$hinhAnh->id}}]" class="form-control" onchange="previewImage(this,0)">
                                        <input type="hidden" name="list_hinh_anh[{{$hinhAnh->id}}]" value="{{$hinhAnh->id}}">
                                    </td>
                                    <td><i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1" style="cursor: pointer;" ></i></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
 <!-- Quill Editor Js -->
 <script src="{{asset('assets/admin/libs/quill/quill.core.js')}}"></script>
 <script src="{{asset('assets/admin/libs/quill/quill.min.js')}}"></script>
 <!-- của phẩn noi dung  -->
 <script>
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
</script>

<!-- thêm album ảnh -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
       var rowCount = 1 ;
       document.getElementById('add-row').addEventListener('click',function(){
        var tableBody = document.getElementById('image-table-body')
        var newRow = document.createElement('tr');
       newRow.innerHTML = ` <td class="d-flex align-items-center">
                                <img id="preview_${rowCount}" src="https://cdn-icons-png.flaticon.com/512/25/25666.png" alt="Hình ảnh sản phẩm" style="width: 50px;" class="me-3" >
                                <input type="file" id="hinh_anh" name="list_hinh_anh[id_${rowCount}]" class="form-control" onchange="previewImage(this,${rowCount})">
                            </td>
                            <td><i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1" style="cursor: pointer;" onclick="removeRow(this)"></i></td> 
                         `;
                        tableBody.appendChild(newRow); 
                        rowCount++; 
       })

      
    });
    function  previewImage(input , rowIndex){
        if(input.files && input.files[0] ){
            const reader = new FileReader();
        reader.onload = function(e){
          document.getElementById( `preview_${rowIndex}`).setAttribute('src', e.target.result)
        }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function removeRow(item) {
    // Tìm phần tử <tr> chứa phần tử <td> hiện tại và xóa nó
    var row = item.closest('tr');
    if (row) {
        row.remove();
    }
}

</script>



@endsection
