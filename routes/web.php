<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Site;
use App\Http\Controllers\Admin;

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

Route::get('/', [Site::class, 'index']);

Route::get('/registration', [Site::class, 'registrationView']);
Route::post('/registration', [Site::class, 'registration']);

Route::post('/admin', [Admin::class, 'login']);

Route::get('/admin', function(Request $request) {
    if (!$request->session()->exists('user')) {
        return view('admin/login');
    } else {
        return redirect('admin/landing');
    }
});

Route::group(['middleware' => 'usersession'], function () {

    Route::get('/admin/landing', [Admin::class, 'landing']);
    Route::get('/admin/vaccines', [Admin::class, 'vaccines']);
    Route::get('/admin/vaccine/{id?}', [Admin::class, 'vaccine']);
    Route::post('/admin/vaccine', [Admin::class, 'vaccineSave']);
    Route::get('/admin/applications', [Admin::class, 'applications']);
    //Route::post('/admin', [Quiz::class, 'landing']);

});