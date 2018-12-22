
<?php $__env->startSection('content'); ?>
<div class="container">
    <span id="error" style="display: none!important;"><?php echo e($errors->any()); ?></span>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><h4>Edit Alert</h4></center></div><br>
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

                        <form style="margin: 25px!important;" method="POST" action="<?php echo e(route('editAlertSave')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($a->id); ?>">
                            <div class="row">
                                <div class="form-group" style="width: 98%!important;" >
                                    <label for="desc">Description</label>
                                    <input type="text" class="form-control col-md-12" id="name" name="desc" required value="<?php echo e($a->Description); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="width: 98%!important;" >
                                    <label for="message">Message To Send</label>
                                    <textarea name="message" class="form-control" required><?php echo e($a->Message); ?> </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group"  style="width: 98%!important;">
                                    <label for="min">Min of Safe Range</label>
                                    <input type="number" class="form-control col-md-12" id="min" step="0.01"name="min" onchange="minchange(this);" required value="<?php echo e($a->min); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="width: 98%!important;" >
                                    <label for="max">Max of Safe Range</label>
                                    <input type="number" class="form-control col-md-12" id="max" step="0.01" name="max" onchange="maxinchange(this);" value="<?php echo e($a->max); ?>" required>
                                </div>
                            </div>

                            <center>
                                <input type="submit" class="btn btn-outline-success" name="submit" value="Create" >
                                <a class="btn btn-outline-dark" href="<?php echo e(route('listAlerts')); ?>" >Cancel</a>
                            </center>
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