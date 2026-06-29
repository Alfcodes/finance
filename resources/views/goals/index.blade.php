@extends('layouts.app')
@section('title', 'Goals')
@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-4xl font-bold text-slate-900 mb-2">🎯 Financial Goals</h1>
        <p class="text-slate-600">Track your financial targets and milestones</p>
    </div>
    <button onclick="openModal()" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-6 rounded-lg">
        + Add Goal
    </button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    @forelse($goals as $goal)
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">{{ $goal->name }}</h3>
                    <p class="text-sm text-slate-600">{{ $goal->category }}</p>
                </div>
                <span class="text-2xl">🎯</span>
            </div>

            <div class="mb-4">
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-slate-600">Progress</span>
                    <span class="font-bold text-slate-900">{{ number_format(($goal->current / $goal->target) * 100, 0) }}%</span>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full" style="width: {{ min(100, ($goal->current / $goal->target) * 100) }}%"></div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <div class="text-xs text-slate-600 uppercase">Current</div>
                    <div class="text-lg font-bold text-slate-900">GHS {{ number_format($goal->current, 2) }}</div>
                </div>
                <div>
                    <div class="text-xs text-slate-600 uppercase">Target</div>
                    <div class="text-lg font-bold text-slate-900">GHS {{ number_format($goal->target, 2) }}</div>
                </div>
            </div>

            @if($goal->deadline)
                <div class="text-sm text-slate-600 mb-4">
                    📅 Due: {{ date('M d, Y', strtotime($goal->deadline)) }}
                </div>
            @endif

            <div class="flex gap-2">
                <button class="flex-1 text-blue-600 hover:text-blue-800 font-semibold">Edit</button>
                <button class="flex-1 text-red-600 hover:text-red-800 font-semibold">Delete</button>
            </div>
        </div>
    @empty
        <div class="col-span-2 bg-white rounded-xl shadow p-8 text-center">
            <p class="text-slate-500 mb-4">No goals yet. Click "Add Goal" to set your first financial target!</p>
        </div>
    @endforelse
</div>
@endsection
