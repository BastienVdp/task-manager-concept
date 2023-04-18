<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    Route::get('/dashboard/tasks', [DashboardController::class, 'filter'])
        ->name('dashboard.filter');

    Route::get('/tasks', [TaskController::class, 'index'])
        ->name('tasks.index');

    Route::get('/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    Route::get('/tasks/{id}', [TaskController::class, 'show'])
        ->name('tasks.show');

    Route::get('/tasks/{id}/check', [TaskController::class, 'isCompleted'])
        ->name('tasks.check');

    Route::put('/tasks/{id}/update',[TaskController::class, 'update'])
        ->name('tasks.update');

    Route::put('/tasks/{id}/liked',[TaskController::class, 'updateLiked'])
        ->name('tasks.update.liked');

    Route::delete('/tasks/{id}',[TaskController::class, 'destroy'])
        ->name('tasks.destroy');

    Route::put('/todos/{id}/update',[TodoController::class, 'update'])
        ->name('todos.update');

    Route::put('/todos/{id}/state',[TodoController::class, 'updateState'])
        ->name('todos.update.state');

    Route::delete('/todos/{id}',[TodoController::class, 'destroy'])
        ->name('todos.destroy');

    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');
});






require __DIR__.'/auth.php';
