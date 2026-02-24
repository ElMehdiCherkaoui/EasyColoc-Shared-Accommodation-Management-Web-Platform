<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invitation - RoomieSync</title>
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
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Invitation</h1>
        <p class="text-gray-500 mt-1">Share the home token with a friend (Owner approves & manages invites).</p>
      </div>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 sm:p-8">
      <div class="flex items-start gap-4">
        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
          </svg>
        </div>
        <div class="flex-1">
          <h2 class="text-xl font-bold text-gray-900">Home Token</h2>
          <p class="text-gray-500 text-sm mt-1">
            Anyone with this token can request to join. The Owner handles invitations and member management.
          </p>

          <div class="mt-5 flex flex-col sm:flex-row gap-3 sm:items-center">
            <code class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-lg font-mono font-bold text-indigo-600 shadow-sm w-full sm:w-64 text-center tracking-widest">
              X79-B2Q
            </code>
            <button class="px-5 py-3 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 shadow-sm transition-colors">
              Copy
            </button>
          </div>

          <p class="text-xs text-gray-400 mt-3">
            Rule: You can only be active in one shared accommodation at a time.
          </p>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
      <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-900">Membership</h3>
        <span class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full text-xs font-semibold">Active</span>
      </div>

      <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <p class="font-bold text-gray-900">The Sunny Loft</p>
          <p class="text-sm text-gray-500">Joined Jan 15, 2026 · Role: Member</p>
        </div>

        <button class="px-5 py-2.5 border border-red-200 text-red-600 bg-red-50 hover:bg-red-100 hover:border-red-300 rounded-xl text-sm font-bold transition-colors shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
          Leave Accommodation
        </button>
      </div>
    </div>

  </main>
</body>
</html>