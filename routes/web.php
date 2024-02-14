<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;

 
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.login');
Route::get('/register', [LoginController::class, 'register'])->name('login.register');
Route::post('/register', [LoginController::class, 'createRegister'])->name('register.create');

 

/////////////////////Registrar estudiante//////////////////////   
Route::get('/estudiante', [RegisterController::class, 'index'])->name('register.index');
Route::post('/estudiante', [RegisterController::class, 'createRegister'])->name('register.create');
/////fotos
Route::get('/estudiante/fotos/{correoElectronico}', [RegisterController::class, 'fotoUsuariosVista'])->name('register.fotos');
Route::post('/estudiante/fotos/{correoElectronico}', [RegisterController::class, 'fotoUsuarios'])->name('register.createFoto');
/////renvio
Route::get('/estudiante/renvio/{correoElectronico}', [RegisterController::class, 'renvioVista'])->name('register.vista');
Route::post('/estudiante/renvio/{correoElectronico}', [RegisterController::class, 'fotoRenvio'])->name('register.renvio');


/////////////////////////admin////////////////////////
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::delete('/admin/eliminar/{correoElectronico}', [AdminController::class, 'eliminar'])->name('admin.eliminar');
Route::post('/admin/aceptar/{correoElectronico}', [AdminController::class, 'Verificar'])->name('admin.aceptar');

Route::get('/admin2', [AdminController::class, 'index2'])->name('admin.index2');
Route::post('/admin2/eliminar/{correoElectronico}', [AdminController::class, 'eliminar2'])->name('admin.eliminar2');
Route::post('/admin2/aceptar/{correoElectronico}', [AdminController::class, 'aceptar'])->name('admin.aceptar2');

 Route::get('/admin3', [AdminController::class, 'index3'])->name('admin.index3');

////descargar
Route::get('/admin/descargar/{correoElectronico}', [AdminController::class, 'descargar'])->name('admin.descargar');

