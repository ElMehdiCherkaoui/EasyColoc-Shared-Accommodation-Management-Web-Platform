<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owner Dashboard - RoomieSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased selection:bg-indigo-500 selection:text-white pb-12">

    <nav class="bg-white/80 backdrop-blur border-b border-gray-200 sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">

      <a href="{{ route('owner.dashboard') }}" class="flex items-center gap-2">
        <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-extrabold text-lg shadow-sm">R</div>
        <span class="text-lg font-extrabold tracking-tight text-gray-900">RoomieSync</span>
      </a>

      <div class="hidden md:flex items-center gap-1">
        <a href="{{ route('owner.dashboard') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold transition
           {{ request()->routeIs('owner.dashboard') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
          Dashboard
        </a>

        <a href="{{ route('owner.expenses') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold transition
           {{ request()->routeIs('owner.expenses') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
          Expenses
        </a>

        <a href="{{ route('owner.members') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold transition
           {{ request()->routeIs('owner.members') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
          Roommates
        </a>

        <a href="{{ route('owner.categories') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold transition
           {{ request()->routeIs('owner.categories') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
          Categories
        </a>

        <a href="{{ route('profile.edit') }}"
           class="ml-1 px-3 py-2 rounded-xl text-sm font-bold transition
           {{ request()->routeIs('profile.edit') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
          Profile
        </a>
      </div>

      <div class="flex items-center gap-3">
        <span class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-purple-50 text-purple-700 border border-purple-200 uppercase tracking-wider">
          Owner
        </span>

        <div class="hidden sm:block text-right leading-4">
          <div class="text-sm font-extrabold text-gray-800">{{ auth()->user()->name }}</div>
          <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
        </div>

        <a href="{{ route('profile.edit') }}"
           class="h-10 w-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 border-2 border-white shadow-sm flex items-center justify-center text-white font-extrabold text-sm">
          {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
                  class="hidden sm:inline-flex px-4 py-2 rounded-xl text-sm font-extrabold bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 shadow-sm transition">
            Logout
          </button>
        </form>
      </div>

    </div>
  </div>

  <div class="md:hidden border-t border-gray-200 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
      <a href="{{ route('profile.edit') }}"
         class="px-3 py-2 rounded-xl text-sm font-extrabold text-indigo-700 bg-indigo-50 border border-indigo-200">
        Profile
      </a>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="px-4 py-2 rounded-xl text-sm font-extrabold bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 shadow-sm transition">
          Logout
        </button>
      </form>
    </div>
  </div>
</nav>

    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">The Sunny Loft</h1>
                <p class="text-gray-500 mt-1">Welcome back, Alex. Here is the financial status of your home.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-bold rounded-xl hover:bg-gray-50 shadow-sm transition-colors">
                    Invite Member
                </button>
                <button class="px-4 py-2 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 shadow-sm transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Add Expense
                </button>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm relative overflow-hidden">
                <p class="text-sm font-medium text-gray-500 mb-1">Total House Spending</p>
                <h2 class="text-4xl font-extrabold text-gray-900">$1,250.00</h2>
                <p class="text-sm text-gray-500 mt-2">Current Month</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm relative overflow-hidden">
                <p class="text-sm font-medium text-gray-500 mb-1">Your Balance</p>
                <h2 class="text-4xl font-extrabold text-green-600">+$20.00</h2>
                <p class="text-sm text-gray-500 mt-2">You are owed money</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm relative overflow-hidden">
                <p class="text-sm font-medium text-gray-500 mb-1">Active Roommates</p>
                <h2 class="text-4xl font-extrabold text-indigo-600">3</h2>
                <p class="text-sm text-gray-500 mt-2">All members active</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Who Owes Whom</h3>
                <span class="bg-indigo-100 text-indigo-700 py-1 px-3 rounded-full text-xs font-semibold">Live Balances</span>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 bg-white shadow-sm hover:border-indigo-200 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center font-bold text-orange-600">MK</div>
                        <div>
                            <p class="text-gray-900 font-medium"><span class="font-bold">Mike</span> owes you</p>
                            <p class="text-xs text-gray-500">For overall balance</p>
                        </div>
                    </div>
                    <span class="text-xl font-bold text-green-600">$20.00</span>
                </div>
                
                <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 bg-white shadow-sm hover:border-indigo-200 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-600">SJ</div>
                        <div>
                            <p class="text-gray-900 font-medium"><span class="font-bold">Sarah</span> owes Mike</p>
                            <p class="text-xs text-gray-500">For overall balance</p>
                        </div>
                    </div>
                    <span class="text-xl font-bold text-gray-900">$45.00</span>
                </div>
            </div>
        </div>

    </main>
</body>
</html>