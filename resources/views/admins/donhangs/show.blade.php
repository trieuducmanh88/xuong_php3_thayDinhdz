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
                <h4 class="fs-18 fw-semibold m-0">Quản lý đơn hàng</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{$title}}</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                    <table class="table table-striped mb-0">
                        <thead>
                            <td>Thông tin tài khoản đặt hàng</td>
                            <td>Thông tin người nhận  hàng</td>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <ul>
                                        <li>Tên tài khoản : <b>{{$donHang->user->name}}</b></li>
                                        <li>Email : <b>{{$donHang->user->email}}</b></li>
                                        <li>Số điện thoại : <b>{{$donHang->user->phone}}</b></li>
                                        <li>Địa chỉ : <b>{{$donHang->user->adđress}}</b></li>
                                        <li>Tài khoản : <b>{{$donHang->user->role}}</b></li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li>Tên người nhận: <b>{{$donHang->ten_nguoi_nhan}}</b></li>
                                        <li>Email người nhận: <b>{{$donHang->email_nguoi_nhan}}</b></li>
                                        <li>Số điện thoại người nhận: <b>{{$donHang->sdt_nguoi_nhan}}</b></li>
                                        <li>Địa chỉ người nhận: <b>{{$donHang->dia_chi_nguoi_nhan}}</b></li>
                                        <li>Ghi chú: <b>{{$donHang->ghi_chu}}</b></li>
                                        <li>Trạng thái đơn hàng: <b>{{ $trangThaiDonHang[$donHang->trang_thai_don_hang]}}</b></li>
                                        <li>Trạng thái đơn hàng: <b>{{ $trangThaiThanhToan[$donHang->trang_thai_thanh_toan]}}</b></li>

                                        <li>Tiền hàng: <b>{{ number_format( $donHang->tien_hang,0,'','.')}}đ</b></li>
                                        <li>Tiền hàng: <b>{{ number_format( $donHang->tien_ship,0,'','.')}}đ</b></li>
                                        <li>Tiền hàng: <b>{{ number_format( $donHang->tong_tien,0,'','.')}}đ</b></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Sản phẩm của đơn hàng</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                    <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Hình ảnh</th>
                                                                    <th>Mã sản phẩm</th>
                                                                    <th>Tên sản phẩm</th>
                                                                    <th>Đơn giá</th>
                                                                    <th>Số lượng</th>
                                                                    <th>Thành tiền</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($donHang->chiTietDonHang as $items )
                                                                <?php 
                                                                    $sanPham = $items->sanPham;
                                                                ?>
                                                                <tr>
                                                                    <td><img src="{{Storage::url($sanPham->hinh_anh)}}" alt="" width="95px"></td>
                                                                    <td>{{$sanPham->ma_san_pham}}</td>
                                                                    <td>{{$sanPham->ten_san_pham}}</td>
                                                                    <td>{{number_format($items->don_gia,0,'','.')}}đ</td>
                                                                    <td>{{$items->so_luong}}</td>
                                                                    <td>{{number_format($items->thanh_tien,0,'','.')}}đ</td>
                                                                    
                                                                </tr>
                                                                
                                                                @endforeach
                                                                
                                                            </tbody>
                                                        </table>
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
