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
Route::get('/sensors', 'SensorController@list')->name('listSensores')->middleware('auth');
Route::get('/sensors/edit/{id}', 'SensorController@edit')->name('editSensor')->middleware('auth');
Route::get('/sensors/newAlert/{id}', 'AlertsController@newAlert')->name('createAlert')->middleware('auth');
Route::post('/sensors/new', 'SensorController@newSave')->name('sensor_creat')->middleware('auth');
Route::post('/sensors/alerts/new', 'AlertsController@newSave')->name('alert_new')->middleware('auth');
Route::post('/sensors/edit', 'SensorController@editSave')->name('sensor_edit')->middleware('auth');
Route::post('/sensors/delete', 'SensorController@delete')->name('deleteSensor')->middleware('auth');
Route::get('/alerts', 'AlertsController@listAlerts')->name('listAlerts')->middleware('auth');
