<?php

use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/users','testuserController@getAllPost'); //test
Route::get('/','HomeController@index')->middleware('auth');
Route::get('/home','DashboardController@index')->middleware('auth')->name('home'); //設置name(home)用於route(home)
Route::get('/schedule','ScheduleController@index')->middleware('auth')->name('schedule.index');
Route::get('/classroom/{id}','ComputerController@index')->middleware('auth')->name('classroom.index');
Route::get('/lost_property','LostPropertyController@index')->middleware('auth')->name('property.index');
//lost property
Route::post('/lost_property/create','LostPropertyController@create')->middleware('auth')->name('property.create');
Route::put('/lost_property/{property_id}/update','LostPropertyController@update')->middleware('auth');
Route::delete('/lost_property/{property_id}/delete','LostPropertyController@delete')->middleware('auth');
//schedule
Route::get('/schedule/{schedule_id}/sche_edit','ScheduleController@edit')->middleware('auth');
Route::put('/schedule/update','ScheduleController@update')->middleware('auth')->name('schedule.update');
//computer
Route::post('/classroom/{id}/create','ComputerController@create')->middleware('auth')->name('computer.create');
Route::get('/classroom/{computer_id}/edit','ComputerController@edit')->middleware('auth');
Route::put('/classroom/update','ComputerController@update')->middleware('auth')->name('computer.update');
Route::delete('/classroom/{computer_id}/delete','ComputerController@delete')->middleware('auth');
//monitor
Route::post('/classroom/{id}/moni_create','MonitorController@create')->middleware('auth')->name('monitor.create');
Route::get('/classroom/{monitor_id}/moni_edit','MonitorController@edit')->middleware('auth');
Route::put('/classroom/moni_update','MonitorController@update')->middleware('auth')->name('monitor.update');
Route::delete('/classroom/{monitor_id}/moni_delete','MonitorController@delete')->middleware('auth');
//equipment
Route::get('/classroom/{equipment_id}/equip_edit','EquipmentController@edit')->middleware('auth');
Route::put('/classroom/equip_update','EquipmentController@update')->middleware('auth')->name('equipment.update');
//patrol
Route::get('/patrol','PatrolController@index')->middleware('auth')->name('patrol.index');
Route::post('/patrol/create','PatrolController@create')->middleware('auth')->name('patrol.create');
Route::get('/patrol/{patrol_id}/patrol_edit','PatrolController@edit')->middleware('auth');
Route::put('/patrol/update','PatrolController@update')->middleware('auth')->name('patrol.update');
Route::delete('/patrol/{patrol_id}/delete','PatrolController@delete')->middleware('auth');
//classroom status
Route::get('/patrol/changeStatus','PatrolController@changeStatus')->middleware('auth')->name('classroom.changeStatus');
//sendEmail
Route::get('/classroom/{computer_id}/email','MailController@computer_index')->middleware('auth');
Route::post('/classroom/sendemail','MailController@sendEmail')->middleware('auth')->name('sendEmail');
Route::get('/classroom/{monitor_id}/moni_email','MailController@monitor_index')->middleware('auth');

//login and register
Auth::routes();

// usage inside a laravel route test
Route::get('/testtest', function()
{
    $img = Image::make('https://exfast.me/wp-content/uploads/2019/04/1554182762-cddf42691119d44059a16a4095047a33-1140x600.jpg')->resize(300, 200); // 這邊可以隨便用網路上的image取代
    return $img->response('jpg');
    return view('dashboard');
});

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource('/posts',PostController::class)->middleware('auth');
//設置名為auth的middleware,代表這個控制器內的所有函數都需要在登入的狀態下才能存取