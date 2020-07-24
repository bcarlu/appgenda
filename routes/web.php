<?php

use Illuminate\Support\Facades\Route;

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

// Peticion inicial, redirecciona a la vista welcome
Route::get('/', function () { return view('welcome');});

// Rutas para login y registro con la propiedad de verificacion habilitada
Auth::routes(['verify' => true]);

// Ruta home para usuarios logueados
Route::get('/home', 'HomeController@index')->name('home');

// Ruta para mostrar las categorias
Route::get('home/categories', 'CategoryController@index')->name('categories');

// Ruta para mostrar los servicios
Route::get('home/categories/{category}/services', 'ServiceController@index');

// Ruta para mostrar la agenda disponible
Route::get('home/categories/{category}/services/{service}/schedule', 'ScheduleController@index');

// Ruta para mostrar el resumen y confirmar agenda
Route::get('confirmation/{service}/{employee}/{date}/{start}/{duration}', 'ConfirmationController@index');

// Ruta para enviar y almacenar los datos de la cita en la base de datos
Route::get('schedule/store/{service}/{employee}/{date}/{start}/{duration}', 'BookingController@store');
// Ruta para los usuarios administradores y empleados con middleware para evitar acceso no autorizado
Route::get('/dashboard', 'DashboardController@index');