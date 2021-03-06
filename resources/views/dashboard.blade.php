@extends('layouts.app', [
    'class' => ' ',
    'elementActive' => 'dashboard'
])

@section('content')

<div class="content">
          
            <!-- Tab -->
            <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row" onclick="openPage('ComputerTable', this)"  >
                            <div class="col-5 col-md-4">
                            <div class="text-warning">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fas fa-desktop"></i>
                                </div>
                            </div>
                            </div>
                            <div class="col-7 col-md-8">
                            @php($count=App\Models\Post::where('status','維修中')->count())
                            <p class="text-info font-weight-bold" style="background-color:white;outline:none; font-size:24px; border:none;" id="defaultOpen">Computer</p>
                                <div class="numbers">
                                    <p class="card-title">{{$count}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats ">
                           <i class="fas fa-tools"></i> 主機維修數目
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row" onclick="openPage('MonitorTable', this)" >
                            <div class="col-5 col-md-4">
                            <div class="text-success">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fas fa-desktop"></i>
                                </div>
                            </div>
                            </div>
                            <div class="col-7 col-md-8">
                            @php($count=App\Models\Monitor::where('status','維修中')->count())
                            <p class="text-info font-weight-bold" style="background-color:white;outline:none; font-size:24px; border:none;" >Monitor</p>
                                <div class="numbers">
                                    <p class="card-title">{{$count}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats ">
                           <i class="fas fa-tools"></i> 螢幕維修數目
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row" onclick="openPage('EquipmentTable', this)">
                            <div class="col-5 col-md-4" >
                            <div class="text-danger">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fas fa-desktop"></i>
                                </div>
                            </div>
                            </div>
                            <div class="col-7 col-md-8">
                            @php($count1=App\Models\Equipment::where('status','有問題尚未報修')->count())
                            @php($count2=App\Models\Equipment::where('status','已報修')->count())
                            <p class="text-info font-weight-bold"  style="background-color:white;outline:none; font-size:24px; border:none;">Equipment</p>
                                <div class="numbers">
                                    <p class="card-title">{{$count = $count1 + $count2 }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats ">
                           <i class="fas fa-tools"></i> 設備維修數目
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row" >
                            <div class="col-5 col-md-4">
                            <div class="text-primary">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fas fa-desktop"></i>
                                </div>
                            </div>
                            </div>
                            <div class="col-7 col-md-8">
                            @php($count=App\Models\Classroom::where('status','1')->count())
                            <p class="text-info font-weight-bold" style="background-color:white;outline:none; font-size:24px; border:none;" >Classroom</p>
                                <div class="numbers">
                                    <p class="card-title">{{$count}}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats ">
                           <i class="fas fa-tools"></i> 教室開啟數目
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <!-- computer table --> 
            <div id="ComputerTable" class="tabcontent">
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-body">
                                <table class="table">
                                    <thead class="text-primary ">
                                        <th>Computer Name</th>
                                        <th>Asset Number</th>
                                        <th>Status</th>                          
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Post::where('status','維修中')->get() as $post)
                                        <tr>
                                            <td>{{ $post->name }}</td>
                                            <td>{{ $post->asset_num }}</td>
                                            <td>{{ $post->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card ">
                        <div class="card-body">
                                <table class="table" >
                                <thead class="text-primary">
                                    <th>
                                        classroom number
                                    </th>
                                    <th>
                                        status
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Classroom::orderBy('id')->get() as $classroom)
                                    <tr>
                                        <td>{{ $classroom->classroom }}</td>
                                        <td>@if($classroom->status === '0') CLOSE
                                                @else OPEN
                                                @endif
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

        <!--equipment table-->
            <div id="EquipmentTable" class="tabcontent">
                <div class="row">
                    <div class="col-md-8">
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
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Equipment::where('status', '有問題尚未報修' )->get() as $equipment)
                                        <tr>
                                            <td>{{ $equipment->name }}</td>
                                            <td>{{ $equipment->status }}</td>
                                        </tr>
                                        @endforeach
                                        @foreach(App\Models\Equipment::where('status', '已報修' )->get() as $equipment)
                                        <tr>
                                            <td>{{ $equipment->name }}</td>
                                            <td>{{ $equipment->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="card ">
                        <div class="card-body">
                                <table class="table" >
                                <thead class="text-primary">
                                    <th>
                                        classroom number
                                    </th>
                                    <th>
                                        status
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Classroom::orderBy('id')->get() as $classroom)
                                    <tr>
                                        <td>{{ $classroom->classroom }}</td>
                                        <td>@if($classroom->status === '0') CLOSE
                                                @else OPEN
                                                @endif
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
            
        <!--monitor table-->
            <div id="MonitorTable" class="tabcontent">
                <div class="row">
                    <div class="col-md-8">
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
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Monitor::where('status','維修中' )->get() as $monitor)
                                        <tr>
                                            <td>{{ $monitor->name }}</td>
                                            <td>{{ $monitor->snid }}</td>
                                            <td>{{ $monitor->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="card ">
                        <div class="card-body">
                                <table class="table" >
                                <thead class="text-primary">
                                    <th>
                                        classroom number
                                    </th>
                                    <th>
                                        status
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Classroom::orderBy('id')->get() as $classroom)
                                    <tr>
                                        <td>{{ $classroom->classroom }}</td>
                                        <td>@if($classroom->status === '0') CLOSE
                                                @else OPEN
                                                @endif
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


           
        <!--Work Schedule-->
        <!-- <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="text-center">
                <h4 class="card-title">Work Schedule</h4>
                </div>
            </div>
            <div class="card-body">
                    <table id="WorkSchedule" class="table">
                        <thead class="text-primary">
                            <th>8:00-9:00</th>
                            <th>9:00-10:00</th>
                            <th>10:00-11:00</th> 
                            <th>11:00-12:00</th> 
                            <th>12:00-13:00</th>
                            <th>13:00-14:00</th>
                            <th>14:00-15:00</th>                          
                        </thead>
                        <tbody>
                        @php($a=date('D'))
                     
                            <tr>                
                                @foreach(App\Models\Schedule::where('schedule_id','<','7')->get() as $schedule)        
                                <td> {{ $schedule->$a }} </td>
                                @endforeach  
                            </tr> 
                                            
                        </tbody>
                        <thead class="text-primary">
                            <th>15:00-16:00</th> 
                            <th>16:00-17:00</th>
                            <th>17:00-18:00</th> 
                            <th>18:00-19:00</td>
                            <th>19:00-20:00</th>
                            <th>20:00-21:00</th>
                            <th>21:00-22:00</th>                      
                        </thead>
                        <tbody>
                        @php($a=date('D'))
                     
                            <tr>              
                                @foreach(App\Models\Schedule::where('schedule_id','>=','7')->get() as $schedule)        
                                <td> {{ $schedule->$a }} </td>
                                   
                                @endforeach  
                            </tr> 
                                            
                        </tbody>
                    </table>
            </div>
        </div>
        </div>
        </div> -->
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

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
@endpush