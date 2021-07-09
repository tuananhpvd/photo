@extends('hoadon.layout')
 
@section('content')

<div class="row">
    <div class="col-sm-2">

    </div>
    <div class="col-sm-8">
<table border="1" class="table table-striped table-bordered text-center table-hover table-sm">
    <thead class="bg-warning">
        <tr>
            <th>TT</th>
            <th>Loại giấy</th>
            <th>Tiền</th>  
            <th>Thực hiện</th>                               
        </tr>
    </thead>
    <tbody>
        @foreach($giays as $row)
        
        <tr>
            <td class="align-middle">{{ $index++ }}</td> 


            <td class="align-middle">{{ $row->loaigiay }} </td>
         
            <td class="align-middle text-right">{{$row->tien}}</td>
            <td class="align-middle">
                <form method="POST" action="../giay/delete/{{ $row->id }}" onsubmit="return ConfirmDelete( this )">

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
    </div>
    <div class="col-sm-2">

    </div>
</div>

<h2 class="text-center"><a href="create"><button class="btn btn-success">Thêm giấy</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('export_giay') }}"><button class="btn btn-info export" id="export-button">Xuất Excel</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../hoadon/xem"><button type="button" class="btn btn-danger">Thoát</button></a></h2>

@endsection