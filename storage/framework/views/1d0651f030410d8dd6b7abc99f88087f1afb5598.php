<div>
<center><h2><?php echo e($title); ?> : <?php echo e($sensor->name); ?></h2></center>
<br>
<?php echo e($alert->Message); ?>

<br><br><br><br>
<hr>
Automatic Generated:

Sensor with name :<?php echo e($sensor->name); ?> and Mac: <?php echo e($sensor->mac); ?>  has a new reading of <span style="color: red;"><?php echo e($data->value); ?></span> at: <?php echo e($data->created_at); ?><br>
<hr>
This alert configurations has:
<br>
Min:<?php echo e($alert->min); ?> <br>
Max:<?php echo e($alert->max); ?>


</div>