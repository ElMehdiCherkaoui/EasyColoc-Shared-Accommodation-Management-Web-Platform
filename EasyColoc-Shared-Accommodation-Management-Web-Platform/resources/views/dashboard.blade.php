<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - RoomieSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased selection:bg-indigo-500 selection:text-white min-h-screen flex flex-col">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">R</div>
                    <span class="text-xl font-bold tracking-tight text-gray-900">RoomieSync</span>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <span class="hidden sm:block text-sm font-medium text-gray-600">
                            {{ auth()->user()->name }}
                        </span>

                        <div class="h-9 w-9 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 border-2 border-white shadow-sm flex items-center justify-center text-white font-bold text-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="ml-2 inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 border border-gray-200">
                                Logout
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 border border-gray-200">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700">
                            Register
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-white border-b border-gray-200 shadow-sm relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-50 to-purple-50 opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-4">
                Welcome to RoomieSync
                @auth, {{ auth()->user()->name }}! @endauth
                🎉
            </h1>

            <p class="text-lg text-gray-500 max-w-2xl mx-auto">
                You're just one step away from stress-free shared living.
                To unlock the dashboard, you need to either create a new shared home or join an existing one.
            </p>
        </div>
    </div>

    <main class="flex-1 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- CREATE --}}
            <div class="bg-white rounded-3xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden group flex flex-col">
                <div class="h-32 bg-gradient-to-br from-indigo-500 to-purple-600 relative flex items-center justify-center">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20"></div>
                    <div class="w-20 h-20 bg-white rounded-2xl shadow-xl flex items-center justify-center absolute -bottom-10 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                </div>

                <div class="pt-16 pb-8 px-8 text-center flex-1 flex flex-col">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Create a New Home</h2>
                    <p class="text-gray-500 text-sm mb-8 flex-1">
                        Start fresh. You will become the <span class="font-bold text-gray-700">Owner</span>.
                        You'll be able to name the house, set up custom expense categories, and invite your roommates.
                    </p>

                    {{-- CHANGE THIS to your real route --}}
                    <a href=""
                       class="block w-full py-4 px-6 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 shadow-sm transition-colors focus:ring-4 focus:ring-indigo-500/30">
                        Set Up a Home
                    </a>
                </div>
            </div>

            {{-- JOIN --}}
            <div class="bg-white rounded-3xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden group flex flex-col">
                <div class="h-32 bg-gradient-to-br from-teal-400 to-emerald-600 relative flex items-center justify-center">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20"></div>
                    <div class="w-20 h-20 bg-white rounded-2xl shadow-xl flex items-center justify-center absolute -bottom-10 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                        </svg>
                    </div>
                </div>

                <div class="pt-16 pb-8 px-8 text-center flex-1 flex flex-col">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Join an Existing Home</h2>
                    <p class="text-gray-500 text-sm mb-6">
                        Did your roommate already set everything up? Enter the unique invite token they sent you to instantly connect to their household.
                    </p>

                    {{-- CHANGE THIS to your real route --}}
                    <form action="" method="POST" class="mt-auto">
                        @csrf

                        <div class="mb-4 text-left">
                            <label for="token" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                                Invite Token
                            </label>

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                </div>

                                <input type="text" name="token" id="token" required placeholder="e.g., X79-B2Q"
                                       class="block w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-center font-mono font-bold text-lg tracking-widest focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none shadow-inner uppercase">
                            </div>

                            @error('token')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="block w-full py-4 px-6 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 shadow-sm transition-colors focus:ring-4 focus:ring-teal-500/30">
                            Join Household
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <div class="mt-12 bg-white rounded-2xl border border-gray-200 p-6 flex items-center justify-center gap-3 text-sm text-gray-500 shadow-sm">
            <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                      clip-rule="evenodd"/>
            </svg>
            Note: You can only be an active member of <strong>one shared accommodation</strong> at a time.
        </div>
    </main>
</body>
</html>