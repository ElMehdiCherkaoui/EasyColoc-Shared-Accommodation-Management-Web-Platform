<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Home - RoomieSync</title>
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
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">Cancel</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 flex items-center justify-center p-4 sm:p-6">
        
        <div class="max-w-md w-full">
            <a href="#" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Back to choices
            </a>

            <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden relative">
                
                <div class="h-32 bg-gradient-to-br from-indigo-600 to-purple-700 relative flex items-center justify-center">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20"></div>
                    <div class="w-20 h-20 bg-white rounded-2xl shadow-lg flex items-center justify-center absolute -bottom-10 border-4 border-white">
                        <span class="text-4xl">🏠</span>
                    </div>
                </div>

                <div class="pt-16 pb-8 px-8 sm:px-10 text-center">
                    <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Name Your Home</h1>
                    <p class="text-sm text-gray-500 mt-2 mb-8">
                        Give your shared space a name. You will be assigned as the <span class="font-bold text-gray-700">Owner</span> of this accommodation.
                    </p>

                    <form action="#" method="POST" class="text-left space-y-6">
                        @csrf
                        
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider">Accommodation Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                </div>
                                <input type="text" name="name" id="name" required autofocus placeholder="e.g. The Sunny Loft" 
                                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-900 text-base font-medium focus:ring-0 focus:border-indigo-500 focus:bg-white transition-all outline-none shadow-sm placeholder-gray-400">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 flex gap-3">
                            <svg class="w-5 h-5 text-indigo-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <p class="text-xs text-indigo-800 leading-relaxed">
                                Once created, you can invite roommates, set up default categories, and start logging expenses immediately.
                            </p>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full flex justify-center items-center gap-2 py-4 px-4 border border-transparent rounded-xl shadow-sm text-base font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/30 transition-all transform hover:-translate-y-0.5">
                                Create & Become Owner
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </main>

</body>
</html>