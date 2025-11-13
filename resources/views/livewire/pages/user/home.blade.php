<div class="min-h-screen bg-gray-50">
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid gap-6 lg:grid-cols-3">

            <section class="bg-white rounded-xl shadow-sm p-6 lg:col-span-1">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Upload New Data</h2>
                <form wire:submit.prevent="submit" class="space-y-5">

                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700 mb-1" for="data_name">
                            Data Name
                        </label>
                        <input
                            id="data_name"
                            type="text"
                            wire:model="data_name"
                            placeholder="e.g. Profile Picture"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                   focus:border-blue-500 focus:ring focus:ring-blue-200 transition" />
                        @error('data_name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700 mb-1">
                            File
                        </label>
                        <input
                            type="file"
                            wire:model="file"
                            class="w-full text-sm text-gray-700" />
                        @error('file')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-400 mt-1">
                            Accepted: images or documents.
                        </p>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700 mb-1" for="data_type">
                            Data Type
                        </label>
                        <select
                            id="data_type"
                            wire:model="data_type"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                   bg-white focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            <option value="">Select Data Type</option>
                            <option value="image">Image</option>
                            <option value="document">Document</option>
                        </select>

                        @error('data_type')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold
                               hover:bg-blue-700 active:bg-blue-800 transition">
                        Submit
                    </button>
                </form>
            </section>

            <section class="bg-white rounded-xl shadow-sm p-6 lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Your Uploaded Data</h2>
                    </div>
                </div>

                @if ($mydata->isEmpty())
                <div class="py-10 text-center text-gray-500 text-sm">
                    No data uploaded yet. Start by adding something on the left.
                </div>
                @else
                <div class="overflow-x-auto -mx-4 sm:mx-0">
                    <table class="min-w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200">
                                <th class="px-4 py-2 text-left font-medium text-gray-700">ID</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Name</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Type</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Status</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Preview</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700 whitespace-nowrap">Uploaded At</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($mydata as $item)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-4 py-2 align-top">{{ $item->data_id }}</td>
                                <td class="px-4 py-2 align-top text-gray-800">
                                    {{ $item->data_name }}
                                </td>
                                <td class="px-4 py-2 align-top capitalize text-gray-700">
                                    {{ $item->type }}
                                </td>
                                <td class="px-4 py-2 align-top">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                                {{ $item->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 align-top">
                                    @if ($item->type === 'image')
                                    <img
                                        src="{{ Storage::url($item->data_url) }}"
                                        class="w-20 h-20 rounded-md object-cover border border-gray-200">
                                    @elseif ($item->type === 'document')
                                    <a
                                        href="{{ Storage::url($item->data_url) }}"
                                        target="_blank"
                                        class="inline-flex items-center text-blue-600 hover:underline">
                                        <span class="mr-1">📄</span> Open Document
                                    </a>
                                    @endif
                                </td>
                                <td class="px-4 py-2 align-top text-gray-600 text-xs whitespace-nowrap">
                                    {{ $item->created_at }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </section>

        </div>
    </main>
</div>