@extends('hoadon.layout')
 
@section('content')

<h2 class="text-center"><a href="create"><button class="btn btn-success">Nhập mới</button></a>&nbsp;&nbsp;&nbsp;<a href="../lop/xem"><button class="btn btn-warning">Thêm lớp</button></a>&nbsp;&nbsp;&nbsp;<a href="../giay/xem"><button class="btn btn-secondary">Thêm giấy</button></a>&nbsp;&nbsp;&nbsp;<a href="{{ url('/') }}/hoadon/xuat/xlsx"><button class="btn btn-info export" id="export-button">Xuất Excel</button></a></h2>

<div class="row">
    <div class="col-sm">

    </div>
    <div class="col-sm">
<form method="POST" action="../hoadon/xoahet" onsubmit="return ConfirmDelete( this )">
                    @method('DELETE')
                    @csrf 
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">                                       
                    <button type="submit" class="btn btn-danger" style="margin: 0px 0px 0px 0px;" onclick="return confirm('Có chắc chắn muốn xóa không?')">Xóa toàn bộ</button><br>
                            </div>
                </form>
    </div>
    <div class="col-sm">

    </div>
</div>

<div class="row">
    <div class="col-sm">

    </div>
    <div class="col-sm">
        <form action="{{ route('hoadon_search') }}" method="GET">
        @csrf
        <select required="true" class="form-control" name="search">
            
            <option value=""> - Chọn lớp - </option>
            
            @foreach($lops as $lop)

            <option value="{{$lop->id}}">{{$lop->tenlop}}</option>

             @endforeach
        </select>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Xem lớp</button>
        </div>

        </form> 
    </div>
    <div class="col-sm">

    </div>
</div>
<br>

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

            <th>Thực hiện</th>                     
        </tr>
    </thead>
    <tbody>
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

            {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $hoadons->links() !!}
        </div>


@endsection