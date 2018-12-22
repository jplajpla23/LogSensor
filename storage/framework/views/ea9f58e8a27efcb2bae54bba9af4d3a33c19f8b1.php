<?php $__env->startSection('content'); ?>
<div class="container">
    <span id="error" style="display: none!important;"><?php echo e($errors->any()); ?></span>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><h4>DashBoard</h4></center></div><br>
                
                <div class="card-body">




                </div>
                
                


            </div>
        </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>