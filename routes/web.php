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
	// sub-category route ==================================
	Route::get('/categories/subcategory','SubCategoryController@index')->name('subcategory.index');
	Route::post('/categories/subcategory/store','SubCategoryController@store')->name('subcategory.store');
	Route::get('/categories/subcategory/{id}/edit','SubCategoryController@edit')->name('subcategory.edit'); 
	Route::post('/categories/subcategory/{id}/update','SubCategoryController@update')->name('subcategory.update'); 
	Route::get('/categories/subcategory/{id}/destroy','SubCategoryController@destroy')->name('subcategory.destroy'); 
	Route::get('/categories/subcategory/{id}/status','SubCategoryController@status')->name('subcategory.status');
	// coupon route ========================================
	Route::get('/coupon','CouponController@index')->name('coupon.index');
	Route::post('/coupon/store','CouponController@store')->name('coupon.store');
	Route::get('/coupon/{id}/status','CouponController@status')->name('coupon.status');
	Route::get('/coupon/{id}/edit','CouponController@edit')->name('coupon.edit');
	Route::get('/coupon/{id}/destroy','CouponController@destroy')->name('coupon.destroy');
	Route::post('/coupon/{id}/update','CouponController@update')->name('coupon.update');
	Route::get('/letter','CouponController@letter')->name('letter.index');
	Route::get('/letter/{id}/delete','CouponController@delete')->name('letter.delete');
	// product route ========================================
	Route::get('/product','ProductController@index')->name('product.index');
	Route::get('/product/create','ProductController@create')->name('product.create');
	Route::get('/get/subcategory/{category_id}','ProductController@get');
	Route::post('/product/store','ProductController@store')->name('product.store');
	Route::get('/product/{id}/status','ProductController@status')->name('product.status');
	Route::get('/product/{id}/edit','ProductController@edit')->name('product.edit');
	Route::get('/product/{id}/show','ProductController@show')->name('product.show');
	Route::get('/product/{id}/delete','ProductController@delete')->name('product.delete');
	Route::post('/product/{id}/update','ProductController@update')->name('product.update');

});

// staff route =====================================
Route::group(['as'=>'staff.','prefix'=>'staff','namespace'=>'Staff','middleware'=>['auth','staff']],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
});

// customer route ==================================
Route::group(['as'=>'customer.','prefix'=>'customer','namespace'=>'Customer','middleware'=>['auth','customer']],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
});

// any route =======================================
	Route::post('newsletter','AllController@store')->name('subscriber.store');
