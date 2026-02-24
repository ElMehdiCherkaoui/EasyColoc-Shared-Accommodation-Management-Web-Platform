<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome Back - RoomieSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased flex min-h-screen selection:bg-indigo-500 selection:text-white">

    <div class="flex min-h-screen w-full">
        <div class="flex flex-col justify-center flex-1 px-4 py-12 sm:px-6 lg:flex-none lg:w-1/2 lg:px-20 xl:px-24 bg-white shadow-2xl z-10">
            <div class="mx-auto w-full max-w-md">
                
                <div class="mb-10">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">R</div>
                        <span class="text-xl font-bold tracking-tight text-gray-900">RoomieSync</span>
                    </div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-2">Welcome back</h2>
                    <p class="text-sm text-gray-500">Please enter your details to access your shared home.</p>
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

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required autofocus
                                class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 border py-3 px-4 text-sm focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 outline-none" placeholder="you@example.com">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors">Forgot password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 border py-3 px-4 text-sm focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 outline-none" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-2">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input id="remember_me" name="remember" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0 transition-colors cursor-pointer">
                            <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">Remember for 30 days</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/30 transition-all duration-200 transform hover:-translate-y-0.5">
                        Sign In
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </button>
                </form>

                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                        <div class="relative flex justify-center text-sm"><span class="px-2 bg-white text-gray-500">Or continue with</span></div>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <button type="button" class="w-full flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <img class="h-5 w-5 mr-2" src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google"> Google
                        </button>
                        <button type="button" class="w-full flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <img class="h-5 w-5 mr-2" src="https://www.svgrepo.com/show/512317/github-142.svg" alt="GitHub"> GitHub
                        </button>
                    </div>
                </div>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">Create an account</a>
                </p>
            </div>
        </div>

        <div class="hidden lg:block lg:flex-1 relative bg-gray-900 overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-indigo-800 via-gray-900 to-black"></div>
            
            <div class="absolute inset-0 flex flex-col justify-center px-16 xl:px-24 z-10">
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-sm font-medium mb-6 backdrop-blur-sm">
                        <span class="flex h-2 w-2 rounded-full bg-indigo-500"></span>
                        Version 2.0 is now live
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-6">
                        Shared expenses, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">zero friction.</span>
                    </h2>
                    <p class="text-lg text-gray-400 mb-10 leading-relaxed">
                        Join thousands of roommates who trust RoomieSync to automatically calculate balances, manage shared costs, and maintain a peaceful home.
                    </p>
                    
                    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl backdrop-blur-md">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://i.pravatar.cc/150?img=32" alt="User" class="w-12 h-12 rounded-full border-2 border-indigo-500/30">
                            <div>
                                <p class="text-white font-medium">Sarah Jenkins</p>
                                <div class="flex text-yellow-400 text-sm">★★★★★</div>
                            </div>
                        </div>
                        <p class="text-gray-300 text-sm italic">"RoomieSync completely eliminated the awkward 'you owe me' conversations. The automated balances and reputation score are genius."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>