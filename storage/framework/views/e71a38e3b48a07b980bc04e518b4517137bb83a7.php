
<?php $__env->startSection('content'); ?>
<div class="container">
    <span id="error" style="display: none!important;"><?php echo e($errors->any()); ?></span>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><h4>List My Sensors</h4></center></div><br>
                <div style="float:right!important;"><a onclick="show();" style="float:right!important;margin-right: 1vw!important;" class="btn btn-warning">New</a></div>
                <div class="card-body">
                    <div id="form" style="display: none!important;">
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

                        <form style="padding-left: 15vw!important;" method="POST" action="<?php echo e(route('sensor_creat')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row" style="padding-left: 10%!important;">
                               <div class="form-group" style="margin-right: 10px!important;">
                                <label for="name">Name</label>
                                <input type="text" class="form-control col-md-12" id="name" name="name" required value="<?php echo e(old('name')); ?>">
                            </div>
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="name">MAC</label>
                                <input type="text" class="form-control col-md-12" id="mac" name="mac" required value="<?php echo e(old('mac')); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="min">Min</label>
                                <input type="number" class="form-control col-md-12" id="min" step="0.01"name="min" onchange="minchange(this);" required value="<?php echo e(old('min')); ?>">
                            </div>
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="max">Max</label>
                                <input type="number" class="form-control col-md-12" id="max" step="0.01" name="max" onchange="maxinchange(this);" value="<?php echo e(old('max')); ?>" required>
                            </div>
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="Threshold">Threshold</label>
                                <input type="number" class="form-control col-md-12" id="Threshold" step="0.01" name="Threshold" required min="0" value="<?php echo e(old('Threshold')); ?>">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-outline-success" name="submit" value="Create" style="margin-left: 25%;">
                        <a class="btn btn-outline-dark" onclick="hide()">Cancel</a>
                    </form>

                </div>
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
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>MAC</th>
                            <th>Last Value</th>
                            <th>At</th>
                            <th>Min</th>
                            <th>Max</th>
                            <th>Threshold</th>
                            <th>Actions</th>
                        </tr>
                        <tbody>
                            <?php $__currentLoopData = $sensors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($s->name); ?></td>
                                <td><?php echo e($s->mac); ?></td>
                                <td><?php echo e($s->lastValue); ?></td>
                                <td><?php echo e($s->At); ?></td>
                                <td><?php echo e($s->min); ?></td>
                                <td><?php echo e($s->max); ?></td>
                                <td><?php echo e($s->threshold); ?></td>
                                <td>
                                    <form action="<?php echo e(route('deleteSensor')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo e($s->id); ?>">
                                        <a class="btn btn-danger" style="margin-bottom: 3px;" onclick="this.parentNode.submit();">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <a class="btn btn-success" style="margin-bottom: 3px;" href="<?php echo e(route('editSensor',$s->id)); ?>"><i class="fas fa-pencil-alt"></i></a><br>
                                    <a class="btn btn-info" style="margin-bottom: 3px;"><i class="fas fa-chart-area"></i></a>
                                    <a href="<?php echo e(route('createAlert',$s->id)); ?>" class="btn btn-warning" style="margin-bottom: 3px;"><i class='fas fa-bell'></i><i class='fas fa-plus'></i></a>
                                    </form>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var jQuery_2_1_4 = $.noConflict(true);
    jQuery_2_1_4(document).ready(function() {
        jQuery_2_1_4('#example').DataTable();
        if(document.getElementById('error').innerHTML=="1")
        {
            show();
        }
    } );
    function minchange($this)
    {
        document.getElementById('max').min=$this.value;
    }
    function maxinchange($this)
    {
        document.getElementById('min').max=$this.value;
    }
    function show()
    {
        document.getElementById('form').style.display="block";
    }
    function hide()
    {
        document.getElementById('form').style.display="none";
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>