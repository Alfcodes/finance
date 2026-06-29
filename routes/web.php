<?php

use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [FinanceController::class, 'dashboard'])->name('dashboard');

    // Expenses
    Route::get('/expenses', [FinanceController::class, 'expenses'])->name('expenses.index');
    Route::post('/expenses', [FinanceController::class, 'storeExpense'])->name('expenses.store');
    Route::get('/expenses/{expense}/edit', [FinanceController::class, 'editExpense'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [FinanceController::class, 'updateExpense'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [FinanceController::class, 'deleteExpense'])->name('expenses.delete');

    // Income
    Route::get('/income', [FinanceController::class, 'incomeEntries'])->name('income.index');
    Route::post('/income', [FinanceController::class, 'storeIncome'])->name('income.store');
    Route::get('/income/{entry}/edit', [FinanceController::class, 'editIncome'])->name('income.edit');
    Route::put('/income/{entry}', [FinanceController::class, 'updateIncome'])->name('income.update');
    Route::delete('/income/{entry}', [FinanceController::class, 'deleteIncome'])->name('income.delete');

    // Savings
    Route::get('/savings', [FinanceController::class, 'savings'])->name('savings.index');
    Route::post('/savings', [FinanceController::class, 'storeSaving'])->name('savings.store');
    Route::get('/savings/{saving}/edit', [FinanceController::class, 'editSaving'])->name('savings.edit');
    Route::put('/savings/{saving}', [FinanceController::class, 'updateSaving'])->name('savings.update');
    Route::delete('/savings/{saving}', [FinanceController::class, 'deleteSaving'])->name('savings.delete');

    // Giving
    Route::get('/giving', [FinanceController::class, 'giving'])->name('giving.index');
    Route::post('/giving', [FinanceController::class, 'storeGiving'])->name('giving.store');
    Route::delete('/giving/{entry}', [FinanceController::class, 'deleteGiving'])->name('giving.delete');

    // Family
    Route::get('/family', [FinanceController::class, 'family'])->name('family.index');
    Route::post('/family', [FinanceController::class, 'storeFamily'])->name('family.store');
    Route::delete('/family/{entry}', [FinanceController::class, 'deleteFamily'])->name('family.delete');

    // Goals
    Route::get('/goals', [FinanceController::class, 'goals'])->name('goals.index');
    Route::post('/goals', [FinanceController::class, 'storeGoal'])->name('goals.store');
    Route::get('/goals/{goal}/edit', [FinanceController::class, 'editGoal'])->name('goals.edit');
    Route::put('/goals/{goal}', [FinanceController::class, 'updateGoal'])->name('goals.update');
    Route::delete('/goals/{goal}', [FinanceController::class, 'deleteGoal'])->name('goals.delete');
});

require __DIR__.'/auth.php';
