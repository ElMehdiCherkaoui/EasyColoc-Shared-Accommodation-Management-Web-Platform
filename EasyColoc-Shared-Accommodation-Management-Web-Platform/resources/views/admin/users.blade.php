<x-app-layout>
    <x-slot name="title">Users</x-slot>
    <x-slot name="header">User Moderation</x-slot>

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
                    placeholder="Search users by name or email...">
            </div>
            <div class="flex gap-2 w-full sm:w-auto">
                <select
                    class="block w-full rounded-lg border-gray-300 bg-gray-50 py-2 pl-3 pr-10 text-sm focus:border-indigo-500 focus:ring-indigo-500 outline-none">
                    <option>All Statuses</option>
                    <option>Active</option>
                    <option>Banned</option>
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
                                User</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Reputation</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Joined</th>
                            <th scope="col"
                                class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($users as $user)
                            @php
                                $name = $user->name ?? ($user->fullname ?? 'User');
                                $parts = preg_split('/\s+/', trim($name));
                                $initials = strtoupper(substr($parts[0] ?? 'U', 0, 1) . substr($parts[1] ?? '', 0, 1));

                                $rep = $user->reputation;
                                $isBanned = $user->is_banned;

                                $rowClass = $isBanned
                                    ? 'hover:bg-gray-50 transition-colors bg-red-50/10'
                                    : 'hover:bg-gray-50 transition-colors';

                                $avatarClass = $isBanned
                                    ? 'bg-gray-200 text-gray-500 border-gray-300'
                                    : 'bg-indigo-100 text-indigo-700 border-indigo-200';

                                $repitationClass =
                                    $rep >= 0
                                        ? 'bg-green-100 text-green-800 border-green-200'
                                        : 'bg-red-100 text-red-800 border-red-200';
                            @endphp

                            <tr class="{{ $rowClass }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 rounded-full flex items-center justify-center font-bold border {{ $avatarClass }}">
                                            {{ $initials }}
                                        </div>
                                        <div>
                                            <div
                                                class="text-sm font-bold text-gray-900 {{ $isBanned ? 'line-through decoration-gray-400' : '' }}">
                                                {{ $name }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border {{ $repitationClass }}">
                                        @if ($rep >= 0)
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            +{{ $rep }}
                                        @else
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $rep }}
                                        @endif
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($isBanned)
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                            <span class="w-1.5 h-1.5 bg-red-600 rounded-full mr-1.5"></span> Banned
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                            Active
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ optional($user->created_at)->format('M d, Y') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if ($isBanned)
                                        <form method="POST" action="{{ route('admin.users.unban', $user->id) }}"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="text-emerald-600 hover:text-emerald-900 font-semibold transition-colors bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg border border-emerald-100">
                                                Unban User
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.users.ban', $user->id) }}"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 font-semibold transition-colors bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg border border-red-100">
                                                Ban User
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-between sm:px-6">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
