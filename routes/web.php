<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\JourFerieController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\AuthController;

// ── Authentification ─────────────────────────────────────────
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

// ── Routes protégées par authentification ───────────────────
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // ── Agents ───────────────────────────────────────────────
    Route::get('/agents',                    [AgentController::class, 'index'])->name('agent.index');
    Route::get('/agents/create',             [AgentController::class, 'create'])->name('agent.create');
    Route::post('/agents',                   [AgentController::class, 'store'])->name('agent.store');
    Route::get('/agents/{agent}/historique', [AgentController::class, 'historique'])->name('agent.historique');
    Route::get('/agents/{agent}/edit',       [AgentController::class, 'edit'])->name('agent.edit');
    Route::put('/agents/{agent}',            [AgentController::class, 'update'])->name('agent.update');
    Route::get('/agents/{agent}',            [AgentController::class, 'show'])->name('agent.show');
    Route::delete('/agents/{agent}',         [AgentController::class, 'destroy'])->name('agent.destroy');

    // ── Jours Fériés ─────────────────────────────────────────
    Route::get('/jourferies',                  [JourFerieController::class, 'index'])->name('jourferie.index');
    Route::get('/jourferies/create',           [JourFerieController::class, 'create'])->name('jourferie.create');
    Route::post('/jourferies',                 [JourFerieController::class, 'store'])->name('jourferie.store');
    Route::get('/jourferies/{jourferie}/edit', [JourFerieController::class, 'edit'])->name('jourferie.edit');
    Route::put('/jourferies/{jourferie}',      [JourFerieController::class, 'update'])->name('jourferie.update');
    Route::get('/jourferies/{jourferie}',      [JourFerieController::class, 'show'])->name('jourferie.show');
    Route::delete('/jourferies/{jourferie}',   [JourFerieController::class, 'destroy'])->name('jourferie.destroy');

    // ── Absences ─────────────────────────────────────────────
    Route::get('/absences',                  [AbsenceController::class, 'index'])->name('absence.index');
    Route::get('/absences/create',           [AbsenceController::class, 'create'])->name('absence.create');
    Route::post('/absences',                 [AbsenceController::class, 'store'])->name('absence.store');
    Route::get('/absences/{absence}/edit',   [AbsenceController::class, 'edit'])->name('absence.edit');
    Route::put('/absences/{absence}',        [AbsenceController::class, 'update'])->name('absence.update');
    Route::get('/absences/{absence}',        [AbsenceController::class, 'show'])->name('absence.show');
    Route::delete('/absences/{absence}',     [AbsenceController::class, 'destroy'])->name('absence.destroy');

    // ── Congés ───────────────────────────────────────────────
    Route::get('/conges',              [CongeController::class, 'index'])->name('conge.index');
    Route::get('/conges/create',       [CongeController::class, 'create'])->name('conge.create');
    Route::post('/conges',             [CongeController::class, 'store'])->name('conge.store');
    Route::get('/conges/{conge}/edit', [CongeController::class, 'edit'])->name('conge.edit');
    Route::put('/conges/{conge}',      [CongeController::class, 'update'])->name('conge.update');
    Route::get('/conges/{conge}',      [CongeController::class, 'show'])->name('conge.show');
    Route::delete('/conges/{conge}',   [CongeController::class, 'destroy'])->name('conge.destroy');

    // ── Rapports PDF ─────────────────────────────────────────
    Route::get('/rapports',            [RapportController::class, 'index'])->name('rapport.index');
    Route::get('/rapports/agent/{id}', [RapportController::class, 'ficheAgent'])->name('rapport.agent');
    Route::get('/rapports/lieu/{lieu}',[RapportController::class, 'rapportLieu'])->name('rapport.lieu');
    Route::get('/rapports/global',     [RapportController::class, 'rapportGlobal'])->name('rapport.global');

});
