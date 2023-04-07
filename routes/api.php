<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return response([
        'status' => 'ok',
        'message' => 'Oh, hey. Nice to see you here.',
    ], 200);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('', [UserController::class, 'all'])->name('users.list');
        Route::get('{user}', [UserController::class, 'one'])->name('users.list.one');

        Route::withoutMiddleware('auth:sanctum')
            ->post('', [UserController::class, 'create'])
            ->name('users.create');

        Route::put('{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('{user}', [UserController::class, 'delete'])->name('users.delete');

        Route::get('{user}/profile', [ProfileController::class, 'one'])->name('users.profile.one');
        Route::put('{user}/profile', [ProfileController::class, 'update'])->name('users.profile.update');
    })->name('users');

    Route::group(['prefix' => 'events'], function () {
        Route::get('', [EventController::class, 'all'])->name('events.list');
        Route::get('{event}', [EventController::class, 'one'])->name('events.list.one');
        Route::post('', [EventController::class, 'create'])->name('events.create');
        Route::post('{event}/update', [EventController::class, 'update'])->name('events.update');
        Route::delete('{event}', [EventController::class, 'delete'])->name('events.delete');
    })->name('events');

    Route::get('me', [UserController::class, 'me'])
        ->name('users.me');
});

Route::post('login', [LoginController::class, 'auth'])->name('login');
