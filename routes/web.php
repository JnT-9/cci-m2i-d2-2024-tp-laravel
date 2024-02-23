<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    MemberController,
    WelcomeController
};

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

// Route::get('/', function () {
//     echo (new \App\Http\Controllers\Controller())->index();
// });
// Route::get('/assosier', function () {
//     echo (new \App\Http\Controllers\MemberController)->index();
// });
// Route::get('/assosier-creer', function () {
//     echo (new \App\Http\Controllers\MemberController)->create();
// });
// Route::post('/assosier-creer-2', function () {
//     echo (new \App\Http\Controllers\MemberController)->store();
// });
// Route::get('/assosier-show', function () {
//     echo (new \App\Http\Controllers\MemberController)->show();
// });
// Route::get('/assosier-detruite', function () {
//     echo (new \App\Http\Controllers\MemberController)->delete();
// });


// Welcome
Route::get('/', [WelcomeController::class, 'index'])
    ->name('welcome');

Route::get('/member/index', [MemberController::class, 'index'])
    ->name('member.index')
    ->middleware('auth');

Route::get('/member/create', [MemberController::class, 'create'])
    ->name('member.create');

Route::get('/member/edit/{id}', [MemberController::class, 'edit'])
    ->name('member.edit');

Route::get('/member/show/{id}', [MemberController::class, 'show'])
    ->name('member.show');

Route::delete('/member/delete/{id}', [MemberController::class, 'delete'])
    ->name('member.delete');