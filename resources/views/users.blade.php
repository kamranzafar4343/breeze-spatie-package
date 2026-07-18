<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            User Role Management
        </h2>
    </x-slot>
 
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Messages --}}
            @if(session('success'))
                <div class="mb-4 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-700">
                    {{ session('success') }}
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
                         {{ auth()->user()->name }}
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
                        {{-- define admin, manager, user rights --}}
                        <a href="{{ route('user_rights')}}"
                                        
                                        class="inline-block bg-grey-600 hover:bg-grey-700 text-white px-3 py-2 rounded">
                                        user rights
                                    </a>
                    </div>

                

                </div>
            </div>

            {{-- Tasks Table --}}
            <div class="bg-white rounded-lg shadow">

                <div class="flex justify-between items-center px-6 py-4 border-b">

                    <h3 class="text-xl font-semibold">
                        All Users
                    </h3>

                    

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-6 py-3 text-left">#</th>

                                <th class="px-6 py-3 text-left">
                                    User Name
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Email
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Role
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Created at
                                </th>


                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">

                        @forelse($users as $user)

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-semibold">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    {{ $user->email }}
                                </td>
                                
                                <td class="px-6 py-4 font-semibold">
                                    

                                    <form action="{{ route('update.role', $user->id) }}" method="POST">
                                        @csrf

                                        <select name="role"
                                        onchange="this.form.submit()"
                                        >
                                            @foreach($roles as $role)
                                                <option
                                                    value="{{ $role->name }}"
                                                    {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>

                                </td>

                                <td class="px-6 py-4">
                                            {{ $user->created_at->format('d M Y') }}
                                        </td>

                               

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-8 text-gray-500">
                                    No Users Found
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