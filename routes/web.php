<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\JourFerieController;
use App\Http\Controllers\AbsenceController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ── Agents ───────────────────────────────────────────────────
Route::get('/agents',              [AgentController::class, 'index'])->name('agent.index');
Route::get('/agents/create',       [AgentController::class, 'create'])->name('agent.create');
Route::post('/agents',             [AgentController::class, 'store'])->name('agent.store');
Route::get('/agents/{agent}/edit', [AgentController::class, 'edit'])->name('agent.edit');
Route::put('/agents/{agent}',      [AgentController::class, 'update'])->name('agent.update');
Route::get('/agents/{agent}',      [AgentController::class, 'show'])->name('agent.show');
Route::delete('/agents/{agent}',   [AgentController::class, 'destroy'])->name('agent.destroy');

// ── Jours Fériés ─────────────────────────────────────────────
Route::get('/jourferies',                  [JourFerieController::class, 'index'])->name('jourferie.index');
Route::get('/jourferies/create',           [JourFerieController::class, 'create'])->name('jourferie.create');
Route::post('/jourferies',                 [JourFerieController::class, 'store'])->name('jourferie.store');
Route::get('/jourferies/{jourferie}/edit', [JourFerieController::class, 'edit'])->name('jourferie.edit');
Route::put('/jourferies/{jourferie}',      [JourFerieController::class, 'update'])->name('jourferie.update');
Route::get('/jourferies/{jourferie}',      [JourFerieController::class, 'show'])->name('jourferie.show');
Route::delete('/jourferies/{jourferie}',   [JourFerieController::class, 'destroy'])->name('jourferie.destroy');

// ── Absences ─────────────────────────────────────────────────
Route::get('/absences',                  [AbsenceController::class, 'index'])->name('absence.index');
Route::get('/absences/create',           [AbsenceController::class, 'create'])->name('absence.create');
Route::post('/absences',                 [AbsenceController::class, 'store'])->name('absence.store');
Route::get('/absences/{absence}/edit',   [AbsenceController::class, 'edit'])->name('absence.edit');
Route::put('/absences/{absence}',        [AbsenceController::class, 'update'])->name('absence.update');
Route::get('/absences/{absence}',        [AbsenceController::class, 'show'])->name('absence.show');
Route::delete('/absences/{absence}',     [AbsenceController::class, 'destroy'])->name('absence.destroy');
