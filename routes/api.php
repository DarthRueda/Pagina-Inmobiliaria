<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PostControllerAdvance;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\ViviendaController;
use App\Http\Controllers\MunicipioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LikesController;


Route::post('forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forget.password.post');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');

Route::group(['middleware' => 'auth:sanctum'], function() {

    Route::apiResource('users', UserController::class);

    Route::post('users/updateimg', [UserController::class,'updateimg']); //Listar

    Route::apiResource('posts', PostControllerAdvance::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('roles', RoleController::class);

    Route::get('role-list', [RoleController::class, 'getList']);
    Route::get('role-permissions/{id}', [PermissionController::class, 'getRolePermissions']);
    Route::put('/role-permissions', [PermissionController::class, 'updateRolePermissions']);
    Route::apiResource('permissions', PermissionController::class);

    Route::get('category-list', [CategoryController::class, 'getList']);
    Route::get('/user', [ProfileController::class, 'user']);
    Route::put('/user', [ProfileController::class, 'update']);

    Route::get('abilities', function(Request $request) {
        return $request->user()->roles()->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    });
});

Route::get('category-list', [CategoryController::class, 'getList']);

Route::get('get-posts', [PostControllerAdvance::class, 'getPosts']);
Route::get('get-category-posts/{id}', [PostControllerAdvance::class, 'getCategoryByPosts']);
Route::get('get-post/{id}', [PostControllerAdvance::class, 'getPost']);

//Notes
Route::get('note', [NoteController::class, 'index'])->name('note.index');
Route::post('note', [NoteController::class, 'store'])->name('note.store');
Route::get('note/{id}', [NoteController::class, 'show'])->name('note.show');
Route::put('note/{id}', [NoteController::class, 'update'])->name('note.update');
Route::delete('note/{id}', [NoteController::class, 'destroy'])->name('note.destroy');

//Authors
Route::get('author', [AuthorController::class, 'index'])->name('author.index');
Route::post('/author', [AuthorController::class, 'store'])->name('author.store');
Route::get('author/{id}', [AuthorController::class, 'show'])->name('author.show');
Route::delete('author/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');
Route::put('author/{id}', [AuthorController::class, 'update'])->name('author.update');

//Users
Route::get('/user/{id}', [UserController::class, 'show']);

//Viviendas
Route::get('/viviendas', [ViviendaController::class, 'index'])->name('vivienda.index');
Route::get('/vivienda/{id}', [ViviendaController::class, 'show'])->name('vivienda.show');
Route::post('/vivienda', [ViviendaController::class, 'store']);
Route::post('/vivienda/{id}', [ViviendaController::class, 'update']);
Route::get('/viviendas/filter', [ViviendaController::class, 'filter']);
Route::get('/viviendas/filterByCaracteristicas', [ViviendaController::class, 'filterByCaracteristicas']);

//Municipios
Route::get('/municipios', [MunicipioController::class, 'index']);


//Likes
Route::get('/likes/{user}', [LikesController::class, 'getLikes']);
Route::get('/likes/check/{user}/{vivienda}', [LikesController::class, 'checkLike']);
Route::post('/likes/toggle', [LikesController::class, 'toggleLike']);
