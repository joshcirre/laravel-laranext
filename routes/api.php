<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");

Route::get("/hi", function () {
    sleep(1);
    return response()->json([
        "message" => "Hello, Beautiful World!",
        "description" => "Welcome to our API!",
    ]);
});
