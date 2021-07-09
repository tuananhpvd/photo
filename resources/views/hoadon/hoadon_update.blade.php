@extends('hoadon.layout')
 
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6"> 
<form class="card p-3 bg-light" method="post" action="../update/{{ $hoadons->id }}">
    @method('PATCH')
    @csrf
                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="tenlop">Lớp: </label>
                    </div>      
                    <div class="col-md-7">
        <select class="form-control" name="tenlop" disabled>
            @foreach($lops as $lop)
                <option value="{{ $lop->id }}" {{ $hoadons->lop_id == $lop->id ? 'selected' : '' }}>{{ $lop->tenlop }}</option>
            @endforeach
        </select>
                    </div>
                </div>


    <p>
        <input type="hidden" name="malop" value="{{$hoadons->lop_id}}" >
    </p>
                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="ngay">Ngày: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="date" name="ngay" value="{{$hoadons->ngay}}">
                    </div>
                </div>
 
                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="gvbm">Giáo viên: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="gvbm" value="{{$hoadons->gvbm}}">
                    </div>
                </div>
 
                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="noidung">Nội dung: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="noidung" value="{{$hoadons->noidung}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="loaigiay">Loại giấy: </label>
                    </div>      
                    <div class="col-md-7">
        <select  class="form-control" required="true" name="loaigiay">
            @foreach($giays as $giay)
                <option value="{{ $giay->id }}" {{ $hoadons->giay_id == $giay->id ? 'selected' : '' }}>{{ $giay->loaigiay }}</option>
            @endforeach
        </select>
                    </div>
                </div>    

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="sotrang">Số trang: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="sotrang" value="{{$hoadons->sotrang}}">
                    </div>
                </div>    

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="soluong">Số lượng: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="soluong" value="{{$hoadons->soluong}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="ghichu">Ghi chú: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" type="text" name="ghichu" value="{{$hoadons->ghichu}}">
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