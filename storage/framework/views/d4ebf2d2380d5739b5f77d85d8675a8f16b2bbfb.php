<h1><?php echo e($pageName); ?></h1>
<table border="1">
    <thead>
        <tr>
            <th>TT</th>
            <th>Lớp</th>
            <th>Ngày</th>
            <th>Giáo viên</th>
            <th>Nội dung</th>
            <th>Giấy</th>
            <th>Số trang</th>
            <th>Số lượng</th>
            <th>Ghi chú</th> 
            <th>Thực hiện</th>                     
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $hoadons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($row->id); ?></td>
            <td><?php echo e($row->tenlop); ?></td>
            <td><?php echo e($row->ngay); ?></td>
            <td><?php echo e($row->gvbm); ?></td>
            <td><?php echo e($row->noidung); ?></td>
            <td><?php echo e($row->loaigiay); ?></td>
            <td><?php echo e($row->sotrang); ?></td>
            <td><?php echo e($row->soluong); ?></td>
            <td><?php echo e($row->ghichu); ?></td>                        
            <td>Edit | Delete</td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH D:\xampp\htdocs\photo\resources\views//hoadon/xem.blade.php ENDPATH**/ ?>