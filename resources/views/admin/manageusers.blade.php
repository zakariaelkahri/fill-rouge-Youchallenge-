@extends('layouts.admin.master')
@section('admin-title')
    manage-users
@endsection
@section('main') 
<div class="flex h-screen bg-gray-900">

<!-- Main content for Manage Users page - to be placed in the main section of your layout -->
<div class="bg-gray-800 p-6 rounded-lg shadow-md">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <h1 class="text-3xl font-bold text-white mb-4 md:mb-0">Manage Users</h1>
        <div class="flex flex-wrap gap-4">
            <div class="relative">
                <input type="text" placeholder="Search users..." class="pl-10 pr-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <select class="bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="all">All Users</option>
                <option value="active">Active Users</option>
                <option value="inactive">Inactive Users</option>
                <option value="banned">Banned Users</option>
            </select>
        </div>
    </div>

    <!-- Status indicators -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-gray-700 p-4 rounded-lg border border-gray-600">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-300">Total Users</p>
                    <p class="text-2xl font-bold text-white">150</p>
                </div>
                <div class="bg-indigo-600 p-3 rounded-full">
                    <i class="fas fa-users text-xl text-white"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-700 p-4 rounded-lg border border-gray-600">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-300">Active Users</p>
                    <p class="text-2xl font-bold text-white">124</p>
                </div>
                <div class="bg-green-600 p-3 rounded-full">
                    <i class="fas fa-user-check text-xl text-white"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-700 p-4 rounded-lg border border-gray-600">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-300">Inactive Users</p>
                    <p class="text-2xl font-bold text-white">18</p>
                </div>
                <div class="bg-yellow-600 p-3 rounded-full">
                    <i class="fas fa-user-clock text-xl text-white"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-700 p-4 rounded-lg border border-gray-600">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-300">Banned Users</p>
                    <p class="text-2xl font-bold text-white">8</p>
                </div>
                <div class="bg-red-600 p-3 rounded-full">
                    <i class="fas fa-user-slash text-xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto bg-gray-800 rounded-lg border border-gray-700">
        <table class="w-full">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Profile</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Registered On</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach ($users as $user)
                <tr class="hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                            <img 
                                src="{{ $user->getPhotoUrl() }}" 
                                alt="{{ $user->name }}" 
                                class="w-full h-full object-cover"
                            >
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-white">{{$user->name}}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{$user->email}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        @foreach ($user->roles as $role)
                            {{$role->name}}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($user && strtolower($user->status) == 'active')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-900 text-green-300">
                                {{$user->status}}
                            </span>
                        @elseif ($user && strtolower($user->status) == 'inactive')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-900 text-yellow-300">
                                {{$user->status}}
                            </span>
                        @elseif ($user && strtolower($user->status) == 'banned')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-900 text-red-300">
                                {{$user->status}}
                            </span>
                        @elseif ($user)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-900 text-indigo-300">
                                {{$user->organisator->status}}
                            </span>
                        @endif 
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{$user->created_at}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <form action="{{ route('admin.managestatus', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                            
                                <select class="bg-gray-700 border border-gray-600 text-white rounded text-sm px-2 py-1" name="status">
                                    <option value="" selected disabled>change status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-2 py-1 rounded text-xs transition-colors duration-200">Save</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {!! $users->links() !!}
    </div>
</div>
</div>
@endsection