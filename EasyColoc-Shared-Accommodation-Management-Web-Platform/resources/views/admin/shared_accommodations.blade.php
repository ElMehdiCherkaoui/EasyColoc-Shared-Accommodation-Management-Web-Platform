<x-app-layout>
    <x-slot name="title">Accommodations</x-slot>
    <x-slot name="header">Manage Shared Homes</x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <div
            class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <div class="relative w-full sm:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text"
                    class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 border py-2 text-sm focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 outline-none transition-all"
                    placeholder="Search homes by name or owner...">
            </div>
            <div class="flex gap-2 w-full sm:w-auto">
                <select
                    class="block w-full rounded-lg border-gray-300 bg-gray-50 py-2 pl-3 pr-10 text-sm focus:border-indigo-500 focus:ring-indigo-500 outline-none">
                    <option>All Statuses</option>
                    <option>Active</option>
                    <option>Cancelled</option>
                </select>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Home Name</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Owner</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Members</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($members as $member)
                            @php
                                $isCancelled = $member->status === 'cancelled' || !is_null($member->cancelled_at);

                                $created = optional($member->created_at)->format('M d, Y');
                                $cancelled = optional($member->cancelled_at)->format('M d, Y');

                                $owner = optional(optional($member->ownerMembership)->user);
                                $ownerName = $owner->name ?? '—';
                                $ownerEmail = $owner->email ?? null;

                                $activeMembers = $member->activeMemberships ?? collect();
                                $count = (int) ($member->active_members_count ?? $activeMembers->count());

                                $rowClass = $isCancelled
                                    ? 'hover:bg-gray-50 transition-colors opacity-75'
                                    : 'hover:bg-gray-50 transition-colors';

                                $iconBoxClass = $isCancelled
                                    ? 'bg-gray-100 text-gray-400 border border-gray-200'
                                    : 'bg-indigo-50 text-indigo-600 border border-indigo-100';

                                $statusPillClass = $isCancelled
                                    ? 'bg-gray-100 text-gray-600 border border-gray-200'
                                    : 'bg-green-50 text-green-700 border border-green-200';

                                $dotClass = $isCancelled ? 'bg-gray-400' : 'bg-green-500';
                                $statusLabel = $isCancelled ? 'Cancelled' : 'Active';

                                $visible = $activeMembers->take(2); // show 2 avatars
                                $extra = max(0, $count - $visible->count());
                            @endphp

                            <tr class="{{ $rowClass }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 rounded-xl flex items-center justify-center {{ $iconBoxClass }}">
                                            @if ($isCancelled)
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                </svg>
                                            @endif
                                        </div>

                                        <div>
                                            <div
                                                class="text-sm font-bold text-gray-900 {{ $isCancelled ? 'line-through decoration-gray-400' : '' }}">
                                                {{ $member->name }}
                                            </div>

                                            @if ($isCancelled)
                                                <div class="text-xs text-red-500">Cancelled {{ $cancelled }}</div>
                                            @else
                                                <div class="text-xs text-gray-500">Created {{ $created }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $ownerName }}</div>
                                    @if ($ownerEmail)
                                        <div class="text-xs text-gray-500">{{ $ownerEmail }}</div>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex -space-x-2 overflow-hidden">
                                        @foreach ($visible as $m)
                                            @php
                                                $n = optional($m->user)->name ?? 'U';
                                                $p = preg_split('/\s+/', trim($n));
                                                $ini = strtoupper(
                                                    substr($p[0] ?? 'U', 0, 1) . substr($p[1] ?? '', 0, 1),
                                                );
                                            @endphp
                                            <div
                                                class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-indigo-100 flex items-center justify-center text-xs font-bold text-indigo-700">
                                                {{ $ini }}
                                            </div>
                                        @endforeach

                                        @if ($extra > 0)
                                            <div
                                                class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500">
                                                +{{ $extra }}
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $statusPillClass }}">
                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $dotClass }}"></span>
                                        {{ $statusLabel }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-gray-400 hover:text-indigo-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                                    No shared accommodations found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
