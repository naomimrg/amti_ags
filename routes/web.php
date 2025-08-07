<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['guest']], function() {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    //SUPER ADMIN
    Route::get('/dashboard/listLokasi', [App\Http\Controllers\Admin\DashboardController::class, 'listLokasi']);
    Route::get('/dashboard/listLokasiSSE', [App\Http\Controllers\Admin\DashboardController::class, 'listLokasiSSE']);
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //User
    Route::get('/user/list-user', [App\Http\Controllers\Admin\UserController::class, 'list']);
    Route::resource('/user', 'App\Http\Controllers\Admin\UserController');

    //Admin
    Route::get('/admin/list-admin', [App\Http\Controllers\Admin\AdminController::class, 'list']);
    Route::resource('/admin', 'App\Http\Controllers\Admin\AdminController');

    //Parameter
    Route::get('/parameter/list-parameter', [App\Http\Controllers\Admin\ParameterController::class, 'listParameter']);
    Route::get('/client_sensor', [App\Http\Controllers\Admin\ParameterController::class, 'sensor_client']);
    Route::get('/client_sensor/listParameterClient', [App\Http\Controllers\Admin\ParameterController::class, 'listParameterClient']);
    Route::put('/client_sensor/{id}', [App\Http\Controllers\Admin\ParameterController::class, 'updateData']);
    Route::get('/client_sensor/{id}/edit', [App\Http\Controllers\Admin\ParameterController::class, 'editData']);
	Route::delete('/client_sensor/{id}', [App\Http\Controllers\Admin\ParameterController::class, 'deleteSensor']);
    Route::resource('/parameter', 'App\Http\Controllers\Admin\ParameterController');


    Route::get('/vendor/{id}/{lokasiId}', [App\Http\Controllers\Admin\VendorController::class, 'lokasiList']);
    Route::get('/vendor/{id}/{lokasiId}/live_sensor', [App\Http\Controllers\Admin\VendorController::class, 'listLiveSensor']);
    Route::get('/vendor/{id}/{lokasiId}/live_sensor/{spanId}', [App\Http\Controllers\Admin\VendorController::class, 'spanList']);
    Route::get('/vendor/listVendor', [App\Http\Controllers\Admin\VendorController::class, 'listVendor']);
    Route::get('/listLokasi/{id}', [App\Http\Controllers\Admin\VendorController::class, 'listLokasi']);
    Route::get('/listSpan/{id}', [App\Http\Controllers\Admin\VendorController::class, 'listSpan']);
    Route::get('/listSpanSSE/{id}', [App\Http\Controllers\Admin\VendorController::class, 'listSpanSSE']);
    Route::get('/listSensor/{id}', [App\Http\Controllers\Admin\VendorController::class, 'listSensor']);
    Route::get('/editVendor/{id}', [App\Http\Controllers\Admin\VendorController::class, 'editVendor']);
    Route::get('/editLokasi/{id}', [App\Http\Controllers\Admin\VendorController::class, 'editLokasi']);

    Route::post('/updateVendor', [App\Http\Controllers\Admin\VendorController::class, 'updateVendor']);
    Route::post('/updateLokasi', [App\Http\Controllers\Admin\VendorController::class, 'updateLokasi']);
    Route::post('/updateLiveSpan', [App\Http\Controllers\Admin\VendorController::class, 'updateLiveSpan']);
    Route::post('/updatePositionSpan', [App\Http\Controllers\Admin\VendorController::class, 'updatePositionSpan']);
    Route::post('/insertSensor/{id}', [App\Http\Controllers\Admin\VendorController::class, 'updateSensor']);

    Route::delete('/deleteLokasi/{id}', [App\Http\Controllers\Admin\VendorController::class, 'deleteLokasi']);
    Route::delete('/deleteSpan/{id}', [App\Http\Controllers\VendorController::class, 'deleteSpan']);

    Route::post('/insertLokasi', [App\Http\Controllers\Admin\VendorController::class, 'insertLokasi']);
    Route::post('/insertSpan', [App\Http\Controllers\Admin\VendorController::class, 'insertSpan']);
    Route::post('/insertSensor', [App\Http\Controllers\Admin\VendorController::class, 'insertSensor']);



    Route::resource('/vendor', 'App\Http\Controllers\Admin\VendorController');

    //Admin Vendor
    Route::get('/sensor/list-parameter', [App\Http\Controllers\VendorController::class, 'listSensor']);
    //Route::get('/sensor', [App\Http\Controllers\VendorController::class, 'sensor']);

    Route::get('/getLoc', [App\Http\Controllers\VendorController::class, 'listLoc']);
    Route::get('/listSpanLokasi/{id}', [App\Http\Controllers\VendorController::class, 'listSpanLokasi']);

    Route::get('/listLokasiSpan/{id}', [App\Http\Controllers\VendorController::class, 'listLokasiSpan']);
    Route::get('/live_sensor/chartList', [App\Http\Controllers\VendorController::class, 'chartList']);
    Route::get('/home/{id}/live_sensor', [App\Http\Controllers\VendorController::class, 'liveSensor']);
    Route::get('/home/{id}/live_sensor/{spanId}', [App\Http\Controllers\VendorController::class, 'dataSensor']);
    Route::get('/editSpan/{id}', [App\Http\Controllers\VendorController::class, 'editSpan']);
    Route::post('/updateSpan', [App\Http\Controllers\VendorController::class, 'updateSpan']);
    Route::get('/home/{id}', [App\Http\Controllers\VendorController::class, 'index']);
    Route::get('/live_sensor/natFreqChartList', [App\Http\Controllers\VendorController::class, 'natFreqChartList']);

    //Report
    Route::get('/report/list-report', [App\Http\Controllers\ReportController::class, 'listReport']);
    Route::get('/report/chartNat', [App\Http\Controllers\ReportController::class, 'chartNat']);
    Route::get('/report/chartList', [App\Http\Controllers\ReportController::class, 'chartList']);
    Route::get('/report/downloadExcel', [App\Http\Controllers\ReportController::class, 'downloadExcel']);

    Route::get('/report', [App\Http\Controllers\ReportController::class, 'index']);

    //ALL
    Route::get('/getProfile', [App\Http\Controllers\SettingController::class, 'getProfile']);
    Route::get('/profile', [App\Http\Controllers\SettingController::class, 'index']);
    Route::post('/updateProfile', [App\Http\Controllers\SettingController::class, 'updateProfile'])->name('updateProfile');

});