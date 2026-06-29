<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\IncomeEntry;
use App\Models\Saving;
use App\Models\Giving;
use App\Models\Family;
use App\Models\Goal;
use App\Models\BudgetSetting;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\StoreSavingRequest;
use App\Http\Requests\StoreGivingRequest;
use App\Http\Requests\StoreFamilyRequest;
use App\Http\Requests\StoreGoalRequest;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $expenses = $user->expenses()->get();
        $income_entries = $user->incomeEntries()->get();
        $savings = $user->savings()->get();
        $giving = $user->givings()->get();
        $family = $user->families()->get();
        $goals = $user->goals()->get();
        $budget = $user->budgetSetting;

        $stats = $this->computeStats($user);

        return view('dashboard', compact('expenses', 'income_entries', 'savings', 'giving', 'family', 'goals', 'budget', 'stats'));
    }

    // ========== EXPENSES ==========
    public function expenses()
    {
        $expenses = auth()->user()->expenses()->orderBy('date', 'desc')->paginate(20);
        $stats = $this->computeStats(auth()->user());
        return view('expenses.index', compact('expenses', 'stats'));
    }

    public function storeExpense(StoreExpenseRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        Expense::create($data);
        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
    }

    public function editExpense(Expense $expense)
    {
        $this->authorize('update', $expense);
        return view('expenses.edit', compact('expense'));
    }

    public function updateExpense(Expense $expense, StoreExpenseRequest $request)
    {
        $this->authorize('update', $expense);
        $expense->update($request->validated());
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    public function deleteExpense(Expense $expense)
    {
        $this->authorize('delete', $expense);
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }

    // ========== INCOME ==========
    public function incomeEntries()
    {
        $entries = auth()->user()->incomeEntries()->orderBy('date', 'desc')->paginate(20);
        $stats = $this->computeStats(auth()->user());
        return view('income.index', compact('entries', 'stats'));
    }

    public function storeIncome(StoreIncomeRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        IncomeEntry::create($data);
        return redirect()->route('income.index')->with('success', 'Income entry added successfully!');
    }

    public function editIncome(IncomeEntry $entry)
    {
        $this->authorize('update', $entry);
        return view('income.edit', compact('entry'));
    }

    public function updateIncome(IncomeEntry $entry, StoreIncomeRequest $request)
    {
        $this->authorize('update', $entry);
        $entry->update($request->validated());
        return redirect()->route('income.index')->with('success', 'Income entry updated successfully!');
    }

    public function deleteIncome(IncomeEntry $entry)
    {
        $this->authorize('delete', $entry);
        $entry->delete();
        return redirect()->route('income.index')->with('success', 'Income entry deleted successfully!');
    }

    // ========== SAVINGS ==========
    public function savings()
    {
        $savings = auth()->user()->savings()->get();
        $stats = $this->computeStats(auth()->user());
        return view('savings.index', compact('savings', 'stats'));
    }

    public function storeSaving(StoreSavingRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        Saving::create($data);
        return redirect()->route('savings.index')->with('success', 'Savings goal added successfully!');
    }

    public function editSaving(Saving $saving)
    {
        $this->authorize('update', $saving);
        return view('savings.edit', compact('saving'));
    }

    public function updateSaving(Saving $saving, StoreSavingRequest $request)
    {
        $this->authorize('update', $saving);
        $saving->update($request->validated());
        return redirect()->route('savings.index')->with('success', 'Savings goal updated successfully!');
    }

    public function deleteSaving(Saving $saving)
    {
        $this->authorize('delete', $saving);
        $saving->delete();
        return redirect()->route('savings.index')->with('success', 'Savings goal deleted successfully!');
    }

    // ========== GIVING ==========
    public function giving()
    {
        $entries = auth()->user()->givings()->orderBy('date', 'desc')->paginate(20);
        $stats = $this->computeStats(auth()->user());
        return view('giving.index', compact('entries', 'stats'));
    }

    public function storeGiving(StoreGivingRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        Giving::create($data);
        return redirect()->route('giving.index')->with('success', 'Giving entry added successfully!');
    }

    public function deleteGiving(Giving $entry)
    {
        $this->authorize('delete', $entry);
        $entry->delete();
        return redirect()->route('giving.index')->with('success', 'Giving entry deleted successfully!');
    }

    // ========== FAMILY ==========
    public function family()
    {
        $entries = auth()->user()->families()->orderBy('date', 'desc')->paginate(20);
        $stats = $this->computeStats(auth()->user());
        return view('family.index', compact('entries', 'stats'));
    }

    public function storeFamily(StoreFamilyRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        Family::create($data);
        return redirect()->route('family.index')->with('success', 'Family support record added successfully!');
    }

    public function deleteFamily(Family $entry)
    {
        $this->authorize('delete', $entry);
        $entry->delete();
        return redirect()->route('family.index')->with('success', 'Family support record deleted successfully!');
    }

    // ========== GOALS ==========
    public function goals()
    {
        $goals = auth()->user()->goals()->get();
        $stats = $this->computeStats(auth()->user());
        return view('goals.index', compact('goals', 'stats'));
    }

    public function storeGoal(StoreGoalRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['id'] = Str::uuid();

        Goal::create($data);
        return redirect()->route('goals.index')->with('success', 'Financial goal added successfully!');
    }

    public function updateGoal(Goal $goal, StoreGoalRequest $request)
    {
        $this->authorize('update', $goal);
        $goal->update($request->validated());
        return redirect()->route('goals.index')->with('success', 'Financial goal updated successfully!');
    }

    public function deleteGoal(Goal $goal)
    {
        $this->authorize('delete', $goal);
        $goal->delete();
        return redirect()->route('goals.index')->with('success', 'Financial goal deleted successfully!');
    }

    // ========== STATISTICS ==========
    public function computeStats($user)
    {
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

        return compact('totalExp', 'totalSav', 'totalGiving', 'totalFam', 'totalIncome', 'remaining', 'savingsRate', 'givingRate', 'budgetUtil', 'healthScore', 'income');
    }
}
