<?php

use Illuminate\Support\Facades\Route;

Route::any('{all}', function (){
    return view('app');
})->where(['all' => '.*']);
