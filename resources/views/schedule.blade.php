@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'schedule'
])


@section('content')
    <div class="content">
        <div class="row">
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
                                    <th>time</th>
                                    <th>Mon.</th>
                                    <th>Tue.</th> 
                                    <th>Wed.</th> 
                                    <th>Thu.</th>
                                    <th>Fri.</th>                           
                                </thead>
                                <tbody>
                                @foreach(App\Models\Schedule::orderBy('schedule_id')->get() as $schedule) 
                                    <tr id="sid{{$schedule->schedule_id}}">
                                        <td><a href="javascript:void(0)" onclick="editSchedule({{$schedule->schedule_id}})" class="text-dark"> {{ $schedule->work_time }} </a></td>
                                        <td> {{ $schedule->Mon }} </td>
                                        <td> {{ $schedule->Tue }} </td>
                                        <td> {{ $schedule->Wed }} </td>
                                        <td> {{ $schedule->Thu }} </td>
                                        <td> {{ $schedule->Fri }} </td>
                                    </tr> 
                                @endforeach                                
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('function.scheduleTable')
@endsection
