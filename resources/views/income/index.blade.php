@extends('layouts.app')

@section('title', 'Income')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-4xl font-bold text-slate-900 mb-2">💵 Income</h1>
        <p class="text-slate-600">Track your income sources</p>
    </div>
    <button onclick="openModal()" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-6 rounded-lg">
        + Add Income
    </button>
</div>

<!-- Income Table -->
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Date</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Source</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Type</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Amount</th>
                <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($entries as $entry)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 text-sm text-slate-900">{{ $entry->date }}</td>
                    <td class="px-6 py-4 text-sm text-slate-900">{{ $entry->source }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                            {{ $entry->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-green-600">GHS {{ number_format($entry->amount, 2) }}</td>
                    <td class="px-6 py-4 text-right text-sm space-x-2">
                        <button class="text-blue-600 hover:text-blue-800 font-semibold">Edit</button>
                        <button class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                        No income entries yet. Click "Add Income" to get started!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="incomeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Add New Income</h2>

        <form action="{{ route('income.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Date</label>
                <input type="date" name="date" value="{{ today()->toDateString() }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Source</label>
                <input type="text" name="source" placeholder="e.g. Monthly Salary" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Type</label>
                <select name="type" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                    <option value="">Select type</option>
                    <option value="Salary">Salary</option>
                    <option value="Freelance">Freelance</option>
                    <option value="Business">Business</option>
                    <option value="Investment">Investment Returns</option>
                    <option value="Gift">Gift</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Amount (GHS)</label>
                <input type="number" name="amount" step="0.01" placeholder="0.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Notes (Optional)</label>
                <textarea name="notes" rows="3" placeholder="Add any notes..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"></textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg">
                    💾 Save Income
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
        document.getElementById('incomeModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('incomeModal').classList.add('hidden');
    }
</script>
@endsection
