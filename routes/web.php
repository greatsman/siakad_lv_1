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
    // return view('home');
    return redirect('/dashboard');
});
// route untuk login
Route::get('/login', 'AuthController@login')->name('login');
// route untuk proses login
Route::post('/postlogin', 'AuthController@postlogin');
// route untuk logout
Route::get('/logout', 'AuthController@logout');
// route untuk group yang harus login
Route::group(['middleware' => ['auth','checkRole:admin']], function () {
        // route untuk dashboard
    Route::get('/dashboard', 'DashboardController@index');
    // route untuk halaman siwa
    Route::get('/siswa', 'SiswaController@index');
    // route untuk proses menambahkan siswa
    Route::post('/siswa/create', 'SiswaController@create');
    // route untuk halaman edit siswa
    Route::get('/siswa/edit/{data_siswa}', 'SiswaController@edit');
    // route untuk proses update siswa
    Route::post('/siswa/update/{data_siswa}', 'SiswaController@update');
    // route untuk proses delet siswa
    Route::get('/siswa/delete/{data_siswa}', 'SiswaController@delete');
    // route untuk lihat profile
    Route::get('/siswa/profile/{data_siswa}', 'SiswaController@profile');
     // route untuk tambah nilai
    Route::post('/siswa/addnilai/{data_siswa}', 'SiswaController@addnilai');
     // route untuk delete nilai
    Route::get('/siswa/deletenilai/{id}/{id_mapel}', 'SiswaController@deletenilai');
    // route untuk siswa export excel
    Route::get('/siswa/exportexcel', 'SiswaController@exportExcel');
    // route untuk siswa export excel
    Route::get('/siswa/exportpdf', 'SiswaController@exportPDF');
    // route untuk melihat profile guru
    Route::get('/guru/profile/{id}','GuruController@profile');
});

Route::group(['middleware' => ['auth','checkRole:admin,siswa']], function () {
        // route untuk dashboard
    Route::get('/dashboard', 'DashboardController@index');
});
