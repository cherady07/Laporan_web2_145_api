<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/halo', function () {
    return response()->json(['pesan' => 'API Berhasil Aktif!']);
});
