@extends('layouts.dashboard')

@section('content')
@if($user['type'] == 1)
<div class="w-full">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold">User Management</h1>
        <a href="/create-user" class="bg-primary-600 text-white px-4 py-2 rounded hover:bg-primary-700 whitespace-nowrap">
            <i class="fas fa-user-plus mr-2"></i>Create User
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Email</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $u)
                <tr>
                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">{{ $u->id }}</td>
                    <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <div class="flex flex-col">
                            <span>{{ $u->name }}</span>
                            <span class="text-xs text-gray-500 sm:hidden">{{ $u->email }}</span>
                        </div>
                    </td>
                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">{{ $u->email }}</td>
                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if ($u->user_type == 1)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Admin</span>
                        @elseif ($u->user_type == 2)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Moderator</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">User</span>
                        @endif
                    </td>
                    <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($u->id != $user['id'])
                                <form method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No users found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 px-2">
        {{ $users->links() }}
    </div>
</div>
@else
<div class="text-center py-20">
    <h2 class="text-xl text-gray-600">You do not have access to this section.</h2>
</div>
@endif
@endsection