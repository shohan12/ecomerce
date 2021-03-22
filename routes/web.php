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

Route::get('/','Frontend\PagesController@index')->name('index');
Route::get('/contact','Frontend\PagesController@contact')->name('contact');
/*
|--------------------------------------------------------------------------
| product Routes
|--------------------------------------------------------------------------
|all the routes for our product frontend 
|
| 
| 
|
*/

Route::group(['prefix'=>'/products'],function(){
     Route::get('/','Frontend\ProductsController@index')->name('products');
     Route::get('/{slug}','Frontend\ProductsController@show')->name('products.show');

     Route::get('/category','Frontend\CategoriesController@show')->name('categories.index');
     Route::get('/category/{id}','Frontend\CategoriesController@show')->name('categories.show');
});
Route::group(['prefix'=>'/user'],function(){
     Route::get('/token/{token}', 'Frontend\VerificationController@verify')->name('user.verification');
     Route::get('/dashboard','Frontend\UserController@dashboard')->name('user.dashboard');
     Route::get('/profile','Frontend\UserController@profile')->name('user.profile');
     Route::post('/profile/update','Frontend\UserController@profileUpdate')->name('user.profile.update');

});
Route::group(['prefix'=>'/carts'],function(){
     
     Route::get('/','Frontend\CartsController@index')->name('carts');
     Route::post('/store','Frontend\CartsController@store')->name('carts.store');
     Route::post('/update/{id}','Frontend\CartsController@update')->name('carts.update');
     Route::post('/delete/{id}','Frontend\CartsController@destroy')->name('carts.delete');



});
Route::group(['prefix'=>'checkouts'],function(){
     
     Route::get('/','Frontend\CheckoutsController@index')->name('checkouts');
     Route::post('/store','Frontend\CheckoutsController@store')->name('checkouts.store');


});




Route::get('/search','Frontend\PagesController@search')->name('search');
Route::group(['prefix'=>'admin'],function(){
     Route::get('/', 'Backend\PagesController@index')->name('admin.index');
     
     Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
     Route::post('/login/submit', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
     Route::post('/logout/submit', 'Auth\Admin\LoginController@logout')->name('admin.logout');
     Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
     Route::post('/password/resetPost', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
   
     Route::get('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
     Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin.password.reset.post');
     Route::group(['prefix'=>'/products'],function(){
             
          Route::get('/','Backend\ProductsController@index')->name('admin.products');
          Route::get('/create','Backend\ProductsController@create')->name('admin.product.create');
          Route::post('/store','Backend\ProductsController@store')->name('admin.product.store'); 
          Route::get('/edit/{id}','Backend\ProductsController@edit')->name('admin.product.edit');
          Route::post('/product/edit/{id}','Backend\ProductsController@update')->name('admin.product.update');
          Route::post('/product/delete/{id}','Backend\ProductsController@delete')->name('admin.product.delete');
     });
     Route::group(['prefix' => '/orders'], function(){
          Route::get('/', 'Backend\OrdersController@index')->name('admin.orders');
          Route::get('/view/{id}', 'Backend\OrdersController@show')->name('admin.order.show');
          Route::post('/delete/{id}', 'Backend\OrdersController@delete')->name('admin.order.delete');
      
          Route::post('/completed/{id}', 'Backend\OrdersController@completed')->name('admin.order.completed');
      
          Route::post('/paid/{id}', 'Backend\OrdersController@paid')->name('admin.order.paid');
          Route::post('/charge-update/{id}', 'Backend\OrdersController@chargeUpdate')->name('admin.order.charge');

          Route::get('/invoice/{id}', 'Backend\OrdersController@generateInvoice')->name('admin.order.invoice');
      
        });
      
     Route::group(['prefix'=>'/categories'],function(){
          Route::get('/','Backend\categoriesController@index')->name('admin.categories');
          Route::get('/create','Backend\categoriesController@create')->name('admin.category.create');
          Route::post('/store','Backend\categoriesController@store')->name('admin.category.store'); 
          Route::get('/edit/{id}','Backend\categoriesController@edit')->name('admin.category.edit');
          Route::post('/category/edit/{id}','Backend\categoriesController@update')->name('admin.category.update');
          Route::post('/category/delete/{id}','Backend\categoriesController@delete')->name('admin.category.delete');
     });
     Route::group(['prefix'=>'/brands'],function(){
          Route::get('/','Backend\brandsController@index')->name('admin.brands');
          Route::get('/create','Backend\brandsController@create')->name('admin.brand.create');
          Route::post('/store','Backend\brandsController@store')->name('admin.brand.store'); 
          Route::get('/edit/{id}','Backend\brandsController@edit')->name('admin.brand.edit');
          Route::post('/category/edit/{id}','Backend\brandsController@update')->name('admin.brand.update');
          Route::post('/category/delete/{id}','Backend\brandsController@delete')->name('admin.brand.delete');
     });
     Route::group(['prefix' => '/divisions'], function(){
          Route::get('/', 'Backend\DivisionsController@index')->name('admin.divisions');
          Route::get('/create', 'Backend\DivisionsController@create')->name('admin.division.create');
          Route::get('/edit/{id}', 'Backend\DivisionsController@edit')->name('admin.division.edit');
      
          Route::post('/store', 'Backend\DivisionsController@store')->name('admin.division.store');
      
          Route::post('/division/edit/{id}', 'Backend\DivisionsController@update')->name('admin.division.update');
          Route::post('/division/delete/{id}', 'Backend\DivisionsController@delete')->name('admin.division.delete');
        });
     Route::group(['prefix'=>'/districts'],function(){
          Route::get('/','Backend\DistrictsController@index')->name('admin.districts');
          Route::get('/create','Backend\DistrictsController@create')->name('admin.district.create');
          Route::post('/store','Backend\DistrictsController@store')->name('admin.district.store'); 
          Route::get('/edit/{id}','Backend\DistrictsController@edit')->name('admin.district.edit');
          Route::post('/district/edit/{id}','Backend\DistrictsController@update')->name('admin.district.update');
          Route::post('/district/delete/{id}','Backend\DistrictsController@delete')->name('admin.district.delete');
     });
     Route::group(['prefix' => '/sliders'], function(){
          Route::get('/', 'Backend\SlidersController@index')->name('admin.sliders');
          Route::post('/store', 'Backend\SlidersController@store')->name('admin.slider.store');
          Route::post('/slider/edit/{id}', 'Backend\SlidersController@update')->name('admin.slider.update');
          Route::post('/slider/delete/{id}', 'Backend\SlidersController@delete')->name('admin.slider.delete');
        });
});

Auth::routes();

 Route::get('/home', 'HomeController@index')->name('home');

 Route::get('get-districts/{id}',function($id){
      return json_encode (App\Models\District::Where('division_id',$id)->get());
 });