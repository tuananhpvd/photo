<form method="post" action="<?php echo e(route('hoadon_store')); ?>">
    <?php echo csrf_field(); ?>
    <p>
        <label for="lop">Lớp: </label><input type="text" name="lop" value="">
    </p>

    <p>
        <label for="ngay">Ngày: </label><input type="date" name="ngay" value="">
    </p>

    <p>
        <label for="gvbm">Giáo viên: </label><input type="text" name="gvbm" value="">
    </p>

    <p>
        <label for="noidung">Nội dung: </label><input type="text" name="noidung" value="">
    </p>

    <p>
        <label for="giay">Loại giấy: </label><input type="text" name="giay" value="">
    </p>
    
    <p>
        <label for="sotrang">Số trang: </label><input type="text" name="sotrang" value="">
    </p>

    <p>
        <label for="soluong">Số lượng: </label><input type="text" name="soluong" value="">
    </p>
                
    <p>
        <label for="ghichu">Ghi chú: </label><input type="text" name="ghichu" value="">
    </p>

    <p>
        <button type="submit">Submit</button>
    </p>
</form><?php /**PATH D:\xampp\htdocs\photo\resources\views/hoadon/hoadons_create.blade.php ENDPATH**/ ?>