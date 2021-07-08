 <html>
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Laravel 5.8 Tutorial - Datatables Individual Column Searching using Ajax</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
 <div class="container">   
     <br />
    <h3 align="center">Laravel 5.8 Tutorial - Datatables Individual Column Searching using Ajax</h3>
    <br />
  <div class="table-responsive">
   <table class="table table-bordered table-striped" id="hoadon">
    <thead>
     <tr>
      <th>Sr. No.</th>
      <th>gvbm</th>
      <th>
       <select name="category_filter" id="category_filter" class="form-control">
        <option value="">Select lớp</option>
        <?php $__currentLoopData = $lops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($row->id); ?>"><?php echo e($row->tenlop); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </select>
      </th>
      <th>so trang</th>
     </tr>
    </thead>

   </table>
  </div>
  <br />
  <br />
 </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 fetch_data();
 
 function fetch_data(lop_id = '')
 {
  $('#hoadon').DataTable({
   processing: true,
   //serverSide: true,
  ajax: {
    url:"<?php echo e(route('theolop.index')); ?>",
    data: {lop_id:lop_id}
   },
 //   data: {lops:lops},
   columns:[
    {
     data: 'id',
     name: 'id'
    },
    {
     data: 'gvbm',
     name: 'gvbm'
    },
    {
     data: 'lop_id',
     name: 'lop_id'
    },
    {
     data:'sotrang',
     name:'sotrang'
    }
   ]
  });
 }
 
 $('#category_filter').change(function(){
  var id = $('#category_filter').val();
 
  $('#hoadon').DataTable().destroy();
 
  fetch_data(id);
 });


});
</script><?php /**PATH D:\xampp\htdocs\photo\resources\views//hoadon/hoadon_theolop.blade.php ENDPATH**/ ?>