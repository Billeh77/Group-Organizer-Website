<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard-accepted/{id}', [\App\Http\Controllers\DashboardController::class, 'accept'])->middleware(['auth', 'verified'])->name('acceptInvite');

Route::view('/tutorial', 'tutorial')->name('tutorial');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/groups', [\App\Http\Controllers\GroupController::class, 'groups'])->name('groups');
    Route::view('/personal', 'personal')->name('personal');
    Route::get('/create', [\App\Http\Controllers\GroupController::class, 'index'])->name('create');
    Route::view('/message', 'message')->name('message');

    Route::get('/personal', [\App\Http\Controllers\PersonalController::class, 'index'])->name('personal');
    Route::post('/personal-add', [\App\Http\Controllers\PersonalController::class, 'store'])->name('addTask');
    Route::delete('/personal-complete/{id}', [\App\Http\Controllers\PersonalController::class, 'destroy'])->name('completeTask');
    Route::get('/personal-progress/{id}', [\App\Http\Controllers\PersonalController::class, 'inProgress'])->name('inProgress');
    Route::post('/personal-edit', [\App\Http\Controllers\PersonalController::class, 'edit'])->name('editTask');

    Route::post('/group-add', [\App\Http\Controllers\GroupController::class, 'store'])->name('addGroupTask');
    Route::delete('/group-complete/{id}', [\App\Http\Controllers\GroupController::class, 'destroy'])->name('completeGroupTask');
    Route::get('/group-progress/{id}', [\App\Http\Controllers\GroupController::class, 'inProgress'])->name('inProgressGroup');
    Route::post('/group-edit', [\App\Http\Controllers\GroupController::class, 'edit'])->name('editGroupTask');

    Route::post('/creategroup', [\App\Http\Controllers\GroupController::class, 'create'])->name('group.create');
    

    Route::middleware('admin')->group(function() {
        Route::delete('/adminedit-dp/{id}', [\App\Http\Controllers\EditController::class, 'deletePurpose'])->name('edit.delete.purpose');
        Route::post('/adminedit-ap', [\App\Http\Controllers\EditController::class, 'addPurpose'])->name('edit.add.purpose');
    });
});

require __DIR__.'/auth.php';
