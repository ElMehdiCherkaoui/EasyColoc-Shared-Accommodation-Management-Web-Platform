<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="header">Platform Overview</x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity"><svg class="w-20 h-20 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Users</p>
                <h2 class="text-3xl font-extrabold text-gray-900">1,248</h2>
                <p class="text-sm text-green-600 mt-2 flex items-center gap-1 font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    +12% this month
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity"><svg class="w-20 h-20 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg></div>
                <p class="text-sm font-medium text-gray-500 mb-1">Active Accommodations</p>
                <h2 class="text-3xl font-extrabold text-gray-900">342</h2>
                <p class="text-sm text-green-600 mt-2 flex items-center gap-1 font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    +24 new homes
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity"><svg class="w-20 h-20 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Expenses Tracked</p>
                <h2 class="text-3xl font-extrabold text-gray-900">$1.4M</h2>
                <p class="text-sm text-gray-500 mt-2 flex items-center gap-1">Across platform history</p>
            </div>

            <div class="bg-white rounded-2xl border border-red-200 p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity"><svg class="w-20 h-20 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg></div>
                <p class="text-sm font-medium text-red-500 mb-1">Banned Users</p>
                <h2 class="text-3xl font-extrabold text-red-600">12</h2>
                <p class="text-sm text-red-500 mt-2 flex items-center gap-1 font-medium">Requires attention</p>
            </div>
        </div>

    </div>
</x-admin-layout>