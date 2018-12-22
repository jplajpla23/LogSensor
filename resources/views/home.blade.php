@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <!--<center>
                    <a class="btn btn-outline-danger" href="{{route('listSensores')}}"> <i class="fas fa-wifi"></i> Sensors</a>
                    <a class="btn btn-outline-info" href="{{route('listAlerts')}}"> <i class="fas fa-bell"></i> Alerts</a></center>-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
