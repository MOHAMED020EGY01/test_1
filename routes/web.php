<?php
use App\Http\Controllers\Dashboard\Profile;
use App\Http\Controllers\Front\Home;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[Home::class,'index'])->name('Home');

Route::get('/profile', [Profile::class,'edit'])->name('profile');
Route::post('/profile', [Profile::class,'update'])->name('profile.update');


require __DIR__.'/dashboard.php';
require __DIR__.'/auth.php';
require __DIR__.'/error.php';
    
   


