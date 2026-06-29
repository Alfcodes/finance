<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance | @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-900 text-white shadow-lg flex flex-col">
            <div class="p-6 border-b border-slate-700">
                <h1 class="text-2xl font-bold">💰 Finance</h1>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-teal-600' : 'hover:bg-slate-800' }}">
                    📊 Dashboard
                </a>
                <a href="{{ route('expenses.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('expenses.*') ? 'bg-teal-600' : 'hover:bg-slate-800' }}">
                    🛒 Expenses
                </a>
                <a href="{{ route('income.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('income.*') ? 'bg-teal-600' : 'hover:bg-slate-800' }}">
                    💵 Income
                </a>
                <a href="{{ route('savings.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('savings.*') ? 'bg-teal-600' : 'hover:bg-slate-800' }}">
                    📈 Savings
                </a>
                <a href="{{ route('giving.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('giving.*') ? 'bg-teal-600' : 'hover:bg-slate-800' }}">
                    🙏 Giving
                </a>
                <a href="{{ route('family.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('family.*') ? 'bg-teal-600' : 'hover:bg-slate-800' }}">
                    👨‍👩‍👧 Family
                </a>
                <a href="{{ route('goals.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('goals.*') ? 'bg-teal-600' : 'hover:bg-slate-800' }}">
                    🎯 Goals
                </a>
            </nav>

            <div class="p-4 border-t border-slate-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 bg-red-600 rounded-lg hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="max-w-7xl mx-auto p-8">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
