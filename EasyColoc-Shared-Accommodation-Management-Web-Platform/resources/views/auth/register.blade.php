<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account - RoomieSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased flex min-h-screen selection:bg-teal-500 selection:text-white">

    <div class="flex min-h-screen w-full">
        <div class="hidden lg:block lg:flex-1 relative bg-gray-900 overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_var(--tw-gradient-stops))] from-teal-800 via-gray-900 to-black"></div>
            
            <div class="absolute inset-0 flex flex-col justify-center px-16 xl:px-24 z-10">
                <div class="max-w-xl">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-6">
                        Start managing your home <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-emerald-400">the smart way.</span>
                    </h2>
                    
                    <div class="space-y-6 mt-12">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-teal-500/20 border border-teal-500/30 flex items-center justify-center text-teal-400 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg">Automated Balances</h3>
                                <p class="text-gray-400 text-sm mt-1">We do the math. Instantly see exactly who owes whom without touching a spreadsheet.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-teal-500/20 border border-teal-500/30 flex items-center justify-center text-teal-400 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg">Reputation System</h3>
                                <p class="text-gray-400 text-sm mt-1">Good behavior is rewarded. Build a solid financial profile as a reliable roommate.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col justify-center flex-1 px-4 py-12 sm:px-6 lg:flex-none lg:w-1/2 lg:px-20 xl:px-24 bg-white shadow-2xl z-10 overflow-y-auto">
            <div class="mx-auto w-full max-w-md">
                
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-teal-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">R</div>
                        <span class="text-xl font-bold tracking-tight text-gray-900">RoomieSync</span>
                    </div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-2">Create an account</h2>
                    <p class="text-sm text-gray-500">Enter your details to get started for free.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            </div>
                            <div class="ml-3 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="invitation_token" value="{{ $invitation_token ?? request('invitation_token') }}">

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <input id="name" name="name" type="text" autocomplete="name" required autofocus
                                class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 border py-2.5 px-4 text-sm focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all duration-200 outline-none" placeholder="John Doe">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email', $email ?? '') }}" required 
                                class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 border py-2.5 px-4 text-sm focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all duration-200 outline-none" placeholder="you@example.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="new-password" required
                                    class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 border py-2.5 px-4 text-sm focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all duration-200 outline-none" placeholder="••••••••">
                            </div>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                                    class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 border py-2.5 px-4 text-sm focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all duration-200 outline-none" placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start mt-4">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required class="w-4 h-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500 focus:ring-offset-0 transition-colors cursor-pointer">
                        </div>
                        <div class="ml-2 text-sm">
                            <label for="terms" class="text-gray-600">I agree to the <a href="#" class="font-medium text-teal-600 hover:underline">Terms</a> and <a href="#" class="font-medium text-teal-600 hover:underline">Privacy Policy</a>.</label>
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 mt-4 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-500/30 transition-all duration-200 transform hover:-translate-y-0.5">
                        Create Account
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-semibold text-teal-600 hover:text-teal-500 transition-colors">Log in here</a>
                </p>
            </div>
        </div>

    </div>

</body>
</html>
