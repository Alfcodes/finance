@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-slate-900 mb-2">Dashboard</h1>
    <p class="text-slate-600">Welcome back, {{ auth()->user()->name }}!</p>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-3xl mb-2">💵</div>
        <div class="text-sm text-slate-600 font-semibold uppercase">Monthly Income</div>
        <div class="text-3xl font-bold text-slate-900">GHS {{ number_format($stats['income'], 2) }}</div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-3xl mb-2">🛒</div>
        <div class="text-sm text-slate-600 font-semibold uppercase">Total Expenses</div>
        <div class="text-3xl font-bold text-red-600">GHS {{ number_format($stats['totalExp'], 2) }}</div>
        <div class="text-xs text-slate-500 mt-1">{{ number_format($stats['budgetUtil'] * 100, 1) }}% of income</div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-3xl mb-2">📈</div>
        <div class="text-sm text-slate-600 font-semibold uppercase">Total Savings</div>
        <div class="text-3xl font-bold text-teal-600">GHS {{ number_format($stats['totalSav'], 2) }}</div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-3xl mb-2">💚</div>
        <div class="text-sm text-slate-600 font-semibold uppercase">Remaining</div>
        <div class="text-3xl font-bold {{ $stats['remaining'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
            GHS {{ number_format($stats['remaining'], 2) }}
        </div>
    </div>
</div>

<!-- Health Meter -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-sm text-slate-600 font-semibold uppercase mb-4">Financial Health Score</div>
        <div class="relative w-32 h-32 mx-auto">
            <svg class="transform -rotate-90 w-full h-full" viewBox="0 0 120 70">
                <path d="M10 60 A 50 50 0 0 1 110 60" fill="none" stroke="#e5e7eb" stroke-width="12" stroke-linecap="round"/>
                <path d="M10 60 A 50 50 0 0 1 110 60" fill="none"
                    stroke="{{ $stats['healthScore'] >= 70 ? '#10b981' : ($stats['healthScore'] >= 40 ? '#f59e0b' : '#ef4444') }}"
                    stroke-width="12" stroke-linecap="round"
                    stroke-dasharray="{{ ($stats['healthScore'] / 100) * 157 }} 157"/>
                <text x="60" y="48" text-anchor="middle" fill="{{ $stats['healthScore'] >= 70 ? '#10b981' : ($stats['healthScore'] >= 40 ? '#f59e0b' : '#ef4444') }}" font-size="24" font-weight="900">
                    {{ number_format($stats['healthScore'], 0) }}
                </text>
                <text x="60" y="62" text-anchor="middle" fill="#9ca3af" font-size="10">
                    {{ $stats['healthScore'] >= 70 ? 'Excellent' : ($stats['healthScore'] >= 50 ? 'Good' : ($stats['healthScore'] >= 30 ? 'Fair' : 'At Risk')) }}
                </text>
            </svg>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-sm text-slate-600 font-semibold uppercase mb-4">Savings Rate</div>
        <div class="text-4xl font-bold text-teal-600">{{ number_format($stats['savingsRate'] * 100, 1) }}%</div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-sm text-slate-600 font-semibold uppercase mb-4">Giving Rate</div>
        <div class="text-4xl font-bold text-purple-600">{{ number_format($stats['givingRate'] * 100, 1) }}%</div>
    </div>
</div>

<!-- Recent Entries -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Recent Expenses</h2>
        @if($expenses->count() > 0)
            <div class="space-y-2">
                @foreach($expenses->take(5) as $expense)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <div class="font-semibold text-slate-900">{{ $expense->description }}</div>
                            <div class="text-xs text-slate-500">{{ $expense->date }} • {{ $expense->category }}</div>
                        </div>
                        <div class="font-bold text-red-600">GHS {{ number_format($expense->amount, 2) }}</div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-slate-500">No expenses yet. <a href="{{ route('expenses.index') }}" class="text-teal-600 hover:underline">Add one</a></p>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Recent Income</h2>
        @if($income_entries->count() > 0)
            <div class="space-y-2">
                @foreach($income_entries->take(5) as $entry)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <div class="font-semibold text-slate-900">{{ $entry->source }}</div>
                            <div class="text-xs text-slate-500">{{ $entry->date }} • {{ $entry->type }}</div>
                        </div>
                        <div class="font-bold text-green-600">GHS {{ number_format($entry->amount, 2) }}</div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-slate-500">No income entries yet. <a href="{{ route('income.index') }}" class="text-teal-600 hover:underline">Add one</a></p>
        @endif
    </div>
</div>
@endsection
