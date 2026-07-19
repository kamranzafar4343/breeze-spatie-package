<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add New Task
            </h2>

            <a href="{{ route('dashboard') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">
                    <strong>Please fix the following errors:</strong>

                    <ul class="list-disc ml-5 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow rounded-lg">

                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">
                        Create Task
                    </h3>
                </div>

                <div class="p-6">

                    <form action="{{ route('store') }}" method="POST">
                        @csrf

                        <div class="mb-5">
                            <label class="block font-medium mb-2">
                                Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                                placeholder="Enter task title">
                        </div>

                        <div class="mb-5">
                            <label class="block font-medium mb-2">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                                placeholder="Enter task description">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block font-medium mb-2">
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full border rounded px-3 py-2">

                                <option value="">Select Status</option>

                                <option value="Pending"
                                    {{ old('status') == 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="Completed"
                                    {{ old('status') == 'Completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                            </select>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('dashboard') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                                Cancel
                            </a>

                            <button
                                type="submit"
                                 class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-black shadow hover:bg-indigo-700">
                                Save Task
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>