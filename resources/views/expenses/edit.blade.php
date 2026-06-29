@extends('layouts.app')

@section('title', 'Edit Expense')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('expenses.index') }}" class="text-teal-600 hover:underline mb-4 inline-block">← Back to Expenses</a>
        <h1 class="text-4xl font-bold text-slate-900">Edit Expense</h1>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="text-red-800 font-semibold mb-2">Please fix the following errors:</div>
            <ul class="list-disc list-inside text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-8">
        <form action="{{ route('expenses.update', $expense) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Date</label>
                <input type="date" name="date" value="{{ $expense->date }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Description</label>
                <input type="text" name="description" value="{{ $expense->description }}" placeholder="e.g. Groceries" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Category</label>
                <select name="category" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                    <option value="Food" {{ $expense->category == 'Food' ? 'selected' : '' }}>🍽️ Food</option>
                    <option value="Transport" {{ $expense->category == 'Transport' ? 'selected' : '' }}>🚗 Transport</option>
                    <option value="Utilities" {{ $expense->category == 'Utilities' ? 'selected' : '' }}>💡 Utilities</option>
                    <option value="Entertainment" {{ $expense->category == 'Entertainment' ? 'selected' : '' }}>🎭 Entertainment</option>
                    <option value="Other" {{ $expense->category == 'Other' ? 'selected' : '' }}>📦 Other</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Amount (GHS)</label>
                <input type="number" name="amount" step="0.01" value="{{ $expense->amount }}" placeholder="0.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Payment Method</label>
                <select name="method" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                    <option value="Cash" {{ $expense->method == 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="Card" {{ $expense->method == 'Card' ? 'selected' : '' }}>Card</option>
                    <option value="Transfer" {{ $expense->method == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="Mobile Money" {{ $expense->method == 'Mobile Money' ? 'selected' : '' }}>Mobile Money</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Vendor</label>
                <input type="text" name="vendor" value="{{ $expense->vendor }}" placeholder="e.g. Melcom" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Notes</label>
                <textarea name="notes" rows="4" placeholder="Add any notes..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">{{ $expense->notes }}</textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-4 rounded-lg">
                    💾 Save Changes
                </button>
                <a href="{{ route('expenses.index') }}" class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-900 font-bold py-3 px-4 rounded-lg text-center">
                    Cancel
                </a>
            </div>
        </form>

        <hr class="my-6">

        <div class="text-center">
            <form action="{{ route('expenses.delete', $expense) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this expense?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">
                    🗑️ Delete Expense
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
