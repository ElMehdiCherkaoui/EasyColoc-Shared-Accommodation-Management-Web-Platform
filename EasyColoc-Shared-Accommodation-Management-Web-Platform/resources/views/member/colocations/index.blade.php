<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes colocations - EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-slate-200">
                        🏠
                    </span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('member.colocations.index') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition bg-indigo-50 text-indigo-700">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-indigo-100">
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
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-slate-200">
                        👤
                    </span>
                    <span>Profile</span>
                </a>
            </nav>

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
                    <div class="text-xs text-slate-500 mb-1">EasyColoc / Member</div>
                    <h1 class="text-2xl font-semibold tracking-tight">Mes colocations</h1>
                    <p class="text-sm text-slate-500 mt-1">Create or manage your shared homes</p>
                </div>

                <div class="flex items-center gap-3">
                    @if ($hasActiveColoc)
                        <button disabled
                            class="px-4 py-2 rounded-xl bg-slate-200 text-slate-500 font-semibold cursor-not-allowed border border-slate-200">
                            + Nouvelle colocation
                        </button>
                    @else
                        <a href="{{ route('member.colocations.create') }}"
                            class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm">
                            + Nouvelle colocation
                        </a>
                    @endif

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


            <section class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="p-6 border-b border-slate-200 flex items-center justify-between">
                    <div>
                        <h2 class="font-semibold text-lg">Colocations</h2>
                        <p class="text-sm text-slate-500">All your current and past shared homes</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="text" placeholder="Search..."
                            class="hidden sm:block text-sm border border-slate-200 rounded-xl px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                    </div>
                </div>

                @if ($memberships->isEmpty())
                    <div class="text-center py-24 text-slate-500">
                        <div
                            class="mx-auto w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-3xl">
                            👥
                        </div>
                        <div class="mt-4 text-lg font-semibold text-slate-800">Aucune colocation</div>
                        <div class="text-sm mt-1">Commencez par en créer une nouvelle.</div>

                        @if (!$hasActiveColoc)
                            <a href="{{ route('member.colocations.create') }}"
                                class="inline-flex mt-6 px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm">
                                + Nouvelle colocation
                            </a>
                        @endif
                    </div>
                @else
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach ($memberships as $m)
                            @php
                                $isActive = $m->is_active;
                                $isCancelled = $m->sharedAccommodation->status === 'false' ;
                            @endphp

                            @if ($isCancelled)
                                <div class="group rounded-2xl border p-5 shadow-sm hover:shadow-md transition bg-white border-slate-200 opacity-70">
                            @else
                                <a href="{{ route('member.colocations.show', $m->shared_accommodation_id) }}"
                                    class="group rounded-2xl border p-5 shadow-sm hover:shadow-md transition bg-indigo-50 border-indigo-200">
                            @endif

                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-11 h-11 rounded-2xl border flex items-center justify-center bg-indigo-100 border-indigo-200 text-indigo-700">
                                        🏠
                                    </div>

                                    <div>
                                        <div
                                            class="font-semibold text-slate-900 group-hover:text-indigo-700 transition">
                                            {{ $m->sharedAccommodation->name  }}
                                        </div>
                                        <div class="text-xs text-slate-500">
                                            Joined {{ \Carbon\Carbon::parse($m->joined_at)->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>

                                @if ($isActive && !$isCancelled && $m->sharedAccommodation->status === 'active')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                                        Active
                                    </span>
                                @elseif($isCancelled)
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></span>
                                        Cancelled
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-50 text-slate-700 border border-slate-200">
                                        History
                                    </span>
                                @endif
                            </div>

                            <div class="mt-4 text-sm text-slate-600">
                                Role: <span class="font-semibold">{{ strtoupper($m->role) }}</span>
                            </div>

                            @if ($isCancelled)
                                </div>
                            @else
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </section>

        </main>
    </div>
</body>

</html>
