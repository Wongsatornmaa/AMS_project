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

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');

Route::post('/login', 'Auth\LoginController@login')->name('loginUser');
Route::post('/logout', 'Auth\LoginController@logout')->name('logoutUser');

Route::group(['middleware' => ['member']], function () {

    Route::get('/', 'Auth\LoginController@showLoginForm')->name('login')->withoutMiddleware('member');
    Route::get('/home', 'HomeController@index')->name('homeUser');

    Route::get('/user', 'UserController@view_user')->name('user');

    Route::get('/qrCode', 'PaymentController@view_qr_code')->name('qrCode');

    Route::get('/bank', 'PaymentController@view_bank')->name('bank');

    Route::get('/line', 'PaymentController@view_line')->name('line');

    Route::get('/roomCon', 'RoomContractController@view_contract')->name('roomCon');

    Route::get('/roomHis', 'RoomHistoryController@view_history')->name('roomHis');

    Route::get('/getHis', 'RoomHistoryController@get_history');

    Route::get('/detailHis/{id}', 'RoomHistoryController@view_detail_history');

    Route::post('/updateAccountMember', 'UserController@update')->name('updateAccountMember');
});
