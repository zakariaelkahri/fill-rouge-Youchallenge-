@extends('layouts.admin.master')
@section('admin-title')
    manage-users
@endsection
@section('main') 
<div class="flex h-screen bg-gray-900">
    <div class="bg-gray-800 p-6 rounded-lg shadow-md w-full">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Manage Users</h1>
            <div class="flex flex-wrap gap-4 mt-4 md:mt-0">
                <div class="relative">
                    <input type="text" placeholder="Search users..." 
                           class="pl-10 pr-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
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


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <div class="bg-gray-700 p-4 rounded-lg border border-gray-600 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-300">Total Users</p>
                    <p class="text-2xl font-bold text-white">150</p>
                </div>
                <div class="bg-indigo-600 p-3 rounded-full">
                    <i class="fas fa-users text-xl text-white"></i>
                </div>
            </div>

        </div>


        <div class="overflow-x-auto rounded-lg border border-gray-700">
            <table class="w-full text-left text-sm bg-gray-900 text-gray-300">
                <thead class="bg-gray-700 text-gray-300">
                    <tr>
                        <th class="px-6 py-3">Profile</th>
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Registered On</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4">
                            <div class="h-10 w-10 rounded-full overflow-hidden">
                                <img src="{{ $user->getPhotoUrl() }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-white font-medium">{{$user->name}}</span>
                        </td>
                        <td class="px-6 py-4">{{$user->email}}</td>
                        <td class="px-6 py-4">
                            @foreach ($user->roles as $role)
                                <span>{{$role->name}}</span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs leading-5 font-semibold rounded-full 
                                   {{ strtolower($user->status) == 'active' ? 'bg-green-900 text-green-300' : '' }}
                                   {{ strtolower($user->status) == 'inactive' ? 'bg-yellow-900 text-yellow-300' : '' }}
                                   {{ strtolower($user->status) == 'banned' ? 'bg-red-900 text-red-300' : '' }}">
                                {{$user->status}}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{$user->created_at}}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.managestatus', ['user' => $user]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="flex space-x-2">
                                    <select class="bg-gray-700 border border-gray-600 text-white rounded text-sm px-2 py-1" name="status">
                                        <option value="" disabled>Change Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded-lg hover:bg-indigo-700">Save</button>
                                </div>
                            </form>
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