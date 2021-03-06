<?php
 Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    

});

Route::apiResource('/employee', 'Api\EmployeeController');

Route::apiResource('/supplier', 'Api\SupplierController');

Route::apiResource('/category', 'Api\CategoryController');

Route::apiResource('/product', 'Api\ProductController');

Route::apiResource('/expense', 'Api\ExpenseController');

Route::Post('/salary/paid/{id}', 'Api\SalaryController@Paid');
Route::Get('/salary', 'Api\SalaryController@AllSalary');
Route::Get('/salary/view/{id}', 'Api\SalaryController@ViewSalary');