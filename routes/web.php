<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/agents', [AgentController::class, 'index'])->name('agent.index');
Route::get('/agents/create', [AgentController::class, 'create'])->name('agent.create');
Route::post('/agents/store', [AgentController::class, 'store'])->name('agent.store');
Route::get('/agents/edit/{agent}', [AgentController::class, 'edit'])->name('agent.edit');
Route::put('/agents/update/{agent}', [AgentController::class, 'update'])->name('agent.update');
Route::get('/agents/show/{agent}', [AgentController::class, 'show'])->name('agent.show');
Route::delete('/agents/delete/{agent}', [AgentController::class, 'destroy'])->name('agent.destroy');

