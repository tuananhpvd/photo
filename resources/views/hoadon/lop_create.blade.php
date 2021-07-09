@extends('hoadon.layout')
 
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form class="card p-3 bg-light" method="post" action="{{ route('lop_store')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-3">        
                        <label class="col-form-label" for="tenlop">Tên lớp: </label>
                    </div>      
                    <div class="col-md-7">
                        <input type="text" class="form-control" required="true" type="text" name="tenlop" value="">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">        
                        <label class="col-form-label" for="siso">Sĩ số: </label>
                    </div>      
                    <div class="col-md-7">
                        <input type="text" class="form-control" required="true" type="number" name="siso" value="">
                    </div>  
                </div>

                <div class="form-group row">
                    <div class="col-md-3">        
                        <label class="col-form-label" for="noptien">Nộp tiền: </label>
                    </div>      
                    <div class="col-md-7">
                        <input type="text" class="form-control" type="number" name="noptien" value="">
                    </div>  
                </div>

                <div class="form-group row">
                    <div class="col-md-3">        
                        <label class="col-form-label" for="gvcn">GVCN: </label>
                    </div>      
                    <div class="col-md-7">
                        <input type="text" class="form-control" required="true" type="text" name="gvcn" value="">
                    </div>  
                </div>                                

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success">Lưu</button>
                    <a href="xem"><button type="button" class="btn btn-danger">Thoát</button></a>
                </div>
            </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>

@endsection