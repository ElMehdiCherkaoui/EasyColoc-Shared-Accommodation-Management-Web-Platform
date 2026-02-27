<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colocation - EasyColoc</title>
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

            <div class="mt-auto pt-6">
                <div class="rounded-2xl bg-slate-900 text-white p-4 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-[11px] uppercase tracking-wider text-slate-300">Votre réputation</div>
                            <div class="text-2xl font-extrabold mt-1">+{{ $user->reputation ?? 0 }} points</div>
                        </div>
                        <div class="text-xs px-2 py-1 rounded-full bg-slate-700 text-slate-200">Beta</div>
                    </div>

                    <div class="h-2 bg-slate-700 rounded-full mt-4 overflow-hidden">
                        <div class="h-full w-1/3 bg-green-400"></div>
                    </div>
                    <div class="text-[11px] text-slate-300 mt-2">Keep it high by paying on time.</div>
                </div>
            </div>
        </aside>

        <main class="flex-1 px-6 py-6">

            <div class="flex items-center justify-between gap-4 mb-8">
                <div>
                    <div class="text-xs text-slate-500 mb-1">EasyColoc / Colocations</div>
                    <h1 class="text-2xl font-semibold tracking-tight">{{ strtoupper($colocation->name) }}</h1>
                    <p class="text-sm text-slate-500 mt-1">Manage expenses and members</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href=""
                        class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold hover:bg-slate-50 transition shadow-sm">
                        Annuler la colocation
                    </a>

                    <a href="{{ route('member.colocations.index') }}"
                        class="px-4 py-2 rounded-xl bg-slate-900 text-white font-semibold hover:bg-slate-800 transition shadow-sm">
                        Retour
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <section class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="p-5 border-b border-slate-200 flex items-center justify-between gap-3">
                        <div>
                            <h2 class="font-semibold text-lg">Dépenses récentes</h2>
                            <p class="text-sm text-slate-500">Latest expenses in this colocation</p>
                        </div>

                        <div class="flex items-center gap-2">
                            <select class="text-sm border border-slate-200 rounded-xl px-3 py-2 bg-white">
                                <option>Tous les mois</option>
                                <option>Ce mois</option>
                                <option>Mois dernier</option>
                            </select>

                            <a href="{{ route('member.colocations.expense', $colocation->id) }}"
                                class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm">
                                + Nouvelle dépense
                            </a>
                        </div>
                    </div>

                    <div class="p-5">
                        <div
                            class="grid grid-cols-12 text-xs font-semibold text-slate-500 uppercase tracking-wider px-3">
                            <div class="col-span-6">Titre / Catégorie</div>
                            <div class="col-span-3">Payeur</div>
                            <div class="col-span-3 text-right">Montant</div>
                        </div>

                        <div class="mt-3 divide-y divide-slate-100 border border-slate-200 rounded-2xl overflow-hidden">
                            @forelse($expenses as $expense)
                                <div class="grid grid-cols-12 gap-2 px-4 py-4 items-center bg-white">
                                    <div class="col-span-6">
                                        <div class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                                            <span>{{ $expense->title }}</span>
                                            @if ($expense->paid)
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                                    DONE
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                                    NOT DONE YET
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-slate-500">{{ $expense->category?->name ?? 'N/A' }}
                                        </div>
                                    </div>
                                    <div class="col-span-3 text-sm text-slate-700">{{ $expense->user?->name ?? 'N/A' }}
                                    </div>
                                    <div class="col-span-3 text-sm font-semibold text-slate-900 text-right">
                                        {{ number_format((float) $expense->amount, 2) }}
                                    </div>
                                </div>
                            @empty
                                <div class="px-4 py-10 text-center bg-slate-50">
                                    <div class="text-sm font-medium text-slate-700">Aucune dépense pour le moment.
                                    </div>
                                    <div class="text-xs text-slate-500 mt-1">Ajoutez une dépense pour commencer.</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>

                <aside class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="p-5 border-b border-slate-200">
                        <h2 class="font-semibold text-lg">Qui doit à qui ?</h2>
                        <p class="text-sm text-slate-500">Simplified reimbursements</p>
                    </div>

                    <div class="p-5">
                        @php
                            $pendingPayments = $payments->where('is_paid', false);
                        @endphp

                        @if ($pendingPayments->isEmpty())
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 text-center">
                                <div class="text-sm text-slate-600">Aucun remboursement en attente.</div>
                            </div>
                        @else
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm font-semibold text-slate-800">Paiements en attente</div>
                                    <span
                                        class="text-[11px] px-2 py-1 rounded-full bg-amber-100 text-amber-700 border border-amber-200">{{ $pendingPayments->count() }}
                                        PENDING</span>
                                </div>

                                <div class="space-y-2">
                                    @foreach ($pendingPayments as $payment)
                                        @php
                                            $canPay = (int) $payment->receiver_user_id === (int) auth()->id();
                                        @endphp
                                        <div class="rounded-xl border border-slate-200 bg-white p-3">
                                            <div class="flex items-start justify-between gap-3">
                                                <div>
                                                    <div class="text-sm font-semibold text-slate-800">
                                                        {{ $payment->receiver?->name ?? 'User' }} pays
                                                        {{ number_format((float) $payment->amount, 2) }}
                                                    </div>
                                                    <div class="text-xs text-slate-500 mt-0.5">
                                                        For: {{ $payment->expense?->title ?? 'Expense' }}
                                                    </div>
                                                    <div class="text-xs text-slate-500">
                                                        To: {{ $payment->expense?->user?->name ?? 'Unknown' }}
                                                    </div>
                                                </div>

                                                @if ($canPay)
                                                    <form method="POST"
                                                        action="{{ route('member.payments.pay', $payment->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-xs font-semibold hover:bg-emerald-700 transition">
                                                            Pay now
                                                        </button>
                                                    </form>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                                        Waiting
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mt-5 rounded-2xl bg-slate-900 text-white p-5">
                            <div class="flex items-center justify-between mb-4">
                                <div class="font-semibold">Membres de la coloc</div>
                                <span
                                    class="text-[11px] px-2 py-1 rounded-full bg-slate-700 text-slate-200">{{ $memberships->where('is_active', true)->count() }}
                                    ACTIFS</span>
                            </div>

                            <div class="space-y-3">
                                @php
                                    $myMembership = $memberships->firstWhere('user_id', auth()->id());
                                    $isCurrentUserOwner = strtolower($myMembership?->role ?? '') === 'owner';
                                @endphp
                                @foreach ($memberships as $membership)
                                    @php
                                        $isOwner = strtolower($membership->role) === 'owner';
                                        $isMe = (int) $membership->user_id === (int) auth()->id();
                                    @endphp
                                    <div
                                        class="flex items-center justify-between rounded-xl px-3 py-3 border {{ $isOwner ? 'bg-amber-500/10 border-amber-300/50' : 'bg-slate-800/60 border-transparent' }}">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-9 h-9 rounded-xl flex items-center justify-center font-bold {{ $isOwner ? 'bg-amber-400 text-amber-950' : 'bg-slate-700' }}">
                                                {{ strtoupper(substr($membership->user?->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div class="leading-tight">
                                                <div class="font-semibold">{{ $membership->user?->name ?? 'Unknown' }}
                                                </div>
                                                <div
                                                    class="text-xs {{ $isOwner ? 'text-amber-200 font-semibold' : 'text-slate-300' }}">
                                                    {{ strtoupper($membership->role) }}
                                                    @if ($isOwner)
                                                        <span
                                                            class="ml-1 inline-flex items-center px-1.5 py-0.5 rounded bg-amber-300 text-amber-950 text-[10px] font-bold">OWNER</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            @if ($isCurrentUserOwner && !$isMe)
                                                <button type="button"
                                                    class="text-xs px-2.5 py-1 rounded-lg bg-rose-100 text-rose-700 border border-rose-200 font-semibold hover:bg-rose-200 transition">
                                                    Remove
                                                </button>
                                            @endif

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <a href="{{ route('member.colocations.invitation.index', $colocation->id) }}"
                                class="w-full mt-4 inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-100 text-slate-900 font-semibold hover:bg-white transition">
                                + Inviter un membre
                            </a>
                        </div>
                    </div>
                </aside>

            </div>

        </main>
    </div>
</body>

</html>
