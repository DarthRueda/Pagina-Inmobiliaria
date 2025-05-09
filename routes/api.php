<?php

use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ViviendaController;
use App\Http\Controllers\MunicipioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LikesController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\Api\InmobiliariaController;


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



//Users
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user/upload-fondo', [UserController::class, 'uploadFondo']);
Route::post('/user/upload-logo', [UserController::class, 'uploadLogo']);
Route::get('/user/tipo/{userId}', [UserController::class, 'getTipo'])->name('user.tipo');

//Viviendas
Route::get('/viviendas', [ViviendaController::class, 'index'])->name('vivienda.index');
Route::get('/vivienda/{id}', [ViviendaController::class, 'show'])->name('vivienda.show');
Route::post('/vivienda', [ViviendaController::class, 'store']);
Route::post('/vivienda/{id}', [ViviendaController::class, 'update']);
Route::get('/viviendas/filter', [ViviendaController::class, 'filter']);
Route::get('/viviendas/filterByCaracteristicas', [ViviendaController::class, 'filterByCaracteristicas']);
Route::get('/viviendas/user/{userId}', [ViviendaController::class, 'getByUserId'])->name('viviendas.byUser');
Route::delete('/vivienda/{viviendaId}/media/{mediaId}', [ViviendaController::class, 'deleteMedia']);
Route::post('/vivienda/{viviendaId}/media', [ViviendaController::class, 'addMedia']);
Route::delete('/vivienda/{id}', [ViviendaController::class, 'destroy']);

//Municipios
Route::get('/municipios', [MunicipioController::class, 'index']);


//Likes
Route::get('/likes/{user}', [LikesController::class, 'getLikes']);
Route::get('/likes/check/{user}/{vivienda}', [LikesController::class, 'checkLike']);
Route::post('/likes/toggle', [LikesController::class, 'toggleLike']);

//Notificaciones
Route::get('/notificaciones/{userId}', [NotificacionController::class, 'getUserNotifications']);
Route::post('/notificaciones/{notificacionId}/leida/{userId}', [NotificacionController::class, 'markAsRead']);
Route::get('/notificaciones/no-leidas/{userId}', [NotificacionController::class, 'getUnreadNotificationsCount']);

//Inmobiliaria
Route::get('/inmobiliaria/{id}', [InmobiliariaController::class, 'show'])->name('inmobiliaria.show');


