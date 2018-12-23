<?php $__env->startSection('content'); ?>

<div class="container">
    <span id="error" style="display: none!important;"><?php echo e($errors->any()); ?></span>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><h4>DashBoard</h4></center></div><br>
                
                <div class="card-body">
                    <center>
                        <div id="chart_div" style="width: 100%!important;" ></div>
                    </center>

                </div>
                
                


            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {packages: ['corechart', 'line']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {

        var data = new google.visualization.DataTable();
      data.addColumn('datetime', 'X');
      <?php $__currentLoopData = $historynames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      data.addColumn('number', '<?php echo e($h); ?>');
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      data.addRows([
        <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $ha; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        

        [new Date('<?php echo e($h->created_at); ?>'), 
        <?php $__currentLoopData = $historynames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$hn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <?php if($key== $h->sensors_id): ?>
        <?php echo e($h->value); ?>,
        <?php else: ?>
        <?php if(!$loop->last): ?>
        <?php echo e('null,'); ?>

        <?php else: ?>
        <?php echo e('null'); ?>

        <?php endif; ?>

        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        ],
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
        ]);

      var options = {
        hAxis: {
          title: 'Time'
        },
        vAxis: {
          title: 'Values'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

      chart.draw(data, options);
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>