<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
      'message' => 'Welcome to my API',
      'status' => 'success',
      'status_code' => 200
    ]);
});
