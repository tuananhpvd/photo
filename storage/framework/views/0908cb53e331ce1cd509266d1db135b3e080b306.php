
 
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6"> 
<form class="card p-3 bg-light" method="post" action="../update/<?php echo e($hoadons->id); ?>">
    <?php echo method_field('PATCH'); ?>
    <?php echo csrf_field(); ?>
                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="tenlop">Lớp: </label>
                    </div>      
                    <div class="col-md-7">
        <select class="form-control" name="tenlop" disabled>
            <?php $__currentLoopData = $lops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($lop->id); ?>" <?php echo e($hoadons->lop_id == $lop->id ? 'selected' : ''); ?>><?php echo e($lop->tenlop); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
                    </div>
                </div>


    <p>
        <input type="hidden" name="malop" value="<?php echo e($hoadons->lop_id); ?>" >
    </p>
                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="ngay">Ngày: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="date" name="ngay" value="<?php echo e($hoadons->ngay); ?>">
                    </div>
                </div>
 
                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="gvbm">Giáo viên: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="gvbm" value="<?php echo e($hoadons->gvbm); ?>">
                    </div>
                </div>
 
                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="noidung">Nội dung: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="noidung" value="<?php echo e($hoadons->noidung); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="loaigiay">Loại giấy: </label>
                    </div>      
                    <div class="col-md-7">
        <select  class="form-control" required="true" name="loaigiay">
            <?php $__currentLoopData = $giays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $giay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($giay->id); ?>" <?php echo e($hoadons->giay_id == $giay->id ? 'selected' : ''); ?>><?php echo e($giay->loaigiay); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
                    </div>
                </div>    

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="sotrang">Số trang: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="sotrang" value="<?php echo e($hoadons->sotrang); ?>">
                    </div>
                </div>    

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="soluong">Số lượng: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="soluong" value="<?php echo e($hoadons->soluong); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="ghichu">Ghi chú: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" type="text" name="ghichu" value="<?php echo e($hoadons->ghichu); ?>">
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('hoadon.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\photo\resources\views//hoadon/hoadon_update.blade.php ENDPATH**/ ?>