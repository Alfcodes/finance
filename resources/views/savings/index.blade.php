@extends('layouts.app')

@section('title', 'Savings')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-4xl font-bold text-slate-900 mb-2">📈 Savings</h1>
        <p class="text-slate-600">Track your savings goals and investments</p>
    </div>
    <button onclick="openModal()" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-6 rounded-lg">
        + Add Savings
    </button>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-sm text-slate-600 font-semibold uppercase">Total Saved</div>
        <div class="text-3xl font-bold text-teal-600">GHS {{ number_format($stats['totalSav'], 2) }}</div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-sm text-slate-600 font-semibold uppercase">Savings Rate</div>
        <div class="text-3xl font-bold text-teal-600">{{ number_format($stats['savingsRate'] * 100, 1) }}%</div>
    </div>
</div>

<!-- Savings Table -->
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Name</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Type</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Current</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Target</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Progress</th>
                <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($savings as $saving)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 text-sm font-semibold text-slate-900">{{ $saving->name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $saving->type }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-teal-600">GHS {{ number_format($saving->current, 2) }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">GHS {{ number_format($saving->target, 2) }}</td>
                    <td class="px-6 py-4 text-sm">
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-teal-600 h-2 rounded-full" style="width: {{ min(100, ($saving->current / $saving->target) * 100) }}%"></div>
                        </div>
                        <span class="text-xs text-slate-600 mt-1">{{ number_format(($saving->current / $saving->target) * 100, 0) }}%</span>
                    </td>
                    <td class="px-6 py-4 text-right text-sm space-x-2">
                        <button class="text-blue-600 hover:text-blue-800 font-semibold">Edit</button>
                        <button class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                        No savings yet. Click "Add Savings" to get started!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="savingsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Add Savings Goal</h2>

        <form action="{{ route('savings.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Name</label>
                <input type="text" name="name" placeholder="e.g. Emergency Fund" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Type</label>
                <select name="type" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                    <option value="">Select type</option>
                    <option value="Savings">Savings Account</option>
                    <option value="Investment">Investment</option>
                    <option value="MobileMoney">Mobile Money</option>
                    <option value="Cash">Cash Box</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Current Amount (GHS)</label>
                <input type="number" name="current" step="0.01" placeholder="0.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Target Amount (GHS)</label>
                <input type="number" name="target" step="0.01" placeholder="0.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg">
                    💾 Save
                </button>
                <button type="button" onclick="closeModal()" class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-900 font-bold py-2 px-4 rounded-lg">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() { document.getElementById('savingsModal').classList.remove('hidden'); }
    function closeModal() { document.getElementById('savingsModal').classList.add('hidden'); }
</script>
@endsection
