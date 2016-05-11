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


Route::get("/","PMController@IndexAction");


Route::post("Confirm","PMController@Confirm");
Route::post("Edit","PMController@Edit");
Route::post("Close","PMController@Close");
Route::get("GetCustomerName","DocController@GetCustomerName");
