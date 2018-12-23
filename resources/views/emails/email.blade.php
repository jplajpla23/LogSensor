<div>
<center><h2>{{ $title }} : {{ $sensor->name }}</h2></center>
<br>
{{ $alert->Message }}
<br><br><br><br>
<hr>
Automatic Generated:

Sensor with name :{{ $sensor->name }} and Mac: {{ $sensor->mac}}  has a new reading of <span style="color: red;">{{ $data->value }}</span> at: {{ $data->created_at }}<br>
<hr>
This alert configurations has:
<br>
Min:{{ $alert->min }} <br>
Max:{{ $alert->max }}

</div>