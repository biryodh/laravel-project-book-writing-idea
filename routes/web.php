<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PermissionController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [BookController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('book', BookController::class);
    Route::resource('section', SectionController::class);
    Route::get('getsection/{book_id}', [SectionController::class,'getSection'])->name('get.section');
    Route::post('addsection', [SectionController::class,'addSection'])->name('add.section');

    Route::get('permission/{book_id}', [PermissionController::class,'permission'])->name('get.permission');
    Route::post('addpermission', [PermissionController::class,'addPermission'])->name('add.permission');

    Route::get('write/{book_id}', [NoteController::class,'write'])->name('get.write');
    Route::post('addwrites', [NoteController::class,'addWrites'])->name('add.writes');
    
});

require __DIR__.'/auth.php';
