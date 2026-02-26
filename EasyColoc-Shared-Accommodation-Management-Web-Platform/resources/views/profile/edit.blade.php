
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - EasyColoc</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 antialiased">
    @php
        $user = auth()->user();

        $userName = $user->name;
        $initial = strtoupper(substr($userName, 0, 1));

        $isAdmin = false;
        if ($user) {
            $isAdmin = $user->role?->name === 'Admin';
        }

    @endphp

    <div class="min-h-screen flex">


        <aside class="w-[270px] bg-white border-r border-slate-200 px-4 py-5 flex flex-col">

            <div class="flex items-center gap-3 px-2 mb-8">
                <div
                    class="w-10 h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-extrabold tracking-tight shadow-sm">
                    E
                </div>
                <div>
                    <div class="text-base font-semibold text-slate-900 leading-tight">EasyColoc</div>
                    <div class="text-xs text-slate-500 leading-tight">Member Area</div>
                </div>
            </div>

            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition
                'text-slate-600 hover:bg-slate-100 hover:text-slate-900' ">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center
                 'bg-slate-100 group-hover:bg-slate-200' ">
                        🏠
                    </span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('member.colocations.index') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition
                text-slate-600 hover:bg-slate-100 hover:text-slate-900 ">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center
                 bg-slate-100 group-hover:bg-slate-200 ">
                        👥
                    </span>
                    <span>Colocations</span>
                </a>

                @if ($isAdmin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                        <span
                            class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-slate-200">
                            🛡️
                        </span>
                        <span>Admin</span>
                    </a>
                @endif

                <a href="{{ route('profile.edit') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition bg-indigo-50 text-indigo-700">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-indigo-100">
                        👤
                    </span>
                    <span>Profile</span>
                </a>
            </nav>

          
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit"
                    class="w-full px-4 py-2.5 rounded-xl text-sm font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition shadow-sm">
                    Logout
                </button>
            </form>

          
            <div class="mt-auto pt-6">
                <div class="rounded-2xl bg-slate-900 text-white p-4 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-[11px] uppercase tracking-wider text-slate-300">Votre réputation</div>
                            <div class="text-2xl font-extrabold mt-1">+{{ $user->reputation ?? 0 }} points</div>
                        </div>
                        <div class="text-xs px-2 py-1 rounded-full bg-slate-700 text-slate-200">
                            Beta
                        </div>
                    </div>

                    <div class="h-2 bg-slate-700 rounded-full mt-4 overflow-hidden">
                        <div class="h-full w-1/3 bg-green-400"></div>
                    </div>
                    <div class="text-[11px] text-slate-300 mt-2">
                        Keep it high by paying on time.
                    </div>
                </div>
            </div>
        </aside>

      
        <main class="flex-1 px-6 py-6">
       
            <div class="flex items-center justify-between gap-4 mb-8">
                <div>
                    <div class="text-xs text-slate-500 mb-1">EasyColoc / Settings</div>
                    <h1 class="text-2xl font-semibold tracking-tight">Profile</h1>
                    <p class="text-sm text-slate-500 mt-1">Manage your account information & security</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}"
                        class="hidden sm:inline-flex px-4 py-2 rounded-xl text-sm font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition">
                        Back to Dashboard
                    </a>

                    <div
                        class="flex items-center gap-3 bg-white border border-slate-200 px-3 py-2 rounded-2xl shadow-sm">
                        <div class="text-right leading-tight">
                            <div class="text-sm font-semibold uppercase">{{ $userName }}</div>
                            <div class="text-xs text-slate-500">{{ $isAdmin ? 'ADMIN' : 'MEMBER' }}</div>
                        </div>

                        <div
                            class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold">
                            {{ $initial }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <aside class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <div class="flex items-center gap-4">
                            <div
                                class="h-14 w-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-extrabold text-xl shadow-sm">
                                {{ strtoupper(substr($userName, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="text-lg font-semibold text-slate-900 truncate">{{ $userName }}</div>
                                <div class="text-sm text-slate-500 truncate">{{ $user->email }}</div>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                                <div class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                                    Reputation</div>
                                <div class="mt-1 text-2xl font-bold text-slate-900">{{ $user->reputation ?? 0 }}</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                                <div class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Status
                                </div>
                                <div
                                    class="mt-2 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $user->is_banned ?? false ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' }}">
                                    {{ $user->is_banned ?? false ? 'Banned' : 'Active' }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 text-xs text-slate-500">
                            Tip: Use a unique password and update it regularly.
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <div class="text-sm font-semibold text-slate-900">Security checklist</div>
                        <ul class="mt-3 space-y-2 text-sm text-slate-600">
                            <li class="flex items-start gap-2">
                                <span class="mt-2 h-2 w-2 rounded-full bg-indigo-500"></span>
                                Use a unique password
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-2 h-2 w-2 rounded-full bg-indigo-500"></span>
                                Don’t share invite tokens publicly
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-2 h-2 w-2 rounded-full bg-indigo-500"></span>
                                Keep your email address up to date
                            </li>
                        </ul>
                    </div>
                </aside>

                <section class="lg:col-span-8 space-y-6">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
                        <div class="mt-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">


                        <div class="mt-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-red-200 shadow-sm p-6 sm:p-8">
                        <div class="flex items-start gap-4">


                            <div class="flex-1">


                                <div class="mt-6">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </main>
    </div>
</body>

</html>
