@extends('hoadon.layout')
 
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
<form class="card p-3 bg-light" method="post" action="../update/{{ $lops->id }}">
    @method('PATCH')    
    @csrf
                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="tenlop">Tên lớp: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="tenlop" value="{{$lops->tenlop}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="siso">Sĩ số: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="number" name="siso" value="{{$lops->siso}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="siso">Nộp tiền: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" type="number" name="noptien" value="{{$lops->noptien}}">
                    </div>
                </div>    

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="gvcn">GVCN: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="gvcn" value="{{$lops->gvcn}}">
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