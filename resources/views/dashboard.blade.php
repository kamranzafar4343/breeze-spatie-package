<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Task Manager Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Messages --}}
            @if(session('add-success'))
                <div class="mb-4 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-700">
                    {{ session('add-success') }}
                </div>
            @endif

            @if(session('edit-success'))
                <div class="mb-4 rounded-lg border border-blue-300 bg-blue-100 px-4 py-3 text-blue-700">
                    {{ session('edit-success') }}
                </div>
            @endif

            @if(session('delete-success'))
                <div class="mb-4 rounded-lg border border-red-300 bg-red-100 px-4 py-3 text-red-700">
                    {{ session('delete-success') }}
                </div>
            @endif

            @php
                $role = auth()->user()->getRoleNames()->first();
            @endphp

            {{-- User Info --}}
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="p-6 flex justify-between items-center">

                    <div>
                        <h3 class="text-xl font-semibold">
                            Welcome, {{ auth()->user()->name }}
                        </h3>

                        <p class="text-gray-600 mt-1">
                            Role:
                            @if($role)
                                <span class="font-semibold text-green-600">
                                    {{ ucfirst($role) }}
                                </span>
                            @else
                                <span class="font-semibold text-red-600">
                                    No Role Assigned
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="text-right">
                        <p class="text-gray-500 text-sm">
                            Total Tasks
                        </p>

                        <p class="text-3xl font-bold text-blue-600">
                            {{ $tasks->count() }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Tasks Table --}}
            <div class="bg-white rounded-lg shadow">

                <div class="flex justify-between items-center px-6 py-4 border-b">

                    <h3 class="text-xl font-semibold">
                        All Tasks
                    </h3>

                    @can('create tasks')
                         <a href="{{ route('add') }}"
                        class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-black shadow hover:bg-indigo-700">
                        + Add Task
                    </a>
                    @endcan
                   

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-6 py-3 text-left">#</th>

                                <th class="px-6 py-3 text-left">
                                    Title
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Description
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Created
                                </th>

                                @can('update task status')
                                    <th class="px-6 py-3 text-left">
                                    Status
                                </th>
                                @endcan
                                

                                <th class="px-6 py-3 text-center">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">

                        @forelse($tasks as $task)

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-semibold">
                                    {{ $task->title }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $task->description }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $task->created_at->format('d M Y') }}
                                </td>

                                @can('update task status')
                                    <td class="px-6 py-4">

                                    <form action="{{ route('status.update', base64_encode($task->id)) }}" method="POST">
                                        @csrf

                                        <select
                                            name="status"
                                            onchange="this.form.submit()"
                                            class="rounded border-gray-300 shadow-sm">

                                            <option value="Pending"
                                                {{ $task->status == 'Pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="Completed"
                                                {{ $task->status == 'Completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>

                                        </select>

                                    </form>

                                </td>
                                @endcan
                                

                                <td class="px-6 py-4 text-center space-x-2">

                                    @can('edit tasks')
                                   <a href="{{ route('edit', base64_encode($task->id)) }}"
                                        class="inline-flex items-center rounded-md bg-yellow-500 px-3 py-2 text-sm font-medium text-black shadow hover:bg-yellow-600">
                                        Edit
                                    </a>                                        
                                    @endcan


                                    @can('delete tasks')
                                    <a href="{{ route('delete', base64_encode($task->id)) }}"
                                        onclick="return confirm('Delete this task?')"
                                        class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">
                                        Delete
                                    </a>
                                    @endcan

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-8 text-gray-500">
                                    No Tasks Found
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>