@extends('layouts.app')

@section('title', 'Expenses')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-4xl font-bold text-slate-900 mb-2">🛒 Expenses</h1>
        <p class="text-slate-600">Track your spending</p>
    </div>
    <button onclick="openModal()" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-6 rounded-lg">
        + Add Expense
    </button>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-sm text-slate-600 font-semibold uppercase">Total Expenses</div>
        <div class="text-3xl font-bold text-red-600">GHS {{ number_format($stats['totalExp'], 2) }}</div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-sm text-slate-600 font-semibold uppercase">Budget Used</div>
        <div class="text-3xl font-bold text-amber-600">{{ number_format($stats['budgetUtil'] * 100, 1) }}%</div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-sm text-slate-600 font-semibold uppercase">Total Entries</div>
        <div class="text-3xl font-bold text-blue-600">{{ $expenses->count() }}</div>
    </div>
</div>

<!-- Expenses Table -->
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Date</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Description</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Category</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Amount</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Method</th>
                <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($expenses as $expense)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 text-sm text-slate-900">{{ $expense->date }}</td>
                    <td class="px-6 py-4 text-sm text-slate-900">{{ $expense->description }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                            {{ $expense->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-red-600">GHS {{ number_format($expense->amount, 2) }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $expense->method }}</td>
                    <td class="px-6 py-4 text-right text-sm space-x-2">
                        <button class="text-blue-600 hover:text-blue-800 font-semibold">Edit</button>
                        <button class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                        No expenses yet. Click "Add Expense" to get started!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="expenseModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Add New Expense</h2>

        <form action="{{ route('expenses.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Date</label>
                <input type="date" name="date" value="{{ today()->toDateString() }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Description</label>
                <input type="text" name="description" placeholder="e.g. Groceries" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Category</label>
                <select name="category" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                    <option value="">Select a category</option>
                    <option value="Food">🍽️ Food</option>
                    <option value="Transport">🚗 Transport</option>
                    <option value="Utilities">💡 Utilities</option>
                    <option value="Entertainment">🎭 Entertainment</option>
                    <option value="Other">📦 Other</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Amount (GHS)</label>
                <input type="number" name="amount" step="0.01" placeholder="0.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Payment Method</label>
                <select name="method" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                    <option value="">Select method</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Transfer">Transfer</option>
                    <option value="Mobile Money">Mobile Money</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Vendor (Optional)</label>
                <input type="text" name="vendor" placeholder="e.g. Melcom" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Notes (Optional)</label>
                <textarea name="notes" rows="3" placeholder="Add any notes..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"></textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg">
                    💾 Save Expense
                </button>
                <button type="button" onclick="closeModal()" class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-900 font-bold py-2 px-4 rounded-lg">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('expenseModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('expenseModal').classList.add('hidden');
    }
</script>
@endsection
