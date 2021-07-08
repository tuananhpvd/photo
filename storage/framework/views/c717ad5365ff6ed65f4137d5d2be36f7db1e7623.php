
 
<?php $__env->startSection('content'); ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form class="card p-3 bg-light" method="post" action="<?php echo e(route('giay_store')); ?>">
            <?php echo csrf_field(); ?>


                <div class="form-group">
                                <label><strong>Loại giấy :</strong></label><br>
                                <label><input type="checkbox" name="loaigiay[]" value="A4-1"> A4-1</label>
                                <label><input type="checkbox" name="loaigiay[]" value="A4-2"> A4-2</label>
                                <label><input type="checkbox" name="loaigiay[]" value="A3-2"> A3-2</label>

                            </div> 



                <div class="form-group row">
                    <div class="col-md-3">        
                        <label class="col-form-label" for="tien">Tiền: </label>
                    </div>      
                    <div class="col-md-7">
                        <input type="text" class="form-control" required="true" type="number" name="tien" value="">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success">Lưu</button>
                    <a href="xem"><button type="button" class="btn btn-danger">Thoát</button></a>        
                </div> 
            </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('hoadon.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\photo\resources\views/hoadon/giay_create.blade.php ENDPATH**/ ?>