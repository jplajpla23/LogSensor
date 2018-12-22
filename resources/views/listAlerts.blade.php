@extends('layouts.app')
@section('content')

<div class="container">
    <span id="error" style="display: none!important;">{{$errors->any()}}</span>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><h4>List My Alerts</h4></center></div><br>
                <div class="card-body">
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
                    <table id="example" class="display dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>sensorName</th>
                                <th>Description</th>
                                <th>Message</th>
                                <th>Safe Range</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <style type="text/css">
                            .
                        </style>
                        @foreach ($alerts as $s)
                        @foreach ($s as $a)
                        <tr>
                           <td>{{$a->nameSensor}}</td>
                           <td>{{$a->Description}}</td>
                           <td>{{$a->Message}}</td>
                           <td>{{$a->min}}<-->{{$a->max}}</td>
                           <td>Actions</td>
                       </tr>
                       @endforeach
                       @endforeach
                   </tbody>

               </table>
           </div>
       </div>
   </div>
</div>
</div>
<script src="/js/dataTables.rowGroup.min.js"></script>

<script src="/js/rowGroup.jqueryui.min.js"></script>
<script type="text/javascript">
    var jQuery_2_1_4 = $.noConflict(true);
    jQuery_2_1_4(document).ready(function() {
        jQuery_2_1_4('.dataTable').DataTable({
            "lengthMenu": [[ 5, 10, 15, 25, 50, -1], [5, 10, 15, 25, 50, "All"]],
            "pageLength": 15,
            "autoWidth": true,
            "rowGroup": {
                startRender: function ( rows, group ) {
                 /* var count = rows
                        .data()
                        .pluck(7)
                        .reduce( function (a, b) {
                            return parseFloat(a) + parseFloat(b);
                        }, 0);*/ //funçao que conta a qantidade disponivel conta os valores da tabela
                        
                        return "<center style=\"background-color:#e0e0e0!important\";width:100%!important;height:100%!important;><b>"+group+"</b></center>";
                    },
                    endRender: null,
                    "dataSrc": 0,
                },
                "ordering": true,
                "orderFixed": {
                    "pre":  [[ 0, 'asc' ]]
                },
                "language": {
                    
                    "info": "Showing _START_ to _END_ Total: _TOTAL_ ",
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                        "first": "<<",
                        "last": ">>"
                    },
                    "sLengthMenu": "<div class='d-inline-block'><span>Show&nbsp;&nbsp;</span></div><div class='d-inline-block'> _MENU_ </div>"
                },

                "columnDefs": [
                {
                    "targets": [0],
                    "visible": false
                }],
                "pagingType": "full_numbers",
                "bInfo" : true
            });


    } );

</script>
<style type="text/css">
tr
{
    margin: 0!important;
}
</style>

@endsection
