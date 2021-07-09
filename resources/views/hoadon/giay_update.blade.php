@extends('hoadon.layout')
 
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
<form class="card p-3 bg-light" method="post" action="../update/{{ $giays->id }}">
    @method('PATCH')    
    @csrf

                    <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="loaigiay">Loại giấy: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="loaigiay" value="{{$giays->loaigiay}}">
                    </div>
                </div>



                    <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="tien">Tiền: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="number" name="tien" value="{{$giays->tien}}">
                    </div>
                </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="../xem"><button type="button" class="btn btn-danger">Thoát</button></a>        
    </div> 
</form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>

@endsection