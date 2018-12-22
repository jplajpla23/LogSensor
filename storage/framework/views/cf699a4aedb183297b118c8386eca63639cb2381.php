
<?php $__env->startSection('content'); ?>
<div class="container">
    <span id="error" style="display: none!important;"><?php echo e($errors->any()); ?></span>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><h4>Edit sensor</h4></center></div><br>
                <div class="card-body">
                    <div id="form" >
                        <!--create form-->
                        <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <form style="padding-left: 15vw!important;" method="POST" action="<?php echo e(route('sensor_edit')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($sensor->id); ?>">
                            <div class="row" style="padding-left: 10%!important;">
                               <div class="form-group" style="margin-right: 10px!important;">
                                <label for="name">Name</label>
                                <input type="text" class="form-control col-md-12" id="name" name="name" required value="<?php echo e($sensor->name); ?>">
                            </div>
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="name">MAC</label>
                                <input type="text" class="form-control col-md-12" id="mac" name="mac" required value="<?php echo e($sensor->mac); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="min">Min</label>
                                <input type="number" class="form-control col-md-12" id="min" step="0.01"name="min" onchange="minchange(this);" required value="<?php echo e($sensor->min); ?>">
                            </div>
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="max">Max</label>
                                <input type="number" class="form-control col-md-12" id="max" step="0.01" name="max" onchange="maxinchange(this);" value="<?php echo e($sensor->max); ?>" required>
                            </div>
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="Threshold">Threshold</label>
                                <input type="number" class="form-control col-md-12" id="Threshold" step="0.01" name="Threshold" required min="0" value="<?php echo e($sensor->threshold); ?>">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-outline-success" name="submit" value="Edit" style="margin-left: 25%;">
                        <a class="btn btn-outline-dark" href="<?php echo e(route('listSensores')); ?>" >Cancel</a>
                    </form>

                </div>
                
                
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function minchange($this)
    {
        document.getElementById('max').min=$this.value;
    }
    function maxinchange($this)
    {
        document.getElementById('min').max=$this.value;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>