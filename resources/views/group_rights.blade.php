<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Group Rights Management
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow">

                <div class="border-b px-6 py-4">
                    <h2 class="text-xl font-semibold">
                        Role Permissions
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Assign permissions to each role.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 p-6">

                    @foreach($roles as $role)

                        <div class="border rounded-lg shadow-sm">

                            <div class="px-5 py-4 border-b bg-gray-50">

                                <h3 class="text-lg font-bold capitalize">
                                    {{ $role->name }}
                                </h3>

                            </div>

                            <form action="{{ route('group_rights.update', $role->name) }}" method="POST">

                                @csrf

                                <div class="p-5 space-y-3">

                                    @foreach($permissions as $permission)

                                        <label class="flex items-center gap-3">

                                            <input
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ $permission->name }}"
                                                class="rounded border-gray-300 text-indigo-600"

                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                            >

                                            <span class="capitalize">
                                                {{ $permission->name }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                                <div class="border-t p-4">

                                    <button
                                        type="submit"
                                        class="w-full rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700 transition">

                                        Save Rights

                                    </button>

                                </div>

                            </form>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</x-app-layout>