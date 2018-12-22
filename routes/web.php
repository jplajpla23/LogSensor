<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/userEdit', 'HomeController@editUser')->name('editUser')->middleware('auth');
Route::post('/userEdit', 'HomeController@editUserSave')->name('userEditSave')->middleware('auth');
///////////////////////////////////////////////////////////////////
Route::get('/sensors', 'SensorController@list')->name('listSensores')->middleware('auth');
Route::get('/sensors/edit/{id}', 'SensorController@edit')->name('editSensor')->middleware('auth');
Route::post('/sensors/new', 'SensorController@newSave')->name('sensor_creat')->middleware('auth');
Route::post('/sensors/edit', 'SensorController@editSave')->name('sensor_edit')->middleware('auth');
Route::post('/sensors/delete', 'SensorController@delete')->name('deleteSensor')->middleware('auth');
////////////////////////////////////////////////////////////////////
Route::post('/alerts/delete', 'AlertsController@delete')->name('deleteAlert')->middleware('auth');
Route::get('/alerts', 'AlertsController@listAlerts')->name('listAlerts')->middleware('auth');
Route::post('/sensors/alerts/new', 'AlertsController@newSave')->name('alert_new')->middleware('auth');
Route::get('/sensors/newAlert/{id}', 'AlertsController@newAlert')->name('createAlert')->middleware('auth');
Route::get('/alerts/edit/{id}', 'AlertsController@edit')->name('editAlert')->middleware('auth');
Route::post('/alerts/new', 'AlertsController@editSave')->name('editAlertSave')->middleware('auth');
