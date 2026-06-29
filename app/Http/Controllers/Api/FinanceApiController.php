<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\IncomeEntry;
use App\Models\Saving;
use App\Models\Giving;
use App\Models\Family;
use App\Models\Goal;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\StoreSavingRequest;
use App\Http\Requests\StoreGivingRequest;
use App\Http\Requests\StoreFamilyRequest;
use App\Http\Requests\StoreGoalRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class FinanceApiController extends Controller
{
    // ========== DASHBOARD STATS ==========
    public function stats(): JsonResponse
    {
        $user = auth()->user();

        $expenses = $user->expenses()->get();
        $income_entries = $user->incomeEntries()->get();
        $savings = $user->savings()->get();
        $giving = $user->givings()->get();
        $family = $user->families()->get();
        $budget = $user->budgetSetting;

        $income = $budget?->monthly_income ?? 0;
        $totalExp = $expenses->sum('amount');
        $totalSav = $savings->sum('current');
        $totalGiving = $giving->sum('amount');
        $totalFam = $family->sum('amount');
        $totalIncome = $income_entries->sum('amount');
        $remaining = $income - $totalExp;

        $savingsRate = $income > 0 ? $totalSav / $income : 0;
        $givingRate = $income > 0 ? $totalGiving / $income : 0;
        $budgetUtil = $income > 0 ? $totalExp / $income : 0;
        $healthScore = max(0, min(100, 50 + ($income > 0 ? ($remaining / $income) * 100 : 0)));

        return response()->json([
            'income' => $income,
            'total_expenses' => $totalExp,
            'total_savings' => $totalSav,
            'total_giving' => $totalGiving,
            'total_family' => $totalFam,
            'total_income_entries' => $totalIncome,
            'remaining' => $remaining,
            'savings_rate' => $savingsRate,
            'giving_rate' => $givingRate,
            'budget_utilization' => $budgetUtil,
            'health_score' => $healthScore,
        ]);
    }

    // ========== EXPENSES API ==========
    public function getExpenses(): JsonResponse
    {
        $expenses = auth()->user()->expenses()->orderBy('date', 'desc')->get();
        return response()->json($expenses);
    }

    public function storeExpense(StoreExpenseRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        $expense = Expense::create($data);
        return response()->json(['message' => 'Expense created', 'data' => $expense], 201);
    }

    public function updateExpense(Expense $expense, StoreExpenseRequest $request): JsonResponse
    {
        $this->authorize('update', $expense);
        $expense->update($request->validated());
        return response()->json(['message' => 'Expense updated', 'data' => $expense]);
    }

    public function deleteExpense(Expense $expense): JsonResponse
    {
        $this->authorize('delete', $expense);
        $expense->delete();
        return response()->json(['message' => 'Expense deleted']);
    }

    // ========== INCOME API ==========
    public function getIncome(): JsonResponse
    {
        $entries = auth()->user()->incomeEntries()->orderBy('date', 'desc')->get();
        return response()->json($entries);
    }

    public function storeIncome(StoreIncomeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        $entry = IncomeEntry::create($data);
        return response()->json(['message' => 'Income created', 'data' => $entry], 201);
    }

    public function updateIncome(IncomeEntry $entry, StoreIncomeRequest $request): JsonResponse
    {
        $this->authorize('update', $entry);
        $entry->update($request->validated());
        return response()->json(['message' => 'Income updated', 'data' => $entry]);
    }

    public function deleteIncome(IncomeEntry $entry): JsonResponse
    {
        $this->authorize('delete', $entry);
        $entry->delete();
        return response()->json(['message' => 'Income deleted']);
    }

    // ========== SAVINGS API ==========
    public function getSavings(): JsonResponse
    {
        $savings = auth()->user()->savings()->get();
        return response()->json($savings);
    }

    public function storeSaving(StoreSavingRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        $saving = Saving::create($data);
        return response()->json(['message' => 'Savings created', 'data' => $saving], 201);
    }

    public function updateSaving(Saving $saving, StoreSavingRequest $request): JsonResponse
    {
        $this->authorize('update', $saving);
        $saving->update($request->validated());
        return response()->json(['message' => 'Savings updated', 'data' => $saving]);
    }

    public function deleteSaving(Saving $saving): JsonResponse
    {
        $this->authorize('delete', $saving);
        $saving->delete();
        return response()->json(['message' => 'Savings deleted']);
    }

    // ========== GIVING API ==========
    public function getGiving(): JsonResponse
    {
        $entries = auth()->user()->givings()->orderBy('date', 'desc')->get();
        return response()->json($entries);
    }

    public function storeGiving(StoreGivingRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        $entry = Giving::create($data);
        return response()->json(['message' => 'Giving created', 'data' => $entry], 201);
    }

    public function deleteGiving(Giving $entry): JsonResponse
    {
        $this->authorize('delete', $entry);
        $entry->delete();
        return response()->json(['message' => 'Giving deleted']);
    }

    // ========== FAMILY API ==========
    public function getFamily(): JsonResponse
    {
        $entries = auth()->user()->families()->orderBy('date', 'desc')->get();
        return response()->json($entries);
    }

    public function storeFamily(StoreFamilyRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        $entry = Family::create($data);
        return response()->json(['message' => 'Family entry created', 'data' => $entry], 201);
    }

    public function deleteFamily(Family $entry): JsonResponse
    {
        $this->authorize('delete', $entry);
        $entry->delete();
        return response()->json(['message' => 'Family entry deleted']);
    }

    // ========== GOALS API ==========
    public function getGoals(): JsonResponse
    {
        $goals = auth()->user()->goals()->get();
        return response()->json($goals);
    }

    public function storeGoal(StoreGoalRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        $goal = Goal::create($data);
        return response()->json(['message' => 'Goal created', 'data' => $goal], 201);
    }

    public function updateGoal(Goal $goal, StoreGoalRequest $request): JsonResponse
    {
        $this->authorize('update', $goal);
        $goal->update($request->validated());
        return response()->json(['message' => 'Goal updated', 'data' => $goal]);
    }

    public function deleteGoal(Goal $goal): JsonResponse
    {
        $this->authorize('delete', $goal);
        $goal->delete();
        return response()->json(['message' => 'Goal deleted']);
    }
}
