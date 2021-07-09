@extends('hoadon.layout')
 
@section('content')
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script>
        function myFunction() {
        //var mylist = document.getElementById("myList");
        //document.getElementById("demo").value = mylist.options[mylist.selectedIndex].value;
        
        var valu = document.getElementById("myList").value;
        var split = valu.split(",");
        var v1 = split[0];
        var v2 = split[1];
        document.getElementById("ml").value = v1;
        document.getElementById("sl").value = v2;
        }
    </script>
    <script>
        function myFunctionGV() {
        var x = document.getElementById("gv");
            x.value = x.value.toUpperCase();
        }
    </script>
    <script>
        function myFunctionND() {
        var x = document.getElementById("nd");
            x.value = x.value.toUpperCase();
        }
    </script>
    <script>
        function myFunctionGHI() {
        var x = document.getElementById("ghi");
            x.value = x.value.toUpperCase();
        }
    </script>

<form class="card p-3 bg-light" method="post" action="{{ route('hoadon_store')}}">
    @method('PATCH')
    @csrf
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-2">        
                            <label class="col-form-label" for="tenlop">Lớp: </label>
                        </div>      
                        <div class="col-md-8">

                            @foreach ($lops as $row)
                            <label><input type="checkbox" name="idlop[]" value="{{$row->id}}">{{$row->tenlop}}</label>        
                            @endforeach
                        </div>
                    </div>            
        </div>
        <div class="col-md-5">

                <div class="form-group row">
                    <div class="col-md-3">        
                        <label class="col-form-label" for="ngay">Ngày: </label>
                    </div>      
                <div class="col-md-7">
                        <input  class="form-control" required="true" type="date" name="ngay" value="">
                    </div>
                </div> 


                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="gvbm">Giáo viên: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="gvbm" value="" id="gv" onblur="myFunctionGV()">
                    </div>
                </div> 

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="noidung">Nội dung: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="noidung" value="" id="nd" onblur="myFunctionND()">
                    </div>
                </div> 
 
                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="loaigiay">Loại giấy: </label>
                    </div>      
                    <div class="col-md-7">
        <select class="form-control" required="true" name="loaigiay">
                <option value="" name="loaigiay" id="loaigiay" > - Chọn giấy - </option>
                @foreach($giays as $giay)

                <option value="{{$giay->id}}" name="loaigiay" id="loaigiay">{{$giay->loaigiay}}</option>

                @endforeach
        </select>
                    </div>
                </div> 

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="sotrang">Số trang: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="number" name="sotrang" value="">
                    </div>
                </div>     

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="soluong">Số lượng: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" type="number" name="soluong" value="" id="sl">
                    </div>
                </div> 

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="ghichu">Ghi chú: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" type="text" name="ghichu" value="" id="ghi" onblur="myFunctionGHI()">
                    </div>
                </div>               


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Lưu</button>
        <button type="reset" class="btn btn-warning">Làm lại</button>
        <a href="xem"><button type="button" class="btn btn-danger">Thoát</button></a>
    </div>

        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>
</form>

@endsection