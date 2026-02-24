{{-- resources/views/profile/edit.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - RoomieSync</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased selection:bg-indigo-500 selection:text-white min-h-screen">

@php
    $user = auth()->user();
    $isOwner = (bool) ($user->is_owner ?? false);

    // Optional: if you have membership role, you can replace $isOwner with it later.
@endphp

{{-- TOP NAV (best practice: compact + user menu + consistent spacing) --}}
<nav class="bg-white/80 backdrop-blur border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16 flex items-center justify-between gap-4">

            {{-- Left: Brand --}}
            <div class="flex items-center gap-3">
                <a href="{{ $isOwner ? route('owner.dashboard') : route('member.dashboard') }}"
                   class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-extrabold text-lg shadow-sm">
                        R
                    </div>
                    <span class="text-lg font-extrabold tracking-tight text-slate-900">RoomieSync</span>
                </a>

                <span class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider border
                    {{ $isOwner ? 'bg-purple-50 text-purple-700 border-purple-200' : 'bg-blue-50 text-blue-700 border-blue-200' }}">
                    {{ $isOwner ? 'Owner' : 'Member' }}
                </span>
            </div>

            {{-- Middle: links (desktop) --}}
            <div class="hidden md:flex items-center gap-1">
    @if($isOwner)
        <a href="{{ route('owner.dashboard') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
            Dashboard
        </a>

        <a href="{{ route('owner.expenses') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
            Expenses
        </a>

        <a href="{{ route('owner.members') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
            Roommates
        </a>

        <a href="{{ route('owner.categories') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
            Categories
        </a>
    @else
        <a href="{{ route('member.dashboard') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
            Dashboard
        </a>

        <a href="{{ route('member.balances') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
            Balances
        </a>

        <a href="{{ route('member.expenses') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
            Expenses
        </a>

        <a href="{{ route('member.invitations') }}"
           class="px-3 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
            Invitation
        </a>
    @endif

    <a href="{{ route('profile.edit') }}"
       class="ml-2 px-3 py-2 rounded-xl text-sm font-extrabold text-indigo-700 bg-indigo-50 border border-indigo-200">
        Profile
    </a>
</div>

            {{-- Right: user menu + logout --}}
            <div class="flex items-center gap-3">
                <div class="hidden sm:block text-right">
                    <div class="text-sm font-extrabold text-slate-800 leading-4">{{ $user->name }}</div>
                    <div class="text-xs text-slate-500">{{ $user->email }}</div>
                </div>

                <a href="{{ route('profile.edit') }}"
                   class="h-10 w-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 border-2 border-white shadow-sm flex items-center justify-center text-white font-extrabold text-sm">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="hidden sm:inline-flex px-4 py-2 rounded-xl text-sm font-extrabold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>

    {{-- Mobile row (simple best practice: only show Profile + Logout) --}}
    <div class="md:hidden border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
            <a href="{{ route('profile.edit') }}"
               class="px-3 py-2 rounded-xl text-sm font-extrabold text-indigo-700 bg-indigo-50 border border-indigo-200">
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="px-4 py-2 rounded-xl text-sm font-extrabold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- PAGE HEADER --}}
<header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">Profile</h1>
            <p class="mt-2 text-slate-600 max-w-2xl">
                Keep your account up to date. Changes here affect your access and notifications.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ $isOwner ? route('owner.dashboard') : route('member.dashboard') }}"
               class="px-4 py-2 rounded-xl text-sm font-extrabold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition">
                Back to Dashboard
            </a>
        </div>
    </div>
</header>

{{-- CONTENT --}}
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        {{-- Left column: quick summary --}}
        <aside class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 rounded-2xl bg-gradient-to-tr from-indigo-500 to-purple-500 text-white flex items-center justify-center font-extrabold text-xl shadow-sm">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="text-lg font-extrabold text-slate-900 truncate">{{ $user->name }}</div>
                        <div class="text-sm text-slate-500 truncate">{{ $user->email }}</div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                        <div class="text-xs font-extrabold uppercase tracking-wider text-slate-500">Reputation</div>
                        <div class="mt-1 text-2xl font-extrabold text-slate-900">{{ $user->reputation ?? 0 }}</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                        <div class="text-xs font-extrabold uppercase tracking-wider text-slate-500">Status</div>
                        <div class="mt-1 text-sm font-extrabold {{ ($user->is_banned ?? false) ? 'text-red-600' : 'text-green-600' }}">
                            {{ ($user->is_banned ?? false) ? 'Banned' : 'Active' }}
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-xs text-slate-500">
                    Tip: Use a strong password and update it regularly.
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <div class="text-sm font-extrabold text-slate-900">Security checklist</div>
                <ul class="mt-3 space-y-2 text-sm text-slate-600">
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-indigo-500"></span>
                        Use a unique password
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-indigo-500"></span>
                        Don’t share invite tokens publicly
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-indigo-500"></span>
                        Review your email address
                    </li>
                </ul>
            </div>
        </aside>

        {{-- Right column: forms --}}
        <section class="lg:col-span-8 space-y-6">

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900">Profile Information</h2>
                        <p class="mt-1 text-sm text-slate-600">Update your name and email address.</p>
                    </div>
                </div>

                <div class="mt-6">
                    {{-- Breeze partial (keep names) --}}
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900">Password</h2>
                        <p class="mt-1 text-sm text-slate-600">Choose a strong password to secure your account.</p>
                    </div>
                </div>

                <div class="mt-6">
                    {{-- Breeze partial (keep names) --}}
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-red-200 shadow-sm p-6 sm:p-8">
                <div class="flex items-start gap-4">
                    <div class="h-10 w-10 rounded-2xl bg-red-50 border border-red-200 flex items-center justify-center text-red-700">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01M5.07 19H18.93c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
                        </svg>
                    </div>

                    <div class="flex-1">
                        <h2 class="text-lg font-extrabold text-red-800">Danger Zone</h2>
                        <p class="mt-1 text-sm text-slate-600">
                            Deleting your account is permanent. This cannot be undone.
                        </p>

                        <div class="mt-6">
                            {{-- Breeze partial (keep names) --}}
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</main>

</body>
</html>