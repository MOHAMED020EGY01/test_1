<?php

use Illuminate\Support\Facades\Route;

Route::get('error/notfound', function () {
    return view('error.notfound');
})->name('404.notfound');



?>