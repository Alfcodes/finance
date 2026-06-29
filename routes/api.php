<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FinanceApiController;

Route::middleware('auth:sanctum')->group(function () {
    // User profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Dashboard stats
    Route::get('/stats', [FinanceApiController::class, 'stats']);

    // Expenses
    Route::get('/expenses', [FinanceApiController::class, 'getExpenses']);
    Route::post('/expenses', [FinanceApiController::class, 'storeExpense']);
    Route::put('/expenses/{expense}', [FinanceApiController::class, 'updateExpense']);
    Route::delete('/expenses/{expense}', [FinanceApiController::class, 'deleteExpense']);

    // Income
    Route::get('/income', [FinanceApiController::class, 'getIncome']);
    Route::post('/income', [FinanceApiController::class, 'storeIncome']);
    Route::put('/income/{entry}', [FinanceApiController::class, 'updateIncome']);
    Route::delete('/income/{entry}', [FinanceApiController::class, 'deleteIncome']);

    // Savings
    Route::get('/savings', [FinanceApiController::class, 'getSavings']);
    Route::post('/savings', [FinanceApiController::class, 'storeSaving']);
    Route::put('/savings/{saving}', [FinanceApiController::class, 'updateSaving']);
    Route::delete('/savings/{saving}', [FinanceApiController::class, 'deleteSaving']);

    // Giving
    Route::get('/giving', [FinanceApiController::class, 'getGiving']);
    Route::post('/giving', [FinanceApiController::class, 'storeGiving']);
    Route::delete('/giving/{entry}', [FinanceApiController::class, 'deleteGiving']);

    // Family
    Route::get('/family', [FinanceApiController::class, 'getFamily']);
    Route::post('/family', [FinanceApiController::class, 'storeFamily']);
    Route::delete('/family/{entry}', [FinanceApiController::class, 'deleteFamily']);

    // Goals
    Route::get('/goals', [FinanceApiController::class, 'getGoals']);
    Route::post('/goals', [FinanceApiController::class, 'storeGoal']);
    Route::put('/goals/{goal}', [FinanceApiController::class, 'updateGoal']);
    Route::delete('/goals/{goal}', [FinanceApiController::class, 'deleteGoal']);
});
