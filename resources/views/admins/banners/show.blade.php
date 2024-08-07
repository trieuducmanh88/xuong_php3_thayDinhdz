@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection

@section('css')

@endsection

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>{{$title}} : {{$loadOneBanner->id}}</h2>
        </div>
        <div class="card-body">
        <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="mo_ta" class="form-label">Mô tả</label>
                                        <textarea name="mo_ta" id="input" class="form-control" rows="3" >{{$loadOneBanner->mo_ta}}</textarea>
                                    </div>
                                </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Hình ảnh</h5>
                    <img src="{{Storage::url($loadOneBanner->image)}}" alt="Banner Image" width="500px" height="200px" class="img-fluid rounded">
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection