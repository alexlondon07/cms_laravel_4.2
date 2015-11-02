<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

    Route::get('/', 'HomeController@showWelcome');
    Route::get('login', 'UserController@login');
    Route::post('login', 'UserController@doLogin');
    Route::any('logout', 'UserController@doLogout');

    //Rutas permitidas SIN autenticacion
    Route::get('attachment/get/{action}/{id}/{key}', array('uses' => 'AttachmentController@getAttachment'));

    Route::group(array('prefix' => 'admin', 'before' => 'auth'), function() {

              Route::get('/', 'HomeController@showWelcome');
              Route::get('main', 'HomeController@showMain');
              Route::resource('user', 'UserController');
              Route::get('users/search', 'UserController@search');
              Route::resource('client', 'ClientController');
              Route::get('clients/search', 'ClientController@search');
              Route::resource('provider', 'ProviderController');
              Route::get('providers/search', 'ProviderController@search');
              Route::resource('cost', 'CostController');
              Route::get('costs/search', 'CostController@search');
              Route::resource('category', 'CategoryController');
              Route::get('categorys/search', 'CategoryController@search');
              Route::resource('product', 'ProductController');
              Route::get('products/search', 'ProductController@search');
              Route::resource('shopping', 'ShoppingController');
              Route::get('shoppings/search', 'ShoppingController@search');
    });

// llamados ajax
  Route::group(array('prefix' => 'ajax'), function() {
    Route::any('usernameexist', 'UserController@userNameExist');
    Route::any('get_product_data_table', 'ShoppingController@getProductDataTable');
    // llamados ajax que requieren autenticacion
    Route::group(array('before' => 'auth'), function() {
        // FUNCIONES QUE REQUIEREN AUTENTICACION
    });
});


/*
 * Ruta para identificar el host donde se esta ejecutando al aplicacion
 */
Route::get('host', function() {
    echo gethostname();
    $app = new Illuminate\Foundation\Application;
    $env = $app->detectEnvironment(array(
        'local' => array('localhost', 'MacBook-Pro-de-Alexander.local', 'localhost', 'ALEX-PC'),
        'production' => array('pendiente'),
        ));
    echo " ___ " . $env;
});
