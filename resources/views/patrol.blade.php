@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'patrol'
])


@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <!--ADD FORM-->
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                        <h4 class="card-title">Add patrol</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="patrolForm">
                            @csrf   
                            <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="staff" name="staff" value="{{ Auth::user()->name }}" />
                            </div>
                            <div class="form-group">
                                <label for="patrol_time">Patrol Time</label>
                                <input class="form-control" type="date" id="patrol_date" name="patrol_date">
                                <input class="form-control" type="time"  id="patrol_time" name="patrol_time">  
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <textarea class="form-control" id="status" name="status" rows="5" placeholder="輸入巡邏狀況"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </form>
                    </div>
                </div>
                <!--CLASS-->
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                        <h4 class="card-title">Classroom</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="ClassroomStatus" class="table">
                            <thead class="text-primary text-center">
                                <th>Classroom</th>
                                <th> </th>                    
                            </thead>
                            <tbody class="text-center"> 
                            @foreach(App\Models\Classroom::orderBy('id')->get() as $classroom)
                                <tr>
                                    <td>{{ $classroom->classroom }}</td>
                                    <td>
                                    <div class="custom-control custom-switch">
                                        <input id="customSwitches{{ $classroom->id }}" data-id="{{ $classroom->id }}" class="custom-control-input" type="checkbox" {{ $classroom->status == true ? 'checked' :'' }}>
                                        <label class="custom-control-label" for="customSwitches{{ $classroom->id }}"></label>
                                        <span id="description{{ $classroom->id }}" class="custom-control-description">
                                            @if($classroom->status === '0') CLOSE
                                            @else OPEN
                                            @endif
                                        </span>
                                    </div>  
                                    </td>
                                </tr>
                            @endforeach                                 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
            <!--table-->
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                        <h4 class="card-title">Patrol Table</h4>
                        </div>
                    </div>
                    <div class="card-body">
                            <table id="patrolTable" class="table" >
                                <thead class="text-primary text-center">
                                    <th>Staff</th>
                                    <th>Patrol time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <!-- <th> </th> -->
                                </thead>
                                <tbody class="text-center"> 
                                @foreach($patrols as $patrol)
                                    <tr id="sid{{$patrol->patrol_id}}">
                                        <td>{{ $patrol->staff }}</td>
                                        <td>{{ $patrol->patrol_time }}</td>
                                        <td>{{ $patrol->status }}</td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="editPatrol({{$patrol->patrol_id}})" class="btn btn-info ">Edit</a>
                                            <a href="javascript:void(0)" onclick="deletePatrol({{$patrol->patrol_id}})" class="btn btn-danger">Delete</a>
                                        </td>
                                        <!-- <td>
                                            <button type="button" class="close" aria-label="Close" href="javascript:void(0)" onclick="deletePatrol({{$patrol->patrol_id}})"">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </td> -->
                                    </tr>
                                @endforeach                                 
                                </tbody>
                            </table>
                            {{ $patrols -> links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('function.patrolTable')
@include('function.classroomTable')
@endsection
