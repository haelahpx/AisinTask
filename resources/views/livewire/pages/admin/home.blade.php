<div class="min-h-screen bg-gray-50">
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Admin – Manage Data</h1>
            </div>
        </div>

        @if (session()->has('message'))
        <div class="mb-4 rounded-lg bg-green-100 px-4 py-2 text-sm text-green-800">
            {{ session('message') }}
        </div>
        @endif

        <section class="bg-white rounded-xl shadow-sm p-6 mb-12">
            <form wire:submit.prevent="create" class="mb-6 grid gap-4 md:grid-cols-4">
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input
                        type="text"
                        wire:model="new_data_name"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" />
                    @error('new_data_name')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select
                        wire:model="new_type"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                        <option value="">Select Type</option>
                        <option value="image">Image</option>
                        <option value="document">Document</option>
                    </select>
                    @error('new_type')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select
                        wire:model="new_status"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="declined">Declined</option>
                    </select>
                    @error('new_status')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-1">File</label>
                    <input
                        type="file"
                        wire:model="new_file"
                        class="w-full text-sm text-gray-700" />
                    @error('new_file')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mt-3 flex justify-end">
                        <button
                            type="submit"
                            class="px-4 py-2 rounded-lg text-sm font-semibold text-white bg-green-600 hover:bg-green-700 transition">
                            Create
                        </button>
                    </div>
                </div>
            </form>

        </section>

        <section class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">All Records</h2>

                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-600">Filter status:</span>
                    <select
                        wire:model.live="statusFilter"
                        class="rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                        <option value="">All</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="declined">Declined</option>
                    </select>
                </div>
            </div>

            
            @if($records->isEmpty())
            <div class="py-10 text-center text-gray-500 text-sm">
                No data found.
            </div>
            @else
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <table class="min-w-full text-sm border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="px-4 py-2 text-left font-medium text-gray-700">ID</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700 whitespace-nowrap">User ID</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Name</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Type</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">File</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700 whitespace-nowrap">Created At</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($records as $row)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-2 align-top text-gray-800">
                                {{ $row->data_id }}
                            </td>
                            <td class="px-4 py-2 align-top text-gray-700">
                                {{ $row->user_id }}
                            </td>
                            <td class="px-4 py-2 align-top text-gray-800">
                                {{ $row->data_name }}
                            </td>
                            <td class="px-4 py-2 align-top capitalize text-gray-700">
                                {{ $row->type }}
                            </td>
                            <td class="px-4 py-2 align-top">
                                @php
                                    $statusClasses = match($row->status) {
                                        'approved' => 'bg-green-100 text-green-700',
                                        'declined' => 'bg-red-100 text-red-700',
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $statusClasses }}">
                                    {{ $row->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 align-top">
                                @if ($row->type === 'image')
                                <img
                                    src="{{ Storage::url($row->data_url) }}"
                                    class="w-16 h-16 rounded-md object-cover border border-gray-200">
                                @else
                                <a
                                    href="{{ Storage::url($row->data_url) }}"
                                    target="_blank"
                                    class="inline-flex items-center text-blue-600 hover:underline text-sm">
                                    @svg('heroicon-o-document-text', 'w-4 h-4 mr-1')
                                    <span>Open</span>
                                </a>
                                @endif
                            </td>
                            <td class="px-4 py-2 align-top text-gray-600 text-xs whitespace-nowrap">
                                {{ $row->created_at }}
                            </td>
                            <td class="px-4 py-2 align-top">
                                <div class="flex flex-wrap gap-2">
                                    <button
                                        type="button"
                                        title="Approve"
                                        wire:click="setStatus({{ $row->data_id }}, 'approved')"
                                        class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium bg-green-50 text-green-700 border border-green-200 hover:bg-green-100 transition">
                                        @svg('heroicon-o-check-circle', 'w-4 h-4 mr-1')
                                        <span class="hidden sm:inline">Approve</span>
                                    </button>

                                    <button
                                        type="button"
                                        title="Decline"
                                        wire:click="setStatus({{ $row->data_id }}, 'declined')"
                                        class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium bg-red-50 text-red-700 border border-red-200 hover:bg-red-100 transition">
                                        @svg('heroicon-o-x-circle', 'w-4 h-4 mr-1')
                                        <span class="hidden sm:inline">Decline</span>
                                    </button>

                                    <button
                                        type="button"
                                        title="Edit"
                                        wire:click="edit({{ $row->data_id }})"
                                        class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition">
                                        @svg('heroicon-o-pencil-square', 'w-4 h-4 mr-1')
                                        <span class="hidden sm:inline">Edit</span>
                                    </button>

                                    <button
                                        type="button"
                                        title="Delete"
                                        wire:click="delete({{ $row->data_id }})"
                                        onclick="if(!confirm('Delete this record?')) { event.stopImmediatePropagation(); }"
                                        class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200 hover:bg-gray-200 transition">
                                        @svg('heroicon-o-trash', 'w-4 h-4 mr-1')
                                        <span class="hidden sm:inline">Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </section>

        @if($showEditModal && $edit_id)
        <div class="fixed inset-0 z-40 flex items-center justify-center">
            <div class="absolute inset-0 bg-gray-900/50"></div>

            <div class="relative z-50 w-full max-w-md mx-4">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                        <h2 class="text-base font-semibold text-gray-800">
                            Edit Record #{{ $edit_id }}
                        </h2>
                        <button
                            type="button"
                            wire:click="cancelEdit"
                            class="text-gray-400 hover:text-gray-600 text-xl leading-none">
                            &times;
                        </button>
                    </div>

                    <form wire:submit.prevent="update" class="p-4 space-y-4">
                        <div class="flex flex-col">
                            <label class="text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input
                                type="text"
                                wire:model="edit_data_name"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" />
                            @error('edit_data_name')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label class="text-sm font-medium text-gray-700 mb-1">Type</label>
                            <select
                                wire:model="edit_type"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                <option value="">Select Type</option>
                                <option value="image">Image</option>
                                <option value="document">Document</option>
                            </select>
                            @error('edit_type')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label class="text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select
                                wire:model="edit_status"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                <option value="">Select Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="declined">Declined</option>
                            </select>
                            @error('edit_status')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <button
                                type="button"
                                wire:click="cancelEdit"
                                class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition">
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </main>
</div>
