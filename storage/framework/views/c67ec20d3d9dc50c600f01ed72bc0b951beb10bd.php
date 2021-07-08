
 
<?php $__env->startSection('content'); ?>

<h2 class="text-center"><a href="create"><button class="btn btn-success">Nhập mới</button></a>&nbsp;&nbsp;&nbsp;<a href="../lop/xem"><button class="btn btn-warning">Thêm lớp</button></a>&nbsp;&nbsp;&nbsp;<a href="../giay/xem"><button class="btn btn-secondary">Thêm giấy</button></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo e(url('/')); ?>/hoadon/xuat/xlsx"><button class="btn btn-info export" id="export-button">Xuất Excel</button></a></h2>

<div class="row">
    <div class="col-sm">

    </div>
    <div class="col-sm">
<form method="POST" action="../hoadon/xoahet" onsubmit="return ConfirmDelete( this )">
                    <?php echo method_field('DELETE'); ?>
                    <?php echo csrf_field(); ?> 
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
        <form action="<?php echo e(route('hoadon_search')); ?>" method="GET">
        <?php echo csrf_field(); ?>
        <select required="true" class="form-control" name="search">
            
            <option value=""> - Chọn lớp - </option>
            
            <?php $__currentLoopData = $lops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <option value="<?php echo e($lop->id); ?>"><?php echo e($lop->tenlop); ?></option>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <?php $__currentLoopData = $hoadons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>
            <td class="align-middle"><?php echo e($index++); ?></td>
            <td class="align-middle"><?php echo e($row->tenlop); ?></td>
            <td class="align-middle"><?php $ngay=strtotime($row->ngay); $ngay=date('d-m-Y',$ngay); echo $ngay; ?></td>
            <td class="align-middle"><?php echo e($row->gvbm); ?></td>
            <td class="align-middle"><?php echo e($row->noidung); ?></td>
            <td class="align-middle"><?php echo e($row->loaigiay); ?></td>
            <td class="align-middle"><?php echo e($row->sotrang); ?></td>
            <td class="align-middle"><?php echo e($row->soluong); ?></td>            
            <td class="align-middle text-right"><?php echo e(number_format($row->dongia)); ?></td>            
            <td class="align-middle text-right"><?php echo e(number_format($row->dongia * $row->soluong)); ?></td>            
            <td class="align-middle"><?php echo e($row->ghichu); ?></td> 
                      
 
            <td class="align-middle"><form method="POST" action="../hoadon/delete/<?php echo e($row->id); ?>" onsubmit="return ConfirmDelete( this )">

                    <a href="edit/<?php echo e($row->id); ?>" class="btn btn-primary">Sửa</a> 
                    <?php echo method_field('DELETE'); ?>
                    <?php echo csrf_field(); ?>                    
                    <button type="submit" class="btn btn-danger" style="margin: 0px 0px 0px 0px;" onclick="return confirm('Có chắc chắn muốn xóa không?')">Xóa</button>
                </form>
            </td>
        </tr>
 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

</table>

            
        <div class="d-flex justify-content-center">
            <?php echo $hoadons->links(); ?>

        </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('hoadon.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\photo\resources\views//hoadon/hoadon_xem.blade.php ENDPATH**/ ?>