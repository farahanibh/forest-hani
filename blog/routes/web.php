<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MapLocation;
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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');



Route::resource('/user', 'UserController');

//Route::group(['middleware' => ['auth', 'checkUser:admin']], function(){
    Route::resource('/plot', 'PlotController'); 
    Route::post('filterByYear', 'PlotController@filterByYear');
    Route::post('filterByTree', 'TreeController@filterByTree');

    Route::resource('/species', 'SpeciesController');
    Route::resource('/map', 'MapController');

    Route::get('/tree/index', 'TreeController@index')->name('tree.index');
    Route::get('/tree/create', 'TreeController@create')->name('tree.create');
    Route::post('/tree', 'TreeController@store')->name('tree.store');
    Route::get('/tree/{tree}', 'TreeController@show')->name('tree.show');
    Route::get('/tree/{tree}/edit', 'TreeController@edit')->name('tree.edit');
    Route::put('/tree/{tree}', 'TreeController@update')->name('tree.update');
    Route::delete('/tree/{tree}', 'TreeController@destroy')->name('tree.destroy'); 

    Route::get('/tree', 'TreeController@calculateDensity')->name('routeName');

    Route::get('/tph', 'TphController@index')->name('tph');
    Route::get('/bap', 'BapController@index')->name('bap');
    Route::get('/vop', 'VopController@index')->name('vop');

//});
