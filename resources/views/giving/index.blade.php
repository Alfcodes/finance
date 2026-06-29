@extends('layouts.app')
@section('title', 'Giving')
@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-4xl font-bold text-slate-900 mb-2">🙏 Giving</h1>
        <p class="text-slate-600">Track your charitable giving</p>
    </div>
    <button onclick="openModal()" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-6 rounded-lg">
        + Add Giving
    </button>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Date</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Recipient</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Type</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Amount</th>
                <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($entries as $entry)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 text-sm text-slate-900">{{ $entry->date }}</td>
                    <td class="px-6 py-4 text-sm text-slate-900">{{ $entry->recipient }}</td>
                    <td class="px-6 py-4 text-sm"><span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">{{ $entry->type }}</span></td>
                    <td class="px-6 py-4 text-sm font-bold text-purple-600">GHS {{ number_format($entry->amount, 2) }}</td>
                    <td class="px-6 py-4 text-right text-sm space-x-2">
                        <button class="text-blue-600 hover:text-blue-800">Edit</button>
                        <button class="text-red-600 hover:text-red-800">Delete</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">No giving records yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
