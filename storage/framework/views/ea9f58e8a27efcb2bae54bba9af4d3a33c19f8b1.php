<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                   <!--<center>
                    <a class="btn btn-outline-danger" href="<?php echo e(route('listSensores')); ?>"> <i class="fas fa-wifi"></i> Sensors</a>
                    <a class="btn btn-outline-info" href="<?php echo e(route('listAlerts')); ?>"> <i class="fas fa-bell"></i> Alerts</a></center>-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>