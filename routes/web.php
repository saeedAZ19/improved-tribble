<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissions;
use App\Http\Controllers\RolePermissionsController;
use App\Http\Controllers\WelcomeController;
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



// Route::prefix('admin')->group(function(){
//     Route::get('/hosptial/index', [HosptialController::class, 'index'])->name('hospital.index');
//     Route::get('/hosptial/create' , [HosptialController::class , 'create']);
//     Route::post('/hosptial/store', [HosptialController::class, 'store']);
//     Route::get('/hosptial/show/{id}', [HosptialController::class, 'show']);
//     Route::put('/hosptial/edit/{id}', [HosptialController::class, 'edit']);
//     Route::post('/hosptial/update/{id}', [HosptialController::class, 'update']);
//     Route::delete('/hosptial/destroy/{id}', [HosptialController::class, 'destroy']);
// });

// Route::get('/welcome', 'WelcomeController@welcome');
// Route::get('/welcome' , [WelcomeController::class , 'welcome']);
// Route::get('/', function () {
//     return view('admin.home');
// })->name('admin.home');


Route::prefix('admin/')->middleware('auth')->group(function(){
    Route::get('home', [AuthController::class, 'dashbord'])->name('admin.home');
    Route::resource('hospitals', HospitalController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('permissions/role', RolePermissionsController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('change-password', [AuthController::class, 'changePassword'])->name('admin.change-password');
    Route::post('change-password', [AuthController::class, 'psotPassword'])->name('admin.post-change');

});
Route::prefix('admin/')->middleware('guest')->group(function () {
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('login', [AuthController::class, 'login'])->name('admin.login');
});


Route::fallback(function () {
    return view('error404');
});

//
////////////////////////////// Front End Routes
Route::get('/',[FrontEndController::class,'home'])->name('home');
