@extends('hoadon.layout')
 
@section('content')

<div class="row">
    <div class="col-sm">

    </div>
    <div class="col-sm">
    <form action="{{ route('hoadon_search') }}" method="GET">
        <select required="true" class="form-control" name="search">
             
            <option value=""> - Chọn lớp - </option>
            
            @foreach($lops as $lop)

            <option value="{{$lop->id}}">{{$lop->tenlop}}</option>

             @endforeach
        </select>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">    
    <button type="submit" class="btn btn-primary">Xem lớp</button>
     <a href="xem"><button type="button" class="btn btn-danger">Thoát</button></a>
    </div>     
    </form>
    </div>
    <div class="col-sm">

    </div>
</div>
<br>    

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
    <form class="form-inline" action="{{ url('/') }}/hoadon/search/lop/xlsx" method="GET">
        <select required="true" class="form-control mb-2 mr-sm-2" name="xuatlop">
            
            <option value="">-Chọn lớp cần xuất-</option>
            
            @foreach($lops as $lop)

            <option value="{{$lop->id}}">{{$lop->tenlop}}</option>

             @endforeach
        </select>
        <label for="tungay" class="col-form-label"><b>Từ ngày: </b></label><input required="true" type="date" name="tungay" value=""class="form-control mb-2 mr-sm-2" >         
        <label for="denngay" class="col-form-label"><b>Đến ngày: </b></label><input required="true" type="date" name="denngay" value=""class="form-control mb-2 mr-sm-2" >        
    <button type="submit" class="btn btn-info export mb-2">Xuất Excel</button>

    </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
    <form class="form-inline" action="{{ url('/') }}/hoadon/search/gvcn/xlsx" method="GET">
        <label for="tyle" class="col-form-label"></label><input required="true" class="form-control mb-2 mr-sm-2" type="number" name="tyle"  placeholder="Tỷ lệ %" value="">
        <label for="tungay" class="col-form-label"><b>Từ ngày: </b></label><input required="true" type="date" name="tungay" value=""class="form-control mb-2 mr-sm-2" >         
        <label for="denngay" class="col-form-label"><b>Đến ngày: </b></label><input required="true" type="date" name="denngay" value=""class="form-control mb-2 mr-sm-2" >        
    <button type="submit" class="btn btn-primary mb-2">GVCN</button>

    </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>

<table border="1" class="table table-striped table-bordered text-center table-hover table-sm">
    <thead class="bg-warning">
        <tr>
            <th>TT</th>
            <th>Lớp</th>
            <th>Ngày</th>
            <th>Giáo viên</th>
            <th>Nội dung</th>
            <th>Giấy</th>
            <th>Số trang</th>
            <th>Số lượng</th>            
            <th>Đơn giá</th>
            <th>Thành tiền</th>
            <th>Ghi chú</th> 

            <th>Xóa</th>                     
        </tr>
    </thead>
    <tbody>

@if($hoadons->isNotEmpty())

        @foreach($hoadons as $row)

        <tr>
            <td class="align-middle">{{ $index++ }}</td>
            <td class="align-middle">{{$row->tenlop}}</td>
            <td class="align-middle"><?php $ngay=strtotime($row->ngay); $ngay=date('d-m-Y',$ngay); echo $ngay; ?></td>
            <td class="align-middle">{{$row->gvbm}}</td>
            <td class="align-middle">{{$row->noidung}}</td>
            <td class="align-middle">{{$row->loaigiay}}</td>
            <td class="align-middle">{{$row->sotrang}}</td>
            <td class="align-middle">{{$row->soluong}}</td>            
            <td class="align-middle text-right">{{ number_format($row->dongia) }}</td>            
            <td class="align-middle text-right">{{ number_format($row->dongia * $row->soluong)}}</td>            
            <td class="align-middle">{{$row->ghichu}}</td> 
                      
 
            <td class="align-middle"><form method="POST" action="../hoadon/delete/{{ $row->id }}" onsubmit="return ConfirmDelete( this )">

                    <a href="edit/{{$row->id}}" class="btn btn-primary">Sửa</a> 
                    @method('DELETE')
                    @csrf                    
                    <button type="submit" class="btn btn-danger" style="margin: 0px 0px 0px 0px;" onclick="return confirm('Có chắc chắn muốn xóa không?')">Xóa</button>
                </form>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>



@else 
    <div>
        <h2>Không tìm thấy!</h2>
    </div>
@endif


@endsection