
<h1><?php echo e($pageName); ?></h1>
<h2 class="text-center"><a href="create"><button class="btn btn-success">Nhập mới</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="xem"><button type="button" class="btn btn-success">Thoát</button></a></h2>
<table border="1">
    <thead>
        <tr>
            <th>TT</th>
            <th>id</th>            
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
            <th>Sửa</th>
            <th>Xóa</th>                     
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $hoadons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>
            <td><?php echo e($index++); ?></td>
            <td><?php echo e($row->id); ?></td>            
            <td><?php echo e($row->tenlop); ?></td>
            <td><?php $ngay=strtotime($row->ngay); $ngay=date('d-m-Y',$ngay); echo $ngay; ?></td>
            <td><?php echo e($row->gvbm); ?></td>
            <td><?php echo e($row->noidung); ?></td>
            <td><?php echo e($row->loaigiay); ?></td>
            <td><?php echo e($row->sotrang); ?></td>
            <td><?php echo e($row->soluong); ?></td>            
            <td><?php echo e(number_format($row->dongia)); ?></td>            
            <td><?php echo e(number_format($row->dongia * $row->soluong)); ?></td>            
            <td><?php echo e($row->ghichu); ?></td> 
            <td><button style="margin: 0px 0px 16px 0px;" onclick="window.location.href='edit/<?php echo e($row->id); ?>';">Sửa</button></td>                       
 
            <td><form method="POST" action="../hoadon/delete/<?php echo e($row->id); ?>" onsubmit="return ConfirmDelete( this )">
                    <?php echo method_field('DELETE'); ?>
                    <?php echo csrf_field(); ?>

                    <button style="margin: 0px 0px 0px 0px;" onclick="return confirm('Có chắc chắn muốn xóa không?')">Xóa</button>
                </form>
            </td>
        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<h2 class="text-center"><a href="create"><button class="btn btn-success">Nhập mới</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="xem"><button type="button" class="btn btn-success">Thoát</button></a></h2><?php /**PATH D:\xampp\htdocs\photo\resources\views//hoadon/hoadon_xemlop.blade.php ENDPATH**/ ?>