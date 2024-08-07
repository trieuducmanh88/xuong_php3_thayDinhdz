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
                                    <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">cart</li>
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

                @if (session('error'))
                        <div class="alert alert-danger alert-dismissib;a fade show" role="alert"> {{session('error')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                @endif

                    <div class="row">
                        <div class="col-lg-12">
    <form action="{{route('cart.update')}}" method="POST">
    @csrf
        <!-- Cart Table Area -->
        <div class="cart-table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="pro-thumbnail">Thumbnail</th>
                        <th class="pro-title">Product</th>
                        <th class="pro-price">Price</th>
                        <th class="pro-quantity">Quantity</th>
                        <th class="pro-subtotal">Total</th>
                        <th class="pro-remove">Remove</th>
                    </tr>
                </thead>
                <tbody>
@foreach ($cart as $key => $items)

<tr>
    <td class="pro-thumbnail">
        <a href="{{route('sanphams.chitiet',$key)}}"><img class="img-fluid" src="{{Storage::url($items['hinh_anh'])}}" alt="Product" /></a>
        <input type="hidden" name="cart[{{$key}}][hinh_anh]" value="{{$items['hinh_anh']}}">
    </td>
    <td class="pro-title">
        <a href="{{route('sanphams.chitiet',$key)}}">{{$items['ten_san_pham']}}</a>
    <input type="hidden" name="cart[{{$key}}][ten_san_pham]" value="{{$items['ten_san_pham']}}">

</td>
    <td class="pro-price">
        <span>{{ number_format($items['gia'] ,0,'','.')}}đ</span>
        <input type="hidden" name="cart[{{$key}}][gia]" value="{{$items['gia']}}">

    </td>
    <td class="pro-quantity">
    <div class="pro-qty">
        <input name="cart[{{$key}}][so_luong]" type="text" class="quantityInput" data-price="{{$items['gia']}}"  value="{{$items['so_luong']}}">

    </div>
    </td>
    <td class="pro-subtotal"><span class="subtotal">{{ number_format( $items['gia'] * $items['so_luong'] , 0 , '' ,'.') }}đ</span></td>
    <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
</tr>
@endforeach

                    
                </tbody>
            </table>
        </div>
        <!-- Cart Update Option -->
        <div class="cart-update-option d-block d-md-flex justify-content-between">

            <!-- <div class="apply-coupon-wrapper">
                <form action="#" method="post" class=" d-block d-md-flex">
                    <input type="text" placeholder="Enter Your Coupon Code" required />
                    <button class="btn btn-sqr">Apply Coupon</button>
                </form>
            </div> -->
            <div class="cart-update">
                <button type="submit" class="btn btn-sqr">Update Cart</button>
            </div>
        </div>
    </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h6>Cart Totals</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Sub Total</td>
                                                <td class="sub-total">{{ number_format($subTotal, 0 , '' ,'.') }}đ</td>
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td class="shipping" >{{ number_format($shipping, 0 , '' ,'.') }}đ</td>

                                            </tr>
                                            <tr class="total">
                                                <td>Total</td>
                                                <td class="total-amount">{{ number_format($total, 0 , '' ,'.') }}đ</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="{{route('donhangs.create')}}" class="btn btn-sqr d-block">Proceed Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
@endsection



@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // quantity change js
    $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
    $('.pro-qty').append('<span class="inc qtybtn">+</span>');

    // hàm cập nhật tổng giỏ hàng
    function updateTotal(){
        var subTotal = 0;
        // Tính tổng tiền các sản phẩm trong giỏ hàng
        $('.quantityInput').each(function(){
                var $input = $(this);
                var price = parseFloat($input.data('price'));
                var quantity = parseFloat($input.val());
                subTotal += price * quantity; 
            }
        )
        // Lấy số tiền vận chuyển
        var shipping =parseFloat($('.shipping').text().replace(/\./g,'').replace('đ',''));
        var total = subTotal + shipping; 
        // Cập nhật giá trị 
        $('.sub-total').text(subTotal.toLocaleString('vi-VN') + 'đ');
        $('.total-amount').text(total.toLocaleString('vi-VN') + 'đ');

    }

    $('.qtybtn').on('click', function () {
        var $button = $(this);
        var $input = $button.parent().find('input')
        var oldValue = parseFloat($input.val());
        
        if($button.hasClass('inc')){
            var newValue = oldValue + 1 ;
        }else{
            if(oldValue > 1){
                var newValue = oldValue - 1 ;
            }else{
                var newValue = 1 ;
            }
        }
        $input.val(newValue);

        // cập nhật lại giá trị của subtotal
         var price = parseFloat($input.data('price'));
          var subtotalElement = $input.closest('tr').find('.subtotal');
           var newSubtotal = newValue * price ;
           subtotalElement.text(newSubtotal.toLocaleString('vi-VN') + 'đ');

           updateTotal();
	});


    // sủa lý nếu người dùng nhập số âm
    $('.quantityInput').on('change',function(){
        var value = parseInt($(this).val(),10);
        if(isNaN(value) || value < 1){
            alert('Số lượng phải lớn hơn , bằng 1.');
            $(this).val(1)
        }
        updateTotal();

    })

    $('.pro-remove').on('click', function(){
        event.preventDefault(); // chặn thao tác mặc định thẻ a
        var $row =  $(this).closest('tr');
        $row.remove();$row  //xoá hàng
        updateTotal();

    })

    updateTotal();

</script>
@endsection