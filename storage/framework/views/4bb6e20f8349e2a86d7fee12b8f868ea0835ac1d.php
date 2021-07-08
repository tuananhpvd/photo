
 
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-sm">

    </div>
    <div class="col-sm">
    <form action="<?php echo e(route('hoadon_search')); ?>" method="GET">
        <select required="true" class="form-control" name="search">
             
            <option value=""> - Chọn lớp - </option>
            
            <?php $__currentLoopData = $lops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <option value="<?php echo e($lop->id); ?>"><?php echo e($lop->tenlop); ?></option>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <form class="form-inline" action="<?php echo e(url('/')); ?>/hoadon/search/khoi/xlsx" method="GET">
        <label for="xuatkhoi" class="col-form-label"></label><input class="form-control mb-2 mr-sm-2" type="number" name="xuatkhoi"  placeholder="Không cần nhập" value="">
        <label for="tungay" class="col-form-label"><b>Từ ngày: </b></label><input required="true" type="date" name="tungay" value=""class="form-control mb-2 mr-sm-2" >         
        <label for="denngay" class="col-form-label"><b>Đến ngày: </b></label><input required="true" type="date" name="denngay" value=""class="form-control mb-2 mr-sm-2" >        
    <button type="submit" class="btn btn-info export mb-2">Xuất Tất cả</button>

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
    <form class="form-inline" action="<?php echo e(url('/')); ?>/hoadon/search/lop/xlsx" method="GET">
        <select required="true" class="form-control mb-2 mr-sm-2" name="xuatlop">
            
            <option value="">-Chọn lớp cần xuất-</option>
            
            <?php $__currentLoopData = $lops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <option value="<?php echo e($lop->id); ?>"><?php echo e($lop->tenlop); ?></option>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <label for="tungay" class="col-form-label"><b>Từ ngày: </b></label><input required="true" type="date" name="tungay" value=""class="form-control mb-2 mr-sm-2" >         
        <label for="denngay" class="col-form-label"><b>Đến ngày: </b></label><input required="true" type="date" name="denngay" value=""class="form-control mb-2 mr-sm-2" >        
    <button type="submit" class="btn btn-warning mb-2">Xuất Lớp</button>

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
    <form class="form-inline" action="<?php echo e(url('/')); ?>/hoadon/search/gvcn/xlsx" method="GET">
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

<?php if($hoadons->isNotEmpty()): ?>

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



<?php else: ?> 
    <div>
        <h2>Không tìm thấy!</h2>
    </div>
<?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('hoadon.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\photo\resources\views//hoadon/search.blade.php ENDPATH**/ ?>