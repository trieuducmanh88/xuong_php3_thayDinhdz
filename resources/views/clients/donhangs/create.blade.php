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
                                    <li class="breadcrumb-item"><a href="shop.html">Đặt hàng</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- checkout main wrapper start -->
        <div class="checkout-page-wrapper section-padding">
            <div class="container">

            <form action="{{route('donhangs.store')}}" method="post">
                @csrf
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Billing Details</h5>
                            <div class="billing-form-wrap">

                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                    <div class="single-input-item">
                                        <label for="ten_nguoi_nhan" class="required">Tên người nhận </label>
                                        <input type="text" id="ten_nguoi_nhan" name="ten_nguoi_nhan" placeholder="Nhập tên người nhận"  value="{{Auth::user()->name}}" />
                                        @error('ten_nguoi_nhan') <p class="text-danger">{{$message}}</p>  @enderror
                                    </div>

                                    <div class="single-input-item">
                                        <label for="email_nguoi_nhan" class="required">Email người nhận </label>
                                        <input type="email" id="email_nguoi_nhan" name="email_nguoi_nhan" placeholder="Nhập email người nhận"  value="{{Auth::user()->email}}" />
                                        @error('email_nguoi_nhan') <p class="text-danger">{{$message}}</p>  @enderror
                                    </div>

                                    <div class="single-input-item">
                                        <label for="sdt_nguoi_nhan" class="required">Số điện thoại người nhận </label>
                                        <input type="text" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan" placeholder="Nhập só điện thoại người nhận"  value="{{Auth::user()->phone}}" />
                                        @error('sdt_nguoi_nhan') <p class="text-danger">{{$message}}</p>  @enderror
                                    </div>

                                    <div class="single-input-item">
                                        <label for="dia_chi_nguoi_nhan" class="required">Địa chỉ người nhận </label>
                                        <input type="text" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan" placeholder="Nhập địa chỉ người nhận"  value="{{Auth::user()->address}}" />
                                        @error('dia_chi_nguoi_nhan') <p class="text-danger">{{$message}}</p>  @enderror
                                    </div>



                                    <div class="single-input-item">
                                        <label for="ordernote">Ghi chú</label>
                                        <textarea name="ghi_chu" id="ordernote"  cols="30" rows="3" placeholder="Nhập ghi chú"></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Your Order Summary</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Products</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $key => $items)
                                            
                                            <tr>
                                                <td><a href="{{route('sanphams.chitiet',$key)}}">{{$items['ten_san_pham']}}<strong> × {{$items['so_luong']}}</strong></a>
                                                </td>
                                                <td>{{number_format($items['gia']*$items['so_luong'],0,'','.')}}đ</td>
                                            </tr>
                                            @endforeach
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td>{{number_format($subTotal,0,'','.')}}đ</td>
                                                <input type="hidden" name="tien_hang" value="{{$subTotal}}">
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td>{{number_format($shipping,0,'','.')}}đ</td>
                                                <input type="hidden" name="tien_ship" value="{{$shipping}}">
                                            </tr>
                                            <tr>
                                                <td>Total Amount</td>
                                                <td><p class="text-danger">{{number_format($total,0,'','.')}}đ</p></td>
                                                <input type="hidden" name="tong_tien" value="{{$total}}">
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method show">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cashon"  value="cash" class="custom-control-input" checked />
                                                <label class="custom-control-label" for="cashon">Thanh toán khi giao hàng</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" data-method="cash">
                                            <p>Thanh toán bằng tiền mặt khi giao hàng.</p>
                                        </div>
                                    </div>
                                   
                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms"  />
                                            <label class="custom-control-label" for="terms">Tôi đã đọc và đồng ý với các điều khoản và điều kiện của trang web.</label>
                                        </div>
                                        <button type="submit" class="btn btn-sqr">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </form>

            </div>
        </div>
        <!-- checkout main wrapper end -->
@endsection



@section('js')

@endsection