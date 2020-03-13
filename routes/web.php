<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// admin route ==================================
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
	// settings route ====================================
	Route::get('/settings','SettingsController@index')->name('settings');
	Route::post('/settings/user/{id}/update','SettingsController@update')->name('user.update');
	Route::post('/settings/password/update','SettingsController@updatePassword')->name('password.update');
	// category route ===================================== 
	Route::get('/categories/category','CategoryController@index')->name('category.index');
	Route::post('/categories/category/store','CategoryController@store')->name('category.store');
	Route::get('/categories/category/{id}/edit','CategoryController@edit')->name('category.edit');
	Route::post('/categories/category/{id}/update','CategoryController@update')->name('category.update');
	Route::get('/categories/category/{id}/destroy','CategoryController@destroy')->name('category.destroy');
	Route::get('/categories/category/{id}/status','CategoryController@status')->name('category.status');
	// brand route =========================================
	Route::get('/categories/brand','BrandController@index')->name('brand.index');
	Route::post('/categories/brand/store','BrandController@store')->name('brand.store');
	Route::get('/categories/brand/{id}/edit','BrandController@edit')->name('brand.edit');
	Route::post('/categories/brand/{id}/update','BrandController@update')->name('brand.update'); 
	Route::get('/categories/brand/{id}/destroy','BrandController@destroy')->name('brand.destroy'); 
	Route::get('/categories/brand/{id}/status','BrandController@status')->name('brand.status');

 
});

// staff route ==================================
Route::group(['as'=>'staff.','prefix'=>'staff','namespace'=>'Staff','middleware'=>['auth','staff']],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
});

// customer route ==================================
Route::group(['as'=>'customer.','prefix'=>'customer','namespace'=>'Customer','middleware'=>['auth','customer']],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
});