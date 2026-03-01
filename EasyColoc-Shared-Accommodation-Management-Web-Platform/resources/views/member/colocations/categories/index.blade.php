<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-900 antialiased">
    @php
        $user = auth()->user();
        $userName = $user->name;
        $initial = strtoupper(substr($userName, 0, 1));
        $isAdmin = $user?->role?->name === 'Admin';
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
                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-slate-200">🏠</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('member.colocations.index') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition bg-indigo-50 text-indigo-700">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-indigo-100">👥</span>
                    <span>Colocations</span>
                </a>

                @if ($isAdmin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                        <span
                            class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-slate-200">🛡️</span>
                        <span>Admin</span>
                    </a>
                @endif

                <a href="{{ route('profile.edit') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-slate-200">👤</span>
                    <span>Profile</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 px-6 py-6">
          

            <div class="flex items-center justify-between gap-4 mb-8">
                <div>
                    <div class="text-xs text-slate-500 mb-1">EasyColoc / Colocations / Categories</div>
                    <h1 class="text-2xl font-semibold tracking-tight">Categories</h1>
                    <p class="text-sm text-slate-500 mt-1">{{ strtoupper($colocation->name) }}</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('member.colocations.show', $colocation->id) }}"
                        class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold hover:bg-slate-50 transition shadow-sm">
                        Retour
                    </a>
                    <a href="{{ route('member.colocations.categories.create', $colocation->id) }}"
                        class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm">
                        + Nouvelle catégorie
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

            <section class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden max-w-4xl">
                <div class="p-5 border-b border-slate-200">
                    <h2 class="font-semibold text-lg">Category list</h2>
                </div>

                <div class="p-5">
                    @if ($categories->isEmpty())
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-8 text-center text-slate-600">
                            No categories yet.
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach ($categories as $category)
                                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                                    <div class="text-sm font-semibold text-slate-800">{{ $category->name }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>
</body>

</html>
