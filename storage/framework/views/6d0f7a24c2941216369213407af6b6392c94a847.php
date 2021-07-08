
 
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-sm-2">

    </div>
    <div class="col-sm-8">
<table border="1" class="table table-striped table-bordered text-center table-hover table-sm">
    <thead class="bg-warning">
        <tr>
            <th>TT</th>
            <th>Lớp</th>
            <th>Sĩ số</th>
            <th>Nộp tiền</th>            
            <th>GVCN</th>  
            <th>Thực hiện</th>                               
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $lops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="align-middle"><?php echo e($index++); ?></td>
            <td class="align-middle"><?php echo e($row->tenlop); ?></td>
            <td class="align-middle"><?php echo e($row->siso); ?></td>
            <td class="align-middle text-right"><?php echo e(number_format($row->noptien)); ?></td>            
            <td class="align-middle"><?php echo e($row->gvcn); ?></td>
            <td class="align-middle">
                <form method="POST" action="../lop/delete/<?php echo e($row->id); ?>" onsubmit="return ConfirmDelete( this )">

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
    </div>
    <div class="col-sm-2">

    </div>
</div>
<h2 class="text-center"><a href="create"><button class="btn btn-success">Thêm lớp</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo e(route('export_lop')); ?>"><button class="btn btn-info export" id="export-button">Xuất Excel</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../hoadon/xem"><button type="button" class="btn btn-danger">Thoát</button></a></h2>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('hoadon.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\photo\resources\views//hoadon/lop_xem.blade.php ENDPATH**/ ?>