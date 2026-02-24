<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shared Living, Simplified</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-50 text-gray-900 font-sans">

    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-2xl font-extrabold text-indigo-600">RoomieSync</span>
                </div>
                <div class="flex space-x-4">
                    <a href="{{route('login')}}" class="text-gray-600 hover:text-indigo-600 font-medium px-3 py-2 rounded-md transition">Log in</a>
                    <a href="{{route('register')}}" class="bg-indigo-600 text-white hover:bg-indigo-700 font-medium px-4 py-2 rounded-md transition">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-20 px-4 sm:px-6 lg:px-8">
                <main class="mx-auto max-w-7xl">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Manage your shared</span>
                            <span class="block text-indigo-600 xl:inline">accommodation easily</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Say goodbye to awkward money conversations. Track shared expenses, automatically calculate "who owes whom," and build a solid roommate reputation all in one place.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg transition">
                                    Get Started
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#features" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg transition">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-indigo-50 flex items-center justify-center">
            <div class="p-12 text-center">
                <div class="bg-white p-6 rounded-xl shadow-xl border border-gray-100 transform rotate-3 hover:rotate-0 transition duration-300">
                    <h3 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4">Total Balances</h3>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-600">You owe Sarah</span>
                        <span class="text-red-500 font-bold">$45.00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Mark owes you</span>
                        <span class="text-green-500 font-bold">$20.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="features" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Everything you need for peace of mind
                </p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mb-4 text-xl font-bold">
                            💸
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Smart Expense Tracking</h3>
                        <p class="text-gray-500 text-sm">Add expenses, assign categories, and let the system automatically calculate the individual shares for everyone in the house.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mb-4 text-xl font-bold">
                            ⚖️
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Simplified Balances</h3>
                        <p class="text-gray-500 text-sm">Instantly see a clean "who owes whom" summary. Settle debts with a simple "Mark as paid" button.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center mb-4 text-xl font-bold">
                            ⭐
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Reputation System</h3>
                        <p class="text-gray-500 text-sm">Build trust. Leaving a shared accommodation with unpaid debts lowers your score, while clean departures boost it.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-200 py-8 text-center">
        <p class="text-gray-400 text-sm">
            &copy; {{ date('Y') }} RoomieSync. All rights reserved. Built with Laravel.
        </p>
    </footer>

</body>
</html>