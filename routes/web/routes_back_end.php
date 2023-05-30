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

Route::get('login', 'Auth\LoginController@showLoginForm')->middleware('guest');

Route::post('login', 'Auth\LoginController@login')->name('loginAdmin');
Route::post('logout', 'Auth\LoginController@logout')->name('logoutAdmin');


Route::group(['middleware' => ['admin']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/manageBill', 'BillRoomController@index')->name('bill');

    Route::get('/editBill/{id}', 'BillRoomController@editPage')->name('editBill');

    Route::get('/getBill', 'BillRoomController@getBill');

    Route::post('/updateBill', 'BillRoomController@updateBill');

    

    Route::get('/viewBill/{id}', 'BillRoomController@viewBill');

    Route::get('/formAms', 'HomeController@form')->name('formAms');

    Route::get('/getRoom', 'RoomController@getRoom');

    Route::get('/getDeposit', 'RoomController@getDeposit');

    Route::post('/createMemberInfo', 'UserMemberController@createInfoMember')->name('createMemberInfo');

    Route::get('/viewAms', 'RoomController@viewAms')->name('viewAms');
    
    Route::get('/seedetail/{id}','RoomController@SeeDetail')->name('seeDetail');

    Route::get('/viewEditAms/{id}', 'UserMemberController@viewEdit')->name('viewEditAms');

    Route::post('/updateAms/{id}', 'UserMemberController@updateAms')->name('updateAms');

    Route::get('/addInfo', 'HomeController@addInfo')->name('addInfo');

    Route::post('/save_info', 'BuildingController@create')->name('saveInfo');


    Route::get('/editInfo/{id}', 'BuildingController@editPage')->name('editInfo');

    Route::post('/update/{id}', 'BuildingController@update')->name('update');

    Route::get('/addAc', 'UserMemberController@addAccount')->name('addAc');

    //หน้าสร้างบัญชีผู้ใช้
    Route::post('/addAccount', 'UserMemberController@addAccountMember')->name('addAccount');
    Route::get('/accountMangement', 'UserMemberController@index')->name('accountIndex');
    Route::get('/editAc/{id}', 'UserMemberController@editPage')->name('editAc');
    Route::post('/updateAccount/{id}', 'UserMemberController@update')->name('updateAccount');
    Route::post('/deleteAccount/{id}', 'UserMemberController@delete')->name('deleteAccount');

    Route::get('/pdf/{id}', 'PDFController@ExportPdf');

    Route::get('/billPdf', 'PDFController@showBill');

    Route::post('/save_bill/{id}', 'BillRoomController@update')->name('saveBill');
});
