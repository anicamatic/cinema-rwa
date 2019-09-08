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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/all-projections', 'HomeController@allProjections')->name('all-projections');
Route::get('/projection/{projectionId}', 'HomeController@singleProjection')->name('single-projection');
Route::get('/reserve-seat/{projectionSeatId}', 'HomeController@reserveSeat')->name('reserve-seat');

Route::prefix('admin')->name('admin.')->middleware('adminMiddleware')->group(function() {
    Route::get('/', 'AdminController@index')->name('index');

    Route::get('/halls/all', 'AdminController@allHals')->name('all-hals');
    Route::get('/halls/create', 'AdminController@renderCreateHall')->name('render-create-hall');
    Route::post('/halls/create', 'AdminController@createHall')->name('create-hall');
    Route::get('/halls/delete/{hallId}', 'AdminController@deleteHall')->name('delete-hall');
    Route::get('/halls/single/{hallId}', 'AdminController@singleHall')->name('single-hall');
    Route::post('/halls/update/{hallId}', 'AdminController@updateHall')->name('update-hall');

    Route::get('/movies/all', 'AdminController@allMovies')->name('all-movies');
    Route::get('/movies/create', 'AdminController@renderCreateMovie')->name('render-create-movie');
    Route::post('/movies/create', 'AdminController@createMovie')->name('create-movie');
    Route::get('/movies/delete/{movieId}', 'AdminController@deleteMovie')->name('delete-movie');
    Route::get('/movies/single/{movieId}', 'AdminController@singleMovie')->name('single-movie');
    Route::post('/movies/update/{movieId}', 'AdminController@updateMovie')->name('update-movie');

    Route::get('/projections/all', 'AdminController@allProjections')->name('all-projections');
    Route::get('/projections/create', 'AdminController@renderCreateProjection')->name('render-create-projection');
    Route::post('/projections/create', 'AdminController@createProjection')->name('create-projection');
    Route::get('/projections/delete/{projectionId}', 'AdminController@deleteProjection')->name('delete-projection');

    Route::get('/users/all', 'AdminController@allUsers')->name('all-users');
    Route::post('/users/role-change/{userId}', 'AdminController@changeUserRole')->name('role-change');

    Route::get('/reservations/all', 'AdminController@allReservations')->name('all-reservations');
    Route::get('/reservations/delete/{reservationSeatId}', 'AdminController@deleteReservations')->name('delete-reservation');
});
