@extends('layouts.app', [
    'class' => '',
    'elementActive' => $id
])


@section('content')
    <div class="content">
        <div class="col-md-12">
            <h3 class="card-title">電腦教室 {{$id}}</h3>
            <!-- Tab -->
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic radio toggle button group">
                <button class="tablink btn btn-outline-info" onclick="openPage('ComputerTable', this)" id="defaultOpen">Computer</button>
                <button class="tablink btn btn-outline-info" onclick="openPage('MonitorTable', this)" >Monitor</button>
                <button class="tablink btn btn-outline-info" onclick="openPage('EquipmentTable', this)" >Equipment</button>
            </div>
        </div>
        <!-- computer table --> 
        <div class="col-md-12">
            <div id="ComputerTable" class="tabcontent">
                <div class="card">
                    <div class="card-body">
                            <table id="computerTable" class="table">
                                <thead class="text-primary ">
                                    <th>Computer Name</th>
                                    <th>Asset Number</th>
                                    <th>Status</th>
                                    <th class="text-center">Action
                                    <a href="#" class="fas fa-plus-circle" data-toggle="modal" data-target="#computerModal"></a>
                                    </th>
                                    <th></th>                               
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Post::where('classroom_id', $id )->get() as $post)
                                    <tr id="sid{{$post->computer_id}}">
                                        <td><a href="javascript:void(0)" onclick="sendEmail({{$post->computer_id}})" class="text-dark">{{ $post->name }}</a></td>
                                        <td>{{ $post->asset_num }}</td>
                                        <td>{{ $post->status }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" onclick="editComputer({{$post->computer_id}})" class="btn btn-info">Edit</a>
                                            <a href="javascript:void(0)" onclick="deleteComputer({{$post->computer_id}})" class="btn btn-danger">delete</a>
                                            
                                        </td>
                                        <td>
                                            <!-- <a href="javascript:void(0)" onclick="sendEmail({{$post->computer_id}})" class="far fa-envelope fa-2x"></a> -->
                                        </td>
                                        <!-- <td>
                                            <button type="button" class="close" aria-label="Close" href="javascript:void(0)" onclick="deleteComputer({{$post->computer_id}})">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
                <h3 class="card-title">倉庫備品</h3>
                <div class="card">
                    <div class="card-body">
                            <table id="bucomputerTable" class="table">
                                <thead class="text-primary ">
                                    <th>Computer Name</th>
                                    <th>Asset Number</th>
                                    <th>Status</th>
                                    <th class="text-center">Action
                                    <a href="#" class="fas fa-plus-circle" data-toggle="modal" data-target="#bucomputerModal"></a>
                                    </th>
                                    <th></th>                               
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Post::where('classroom_id', '7' )->orderby('name','asc')->get() as $backup)
                                    <tr id="busid{{$backup->computer_id}}">
                                        <td>{{$backup->name }}</td>
                                        <td>{{ $backup->asset_num }}</td>
                                        <td>{{ $backup->status }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" onclick="editBackupComputer({{$backup->computer_id}})" class="btn btn-info">Edit</a>
                                            <a href="javascript:void(0)" onclick="deleteBackupComputer({{$backup->computer_id}})" class="btn btn-danger">delete</a>
                                            
                                        </td>
                                        <td>
                                            <!-- <a href="javascript:void(0)" onclick="sendEmail({{$post->computer_id}})" class="far fa-envelope fa-2x"></a> -->
                                        </td>
                                        <!-- <td>
                                            <button type="button" class="close" aria-label="Close" href="javascript:void(0)" onclick="deleteComputer({{$post->computer_id}})">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        <!--equipment table-->
        <div class="col-md-12">
            <div id="EquipmentTable" class="tabcontent">
                <div class="card">
                    <div class="card-body">
                            <table class="table">
                                <thead class="text-primary ">
                                    <th>
                                        Equipment
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th class="text-center">
                                        Action      
                                    </th> 
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Equipment::where('classroom_id', $id )->get() as $equipment)
                                    <tr id="eid{{$equipment->equipment_id}}">
                                        <td>{{ $equipment->name }}</td>
                                        <td>{{ $equipment->status }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)"  onclick="editEquipment({{$equipment->equipment_id}})" class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        <!--monitor table-->
        <div class="col-md-12">
            <div id="MonitorTable" class="tabcontent">
                <div class="card">
                    <div class="card-body">
                            <table id="monitorTable" class="table">
                                <thead class="text-primary">
                                    <th>
                                        Monitor name
                                    </th>
                                    <th>
                                        SNID
                                    </th>
                                    <th>
                                        status
                                    </th>
                                    <th class="text-center">Action
                                    <a href="#" class="fas fa-plus-circle" data-toggle="modal" data-target="#monitorModal"></a>    
                                    </th> 
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Monitor::where('classroom_id', $id )->get() as $monitor)
                                    <tr id="sid{{$monitor->monitor_id}}">
                                        <td><a href="javascript:void(0)" onclick="sendEmail_Monitor({{$monitor->monitor_id}})" class="text-dark">{{ $monitor->name }}</a></td>
                                        <td>{{ $monitor->snid }}</td>
                                        <td>{{ $monitor->status }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" onclick="editMonitor({{$monitor->monitor_id}})" class="btn btn-info">Edit</a>
                                            <a href="javascript:void(0)" onclick="deleteMonitor({{$monitor->monitor_id}})" class="btn btn-danger" >Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
                <h3 class="card-title">倉庫備品</h3>
                <div class="card">
                    <div class="card-body">
                            <table id="backupTable" class="table">
                                <thead class="text-primary">
                                    <th>
                                        Monitor name
                                    </th>
                                    <th>
                                        SNID
                                    </th>
                                    <th>
                                        status
                                    </th>
                                    <th class="text-center">Action
                                    <a href="#" class="fas fa-plus-circle" data-toggle="modal" data-target="#bumonitorModal"></a>    
                                    </th> 
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Monitor::where('classroom_id', '7' )->orderby('name','asc')->get() as $monitor)
                                    <tr id="busid{{$monitor->monitor_id}}">
                                        <td>{{ $monitor->name }}</td>
                                        <td>{{ $monitor->snid }}</td>
                                        <td>{{ $monitor->status }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" onclick="editBackupMonitor({{$monitor->monitor_id}})" class="btn btn-info">Edit</a>
                                            <a href="javascript:void(0)" onclick="deleteBackupMonitor({{$monitor->monitor_id}})" class="btn btn-danger" >Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


<script>
    function openPage(pageName,elmnt) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    document.getElementById(pageName).style.display = "block";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>



@include('function.computerTable')
@include('function.equipmentTable')
@include('function.monitorTable')
@include('function.backupmonitorTable')
@include('function.backupcomputerTable')
@endsection

   