@extends('layouts.app')
@section('content')

<div class="container">
    <span id="error" style="display: none!important;">{{$errors->any()}}</span>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><h4>List My Sensors</h4></center></div><br>
                <div style="float:right!important;"><a onclick="show();" style="float:right!important;margin-right: 1vw!important;" class="btn btn-warning">New</a></div>
                <div class="card-body">
                    <div id="form" style="display: none!important;">
                        <!--create form-->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form style="padding-left: 15vw!important;" method="POST" action="{{route('sensor_creat')}}">
                            @csrf
                            <div class="row" style="padding-left: 10%!important;">
                               <div class="form-group" style="margin-right: 10px!important;">
                                <label for="name">Name</label>
                                <input type="text" class="form-control col-md-12" id="name" name="name" required value="{{old('name')}}">
                            </div>
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="name">MAC</label>
                                <input type="text" class="form-control col-md-12" id="mac" name="mac" required value="{{old('mac')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="min">Min</label>
                                <input type="number" class="form-control col-md-12" id="min" step="0.01"name="min" onchange="minchange(this);" required value="{{old('min')}}">
                            </div>
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="max">Max</label>
                                <input type="number" class="form-control col-md-12" id="max" step="0.01" name="max" onchange="maxinchange(this);" value="{{old('max')}}" required>
                            </div>
                            <div class="form-group" style="margin-right: 10px!important;">
                                <label for="Threshold">Threshold</label>
                                <input type="number" class="form-control col-md-12" id="Threshold" step="0.01" name="Threshold" required min="0" value="{{old('Threshold')}}">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-outline-success" name="submit" value="Create" style="margin-left: 25%;">
                        <a class="btn btn-outline-dark" onclick="hide()">Cancel</a>
                    </form>

                </div>
                @if(session()->has('success'))
                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <script>
                    $("#success-alert").fadeTo(4000, 500).slideUp(500, function(){
                        $("#success-alert").slideUp(500);
                    });
                </script>

                @endif
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
                            @foreach ($sensors as $s)
                            <tr>
                                <td>{{$s->name}}</td>
                                <td>{{$s->mac}}</td>
                                <td>{{$s->lastValue}}</td>
                                <td>{{$s->At}}</td>
                                <td>{{$s->min}}</td>
                                <td>{{$s->max}}</td>
                                <td>{{$s->threshold}}</td>
                                <td>
                                    <form action="{{ route('deleteSensor') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$s->id}}">
                                        <a class="btn btn-danger" style="margin-bottom: 3px;" onclick="this.parentNode.submit();">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <a class="btn btn-success" style="margin-bottom: 3px;" href="{{ route('editSensor',$s->id) }}"><i class="fas fa-pencil-alt"></i></a><br>
                                        <a class="btn btn-info" style="margin-bottom: 3px;" onclick="clickModal(this);" data-val="{{ $dt[$s->id]->implode('value', ', ') }}" data-data="{{ $dt[$s->id]->implode('created_at', ', ') }}"><i class="fas fa-chart-area"></i></a>
                                        <a href="{{ route('createAlert',$s->id) }}" class="btn btn-warning" style="margin-bottom: 3px;"><i class='fas fa-bell'></i><i class='fas fa-plus'></i></a>
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog" style="width: 80vw!important;max-width: 80vw!important;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Readings</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body" style="width: 100%;">
        <div id="chart_div" style="width: 100%!important;" ></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>

</div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var jQuery_2_1_4 = $.noConflict(true);
    jQuery_2_1_4(document).ready(function() {
        jQuery_2_1_4('#example').DataTable();
        if(document.getElementById('error').innerHTML=="1")
        {
            show();
        }
    } );
    var dataa=[];
    function clickModal($this)
    {
        dataa=[];
        var dates=$this.getAttribute('data-data').split(', ');
        var values=$this.getAttribute('data-val').split(', ');
        for (var i = 0; i < dates.length; i++) {
            dataa[i]=[new Date(dates[i]),parseFloat(values[i])];
        }

        $("#myModal").modal()
        google.charts.load('current', {packages: ['corechart', 'line']});
        //dataa=
        google.charts.setOnLoadCallback(drawBasic);

    }
    function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('datetime', 'DateTime');
      data.addColumn('number', 'Value');
      data.addRows(
        dataa);

      var options = {
        hAxis: {
          title: 'DateTime'
      },
      vAxis: {
          title: 'Value'
      }
  };

  var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

  chart.draw(data, options);
}
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




@endsection
