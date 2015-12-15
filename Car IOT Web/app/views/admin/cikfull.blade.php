@extends('admin.adminlayout')

@section('content')
 
<div class="box box-success">
 <div align="left" id="paglink"> </div>
                <table class="table table-bordered">
                 <thead>
                        <tr>
                            
                            <th>CIK Name</th>
                            <th>CIK Dashboard Id</th>
                            <th>CIK Device Rid</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php foreach ($ciklist as $cik) { ?> 
                            <tr>
                                <td>{{$cik->name}}</td>
                                <td>{{$cik->dashboard_id}}</td>
                                <td>{{$cik->device_rid}}</td>

                            </tr>
                          <?php } ?>  
                    </tbody>
                </table>
         


</div>

        <div align="left" id="paglink"> </div>

      </div>
@stop