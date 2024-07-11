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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/request-reset', 'UserController@request_reset_password')->name('request.reset');

Route::view('/catalogue-view', 'pages.catalogue');

Route::get('/library/books', 'LibraryBookController@getLibraryBooks')->name('books');
Route::get('/library/get-book', 'CirculationController@getBook')->name('get.book');
Route::get('/masterlist/get-book', 'LibraryBookController@getBook')->name('get.masterlist.book');
Route::get('/pinbook', 'LibraryBookController@pin_book')->name('request.pinbook');
Route::get('/clear-session', 'UserController@clear_session');

Route::middleware(['web'])->group(function () {
    Route::get('/catalogue-signin', 'UserController@catalogue_signin')->name('catalogue.signin');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::view('/change-pass', 'pages.changepass');
    // CHANGE PASSWORD
    Route::match(['get','post'],'/update-password', 'UserController@updatePassword')->name('update.password');

    // CATALOGING
    Route::view('/cataloging', 'pages.cataloging');
    // Route::get('/library/books', 'LibraryBookController@getLibraryBooks')->name('books');
    // Route::get('/library/get-book', 'CirculationController@getBook')->name('get.book');
    // Route::get('/masterlist/get-book', 'LibraryBookController@getBook')->name('get.masterlist.book');
    Route::get('/getbyborrower', 'CirculationController@getCirculationByBorrower')->name('getCirculationByBorrower');
    Route::view('/view/profile', 'pages.profile');
    Route::post('/profile-update', 'UserController@update_profile')->name('update.profile');
    Route::get('/pinbooks', 'LibraryBookController@get_all_pinned')->name('request.allpin');
    Route::get('/deletepin', 'LibraryBookController@delete_pin')->name('delete.pin');

    // Routes accessible only for users with 'admin' usertype
    Route::middleware(['admin'])->group(function () {

        Route::get('/admin/home', 'HomeController@index')->name('home');

        Route::get('load_graphs', 'GenreController@load_graphs');

        // USERTYPE
        Route::get('/all-usertype', 'UsertypeController@all_usertype')->name('usertypes');
        Route::get('/get-usertype', 'UsertypeController@get_usertype')->name('get.usertype');
        Route::get('/add-usertype', 'UsertypeController@add_usertype')->name('add.usertype');
        Route::get('/delete-usertype', 'UsertypeController@delete_usertype')->name('delete.usertype');

        // MASTERLIST
        Route::view('/admin/masterlist', 'pages.masterlist');

        // PROCUREMENTS
        // Route::view('/admin/procurements/{any}', 'pages.procurements');
        Route::get('/admin/procurements/{any}', 'ProcurementController@get_procurement');
        Route::match(['get', 'post'] ,'/store-procurements', 'ProcurementController@storeProcurement')->name('store.procurement');
        // Route::get('/all-procurements', 'ProcurementController@get_procurement')->name('get.procurement');

        // USER
        Route::get('/reset-password', 'UserController@reset_password')->name('reset.password');
        Route::get('/admin/all-users', 'UserController@users')->name('users');
        Route::get('/admin/saveUser', 'UserController@saveUser')->name('saveUser');
        Route::get('/admin/delete-user', 'UserController@deleteUser')->name('delete.user');

        Route::match(['get', 'post'], 'library/store-book', 'LibraryBookController@storeBook')->name('store.book');
        Route::match(['get', 'post'], 'library/update-book', 'LibraryBookController@updateBook')->name('update.book');
        Route::get('library/delete-book', 'LibraryBookController@deleteBook')->name('delete.book');
        Route::get('library/dropdowns', 'LibraryBookController@getDropdowns')->name('dropdowns');

        // SETUP
        Route::get('/admin/setup/{any}', 'SetupController@setup');
        // LIBRARY
        Route::get('libraries', 'LibraryController@index')->name('libraries');
        Route::get('get-library', 'LibraryController@get_library')->name('get.library');
        Route::get('update-library', 'LibraryController@update')->name('update.library');
        Route::get('add-library', 'LibraryController@store')->name('add.library');
        Route::get('delete-library', 'LibraryController@destroy')->name('delete.library');
        // CATEGORIES
        Route::get('categories', 'CategoryController@index')->name('categories');
        Route::get('get-category', 'CategoryController@get_category')->name('get.category');
        Route::get('update-category', 'CategoryController@update')->name('update.category');
        Route::get('add-category', 'CategoryController@store')->name('add.category');
        Route::get('delete-category', 'CategoryController@destroy')->name('delete.category');
        // GENRES
        Route::get('genres', 'GenreController@index')->name('genres');
        Route::get('get-genre', 'GenreController@get_genre')->name('get.genre');
        Route::get('update-genre', 'GenreController@update')->name('update.genre');
        Route::get('add-genre', 'GenreController@store')->name('add.genre');
        Route::get('delete-genre', 'GenreController@destroy')->name('delete.genre');
        // BORROWERS
        Route::get('borrowers', 'BorrowerController@index')->name('borrowers');
        Route::get('get-borrower', 'BorrowerController@get_borrower')->name('get.borrower');
        Route::get('update-borrower', 'BorrowerController@update')->name('update.borrower');
        Route::get('add-borrower', 'BorrowerController@store')->name('add.borrower');
        Route::get('delete-borrower', 'BorrowerController@destroy')->name('delete.borrower');

        // CIRCULATIONS
        Route::get('/admin/circulation/{any}', 'CirculationController@circulation');
        Route::get('/circulation/get-borrower', 'CirculationController@get_borrower')->name('get.circulation.borrower');
        Route::get('circulations', 'CirculationController@circulations')->name('circulations');
        Route::get('get-circulation', 'CirculationController@getCirculation')->name('get.circulation');
        Route::get('update-circulation', 'CirculationController@updateCirculation')->name('update.circulation');
        Route::get('store-circulation', 'CirculationController@storeCirculation')->name('store.circulation');
        Route::get('delete-circulation', 'CirculationController@deleteCirculation')->name('delete.circulation');
        Route::get('/view/borrowerdetail', 'CirculationController@viewborrower');

        // REPORTS
        Route::get('/admin/report/{any}', 'ReportController@reports');
    });
    
});


