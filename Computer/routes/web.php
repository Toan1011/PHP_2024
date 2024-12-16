<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssuesController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/issues', [IssuesController::class, 'index'])->name('issues.index');
Route::get('/issues/create', [IssuesController::class, 'create'])->name('issues.create');
Route::post('/issues', [IssuesController::class, 'store'])->name('issues.store');
Route::get('/issues/{id}', [IssuesController::class, 'show'])->name('issues.show');
Route::get('/issues/{id}/edit', [IssuesController::class, 'edit'])->name('issues.edit');
Route::put('/issues/{id}', [IssuesController::class, 'update'])->name('issues.update');
Route::delete('/issues/{id}', [IssuesController::class, 'destroy'])->name('issues.destroy');

