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
                    <h5 class="card-title align-content-center mb-0">{{$title}}</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">

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

                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th >Mã đơn hàng</th>
                                    <th >Ngày đặt</th>
                                    <th >Tổng tiền</th>
                                    <th >Trạng thái</th>
                                    <th >Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($listDonHang as $key => $items)
                            <tr>
                                <td>
                                    <a href="{{route('admins.donhangs.show',$items->id)}}"  >
                                        <strong>{{$items->ma_don_hang}}</strong>
                                    </a>
                                </td>
                                <td>{{$items->created_at->format('d-m-Y')}}</td>
                                <td>{{number_format($items->tong_tien,0,'','.')}}đ</td>
                                <td>
                                    <form action="{{route('admins.donhangs.update',$items->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <select name="trang_thai_don_hang" id="input" class="form-select w-75" onchange="confirmSubmit(this)" data-default-value="{{$items->trang_thai_don_hang}}">
                                            <option value=""></option>
                                            @foreach ($trangThaiDonHang as $key => $value)
                                                <option value="{{$key}}" {{$key == $items->trang_thai_don_hang ? 'selected' : ''}} 
                                                {{$key == 'huy_don_hang' ? 'disabled' : ''}} >
                                                     {{$value}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{route('admins.donhangs.show',$items->id)}}"><i class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                   @if ($items->trang_thai_don_hang === $type_huy_don_hang)
                                   <form action="{{route('admins.donhangs.destroy',$items->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có đồng ý xoá không')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-white">
                                                <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                            </button >
                                        </form>
                                   @endif
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
<script>
    function confirmSubmit(selectElement) {
        var form = selectElement.form;
        var selectedOption = selectElement.options[selectElement.selectedIndex].text;
        var defaultValue = selectElement.getAttribute('data-default-value');

        if (confirm('Bạn có chắc thay đổi trạng thái đơn hàng thành "' + selectedOption + '" không?')) {
            form.submit();
        } else {
            selectElement.value = defaultValue;
        }
    }
</script>

@endsection