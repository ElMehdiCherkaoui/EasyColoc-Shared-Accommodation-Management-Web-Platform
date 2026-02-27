<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation - EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <main class="max-w-3xl mx-auto px-4 py-10">
        @if (session('error'))
            <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <section class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="bg-slate-900 text-white px-6 py-5">
                <div class="text-xs uppercase tracking-wider text-slate-300">EasyColoc invitation</div>
                <h1 class="mt-1 text-2xl font-bold tracking-tight">You're invited to join a colocation</h1>
            </div>

            <div class="p-6 space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <div class="text-xs uppercase tracking-wider text-slate-500">Colocation</div>
                    <div class="mt-1 text-xl font-semibold text-slate-900">
                        {{ $invitation->sharedAccommodation->name  }}
                    </div>
                    <div class="mt-3 text-sm text-slate-600">Invited email: <span class="font-medium">{{ $invitation->email }}</span></div>
                </div>

                <div>
                    <div class="text-sm text-slate-600 mb-2">Current status</div>
                    <span
                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold border {{ $invitation->status === 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : ($invitation->status === 'accepted' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-slate-700 border-slate-200') }}">
                        {{ strtoupper($invitation->status) }}
                    </span>
                </div>

                @if ($invitation->status === 'pending')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <form method="POST" action="{{ route('invitations.accept', $invitation->token) }}">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                                Accept Invitation
                            </button>
                        </form>

                        <form method="POST" action="{{ route('invitations.decline', $invitation->token) }}">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-3 rounded-xl bg-rose-600 text-white font-semibold hover:bg-rose-700 transition">
                                Decline Invitation
                            </button>
                        </form>
                    </div>
                @else
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                        This invitation was already processed and cannot be changed.
                    </div>
                @endif
            </div>
        </section>
    </main>
</body>

</html>
