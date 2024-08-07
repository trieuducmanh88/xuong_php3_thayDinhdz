@extends('layouts.client')

@section('css')

@endsection



@section('content')
     <!-- breadcrumb area start -->
     <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">My order</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">

                @if (session('success'))
                        <div class="alert alert-success alert-dismissib;a fade show" role="alert"> {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                @endif

                @if (session('error'))
                        <div class="alert alert-danger alert-dismissib;a fade show" role="alert"> {{session('error')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                @endif

                    <div class="row">
                        <div class="col-lg-12">
        <!-- Cart Table Area -->
        <div class="cart-table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th >Mã đơn hàng</th>
                        <th >Ngày đặt</th>
                        <th >Trạng thái</th>
                        <th >Tổng tiền</th>
                        <th >Hành động</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($donHangs as $key => $items)
                    <tr>
                        <td>
                            <a href="{{route('donhangs.show',$items->id)}}"  >
                                <strong>{{$items->ma_don_hang}}</strong>
                            </a>
                        </td>
                        <td>{{$items->created_at->format('d-m-Y')}}</td>
                        <td class="text-danger">{{$trangThaiDonHang[$items->trang_thai_don_hang]}}</td>
                        <td>{{number_format($items->tong_tien,0,'','.')}}đ</td>
                        <td>
                            <a href="{{route('donhangs.show',$items->id)}}" class="btn btn-sqr"  >View</a>
                            <form action="{{route('donhangs.update',$items->id)}}" method="post" class="d-inline">
                                @csrf
                                @method('PUT')
                                @if ($items->trang_thai_don_hang === $type_cho_xac_nhan)
                                    <input type="hidden" name="huy_don_hang" value="1">
                                    <button type="submit" class="btn btn-sqr bg-danger" onclick="return confirm('Bạn có xác nhận huỷ đơn hàng không ?') " >Huỷ</button>
                                @elseif($items->trang_thai_don_hang === $type_dang_van_chuyen)
                                    <input type="hidden" name="da_giao_hang" value="1">
                                    <button type="submit" class="btn btn-sqr btn-success" onclick=" return confirm('Bạn có xác nhận đã nhận hàng') " >Đã nhận hàng</button>
                                @endif
                            </form>
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
        </div>
        <!-- cart main wrapper end -->
@endsection



@section('js')

@endsection