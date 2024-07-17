<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $card = \App\Models\Card::find(6);
    return view('welcome',["card" =>$card]);
});
