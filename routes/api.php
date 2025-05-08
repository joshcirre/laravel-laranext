<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::post("/external-login", function (Request $request) {
    // Or some identifier for the user from a third party service
    $email = $request->input("email");
    $name = $request->input("name");

    $user = User::firstOrCreate(
        ["email" => $email],
        [
            "name" => $name,
            "password" => bcrypt(Str::random(16)), // fake password
        ]
    );

    $token = $user->createToken("web-client")->plainTextToken;

    return response()->json(["token" => $token]);
});

// BOOKMARKS

Route::middleware("auth:sanctum")->group(function () {
    Route::get("/bookmarks", function (Request $request) {
        return $request->user()->bookmarks()->get();
    });

    Route::post("/bookmarks", function (Request $request) {
        $request->validate([
            "title" => "required|string",
            "url" => "required|url",
        ]);

        return $request
            ->user()
            ->bookmarks()
            ->create([
                "title" => $request->title,
                "url" => $request->url,
            ]);
    });
});
