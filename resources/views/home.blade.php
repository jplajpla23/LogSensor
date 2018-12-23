@extends('layouts.app')
@section('content')

<div class="container">
    <span id="error" style="display: none!important;">{{$errors->any()}}</span>
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
      @foreach ($historynames as $h)
      data.addColumn('number', '{{ $h }}');
      @endforeach

      data.addRows([
        @foreach ($history as $ha)
        @foreach ($ha as $h)
        {{-- expr --}}

        [new Date('{{ $h->created_at }}'), 
        @foreach ($historynames as $key=>$hn) 
        @if($key== $h->sensors_id)
        {{ $h->value }},
        @else
        @if (!$loop->last)
        {{ 'null,' }}
        @else
        {{ 'null' }}
        @endif

        @endif
        @endforeach
        {{-- expr --}}
        ],
        @endforeach
        @endforeach        
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
@endsection
