
<?php $__env->startSection('content'); ?>

<div class="container">
    <span id="error" style="display: none!important;"><?php echo e($errors->any()); ?></span>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><h4>List My Alerts</h4></center></div><br>
                <div class="card-body">
                    <?php if(session()->has('success')): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo e(session('success')); ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <script>
                        $("#success-alert").fadeTo(4000, 500).slideUp(500, function(){
                            $("#success-alert").slideUp(500);
                        });
                    </script>

                    <?php endif; ?>
                    <table id="example" class="display dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>sensorName</th>
                                <th>Description</th>
                                <th>Message</th>
                                <th>Safe Range</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <style type="text/css">
                            .
                        </style>
                        <?php if(isset($alerts)): ?>
                        <?php $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $s; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                         <td><?php echo e($a->nameSensor); ?></td>
                         <td><?php echo e($a->Description); ?></td>
                         <td><?php echo e($a->Message); ?></td>
                         <td><?php echo e($a->min); ?><--><?php echo e($a->max); ?></td>
                         <td>
                             <form action="<?php echo e(route('deleteAlert')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($a->id); ?>">
                                <a class="btn btn-danger" style="margin-bottom: 3px;" onclick="this.parentNode.submit();">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a class="btn btn-success" href="<?php echo e(route('editAlert',$a->id)); ?>" style="margin-bottom: 3px;"><i class="fas fa-pencil-alt"></i></a>
                            </form>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script src="/js/dataTables.rowGroup.min.js"></script>

<script src="/js/rowGroup.jqueryui.min.js"></script>
<script type="text/javascript">
    var jQuery_2_1_4 = $.noConflict(true);
    jQuery_2_1_4(document).ready(function() {
        jQuery_2_1_4('.dataTable').DataTable({
            "lengthMenu": [[ 5, 10, 15, 25, 50, -1], [5, 10, 15, 25, 50, "All"]],
            "pageLength": 15,
            "autoWidth": true,
            "rowGroup": {
                startRender: function ( rows, group ) {
                 /* var count = rows
                        .data()
                        .pluck(7)
                        .reduce( function (a, b) {
                            return parseFloat(a) + parseFloat(b);
                        }, 0);*/ //funçao que conta a qantidade disponivel conta os valores da tabela
                        
                        return "<center style=\"background-color:#e0e0e0!important\";width:100%!important;height:100%!important;><b>"+group+"</b></center>";
                    },
                    endRender: null,
                    "dataSrc": 0,
                },
                "ordering": true,
                "orderFixed": {
                    "pre":  [[ 0, 'asc' ]]
                },
                "language": {

                    "info": "Showing _START_ to _END_ Total: _TOTAL_ ",
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                        "first": "<<",
                        "last": ">>"
                    },
                    "sLengthMenu": "<div class='d-inline-block'><span>Show&nbsp;&nbsp;</span></div><div class='d-inline-block'> _MENU_ </div>"
                },

                "columnDefs": [
                {
                    "targets": [0],
                    "visible": false
                }],
                "pagingType": "full_numbers",
                "bInfo" : true
            });


    } );

</script>
<style type="text/css">
tr
{
    margin: 0!important;
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>