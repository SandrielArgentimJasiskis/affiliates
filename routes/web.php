<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
	Route::get('/cursos/cursos', [SacarController::class, 'index'])->name('cursos');
    Route::get('/cursos/materiais', [SacarController::class, 'index'])->name('materiais');
});

Route::middleware('auth')->group(function () {
	Route::get('/usuarios/alunos', [SacarController::class, 'index'])->name('students.index');
    Route::get('/usuarios/afiliados', [SacarController::class, 'index'])->name('affiliates.index');
	Route::get('/usuarios/professores', [SacarController::class, 'index'])->name('teachers.index');
});

Route::middleware('auth')->group(function () {
	Route::get('/financeiro/vendas', [SacarController::class, 'index'])->name('vendas');
    Route::get('/financeiro/sacar', [SacarController::class, 'index'])->name('sacar');
});

Route::middleware('auth')->group(function () {
    Route::get('/atendimento', [SacarController::class, 'index'])->name('atendimento');
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
