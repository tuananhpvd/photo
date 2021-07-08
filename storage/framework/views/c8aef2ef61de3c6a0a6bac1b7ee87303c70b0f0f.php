
 
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
<form class="card p-3 bg-light" method="post" action="../update/<?php echo e($giays->id); ?>">
    <?php echo method_field('PATCH'); ?>    
    <?php echo csrf_field(); ?>

                    <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="loaigiay">Loại giấy: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="text" name="loaigiay" value="<?php echo e($giays->loaigiay); ?>">
                    </div>
                </div>



                    <div class="form-group row">
                    <div class="col-md-3">        
        <label class="col-form-label" for="tien">Tiền: </label>
                    </div>      
                    <div class="col-md-7">
<input class="form-control" required="true" type="number" name="tien" value="<?php echo e($giays->tien); ?>">
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
<?php echo $__env->make('hoadon.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\photo\resources\views//hoadon/giay_update.blade.php ENDPATH**/ ?>