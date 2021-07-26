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
// Storage Link creation
/*
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
*/
/* 1st parameter is for hyperlink reference value:"href" */
Route::get('/', 'PageController@getIndex');
Route::get('contact', 'PageController@getContact');
Route::post('contact', 'PageController@postContact');

/* Front-End Public View */
Route::get('view/{slug}', [
    'as'=>'view.single', 'uses'=>'ViewController@getSingle']
)->where('slug', '[\w\d\-\_]+');
Route::get('view', [
    'uses'=>'ViewController@getIndex', 'as'=>'view.index']);
// Job Application
Route::get('view/{slug}/{user}', 
    'HomeController@application')->where('slug', 
    '[\w\d\-\_]+')->middleware('auth:web')->name('application');
/* Route::get('/', function () {
    return view ('main');
});
*/
Auth::routes();

//Categories routes without some functions
Route::resource('categories', 'CategoryController', ['except' => ['create', 'show', 'edit']]);
//Tags routes without create & edit function
Route::resource('tags', 'TagController', ['except' => ['create', 'edit']]);

Route::resource('jobs', 'JobController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{user}', 'HomeController@profile')->name('profile');
Route::put('/profile/{user}', 'HomeController@update_profile')->name('update.profile');
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('company')->group(function () {
    Route::get('/login', 'Auth\CompanyLoginController@showCompanyLoginForm')->name('company.login');
    Route::post('/login', 'Auth\CompanyLoginController@login')->name('company.login.submit');

    Route::get('/', 'CompanyController@index')->name('company.dashboard');
    Route::get('/create', 'CompanyController@create')->name('company.create');
    Route::post('/', 'CompanyController@store')->name('company.store');
    Route::get('/{company}/jobs/{job}', 'CompanyController@show')->name('company.show');
    Route::get('/{company}/jobs/{job}/edit', 'CompanyController@edit')->name('company.edit');
    Route::put('/{company}/jobs/{job}', 'CompanyController@update')->name('company.update');
    //Route::get('/jobs/edit/{id}', array('as' => 'company.edit', 'uses' => 'CompanyController@edit'));
    Route::delete('/{job}', 'CompanyController@destroy')->name('company.destroy');
    Route::get('/{company}/jobs/{job}/applicants', 'CompanyController@applicants')->name('company.applicants');

    Route::get('/register', 'Auth\CompanyRegisterController@showCompanyRegisterForm')->name('company.register');
    Route::post('/register', 'Auth\CompanyRegisterController@createCompany')->name('company.register.submit');

    Route::get('/logout', 'Auth\CompanyLoginController@logout')->name('company.logout');
    Route::post('/logout', 'Auth\CompanyLoginController@logout')->name('company.logout');
});

Route::prefix('admin')->group(function () {

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});