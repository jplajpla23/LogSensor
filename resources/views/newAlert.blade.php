@extends('layouts.app')
@section('content')
<div class="container">
    <span id="error" style="display: none!important;">{{$errors->any()}}</span>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><h4>New Alert for: {{ $sensor->name }}</h4></center></div><br>
                <div class="card-body">
                    <div id="form" >
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

                        <form style="margin: 25px!important;" method="POST" action="{{route('alert_new')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $sensor->id}}">
                            <div class="row">
                                <div class="form-group" style="width: 98%!important;" >
                                    <label for="desc">Description</label>
                                    <input type="text" class="form-control col-md-12" id="name" name="desc" required value="{{ old('desc')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="width: 98%!important;" >
                                    <label for="message">Message To Send</label>
                                    <textarea name="message" class="form-control" required>{{old('message')}} </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group"  style="width: 98%!important;">
                                    <label for="min">Min of Safe Range</label>
                                    <input type="number" class="form-control col-md-12" id="min" step="0.01"name="min" onchange="minchange(this);" required value="{{old('min')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="width: 98%!important;" >
                                    <label for="max">Max of Safe Range</label>
                                    <input type="number" class="form-control col-md-12" id="max" step="0.01" name="max" onchange="maxinchange(this);" value="{{ old('max') }}" required>
                                </div>
                            </div>

                            <center>
                                <input type="submit" class="btn btn-outline-success" name="submit" value="Create" >
                                <a class="btn btn-outline-dark" href="{{ route('listAlerts') }}" >Cancel</a>
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
@endsection
