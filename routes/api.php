<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('web')->group(function () {
    Route::get('/list_users', [UserController::class, 'index'])->name('list_users')->middleware('verified'); // Display a list of users
    Route::get('/edit-users/{id}', [UserController::class, 'edit'])->name('edit_users')->middleware('verified'); // Show the edit user form
    Route::put('/update-user/{id}', [UserController::class, 'update'])->name('update_user')->middleware('verified'); // Update a user
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('verified'); // Delete a user
});

