<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Expenses - RoomieSync</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased selection:bg-indigo-500 selection:text-white pb-12">

  <nav class="bg-white/80 backdrop-blur border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                {{-- Brand --}}
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2">
                    <div
                        class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-extrabold text-lg shadow-sm">
                        R</div>
                    <span class="text-lg font-extrabold tracking-tight text-gray-900">RoomieSync</span>
                </a>

                {{-- Desktop nav --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('member.dashboard') }}"
                        class="px-3 py-2 rounded-xl text-sm font-bold transition
           {{ request()->routeIs('member.dashboard') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('member.balances') }}"
                        class="px-3 py-2 rounded-xl text-sm font-bold transition
           {{ request()->routeIs('member.balances') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        Balances
                    </a>

                    <a href="{{ route('member.expenses') }}"
                        class="px-3 py-2 rounded-xl text-sm font-bold transition
           {{ request()->routeIs('member.expenses') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        Expenses
                    </a>

                    <a href="{{ route('member.invitation') }}"
                        class="px-3 py-2 rounded-xl text-sm font-bold transition
           {{ request()->routeIs('member.invitation') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        Invitation
                    </a>

                    <a href="{{ route('profile.edit') }}"
                        class="ml-1 px-3 py-2 rounded-xl text-sm font-bold transition
           {{ request()->routeIs('profile.edit') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        Profile
                    </a>
                </div>

                {{-- Right --}}
                <div class="flex items-center gap-3">
                    <span
                        class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-blue-50 text-blue-700 border border-blue-200 uppercase tracking-wider">
                        Member
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

        {{-- Mobile: simple actions --}}
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
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Expenses</h1>
        <p class="text-gray-500 mt-1">View and add shared expenses for your home.</p>
      </div>

      <button class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 shadow-sm transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Expense
      </button>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
      <div class="flex items-center gap-3 w-full sm:w-auto">
        <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>

        <div class="flex-1">
          <select class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-xl font-bold text-gray-900 bg-gray-50 cursor-pointer">
            <option value="all">All Months</option>
            <option value="current" selected>Current Month (Feb 2026)</option>
            <option value="prev1">January 2026</option>
            <option value="prev2">December 2025</option>
          </select>
        </div>
      </div>

      <div class="px-4 py-2 bg-green-50 rounded-xl border border-green-100 flex items-center gap-3 w-full sm:w-auto justify-center sm:justify-start">
        <span class="text-sm text-green-700 font-semibold">Filtered Total:</span>
        <span class="text-lg font-extrabold text-green-800">$1,250.00</span>
      </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50/50">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Expense</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Paid By</th>
              <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-100 bg-white">
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">Feb 21, 2026</td>
              <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-bold text-gray-900">Internet Bill</div></td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100 uppercase tracking-wider">Utilities</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center gap-2">
                  <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xs">SJ</div>
                  <span class="text-sm font-medium text-gray-700">Sarah</span>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-extrabold text-gray-900">$60.00</td>
            </tr>

            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">Feb 18, 2026</td>
              <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-bold text-gray-900">Groceries</div></td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-orange-50 text-orange-700 border border-orange-100 uppercase tracking-wider">Food</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center gap-2">
                  <div class="h-6 w-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-xs">Y</div>
                  <span class="text-sm font-medium text-gray-700">You</span>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-extrabold text-gray-900">$120.50</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </main>
</body>
</html>