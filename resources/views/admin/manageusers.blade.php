@extends('layouts.master')
@section('title')
    manage-users
@endsection
@section('main') 
<div class="flex h-screen bg-gray-100">

<!-- Main content for Manage Users page - to be placed in the main section of your layout -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Manage Users</h1>
        <div class="flex space-x-2">
            <div class="relative">
                <input type="text" placeholder="Search users..." class="pl-10 pr-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <i class="fas fa-search absolute left-3 top-3 text-green-500"></i>
            </div>
            <select class="border border-green-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="all">All Users</option>
                <option value="active">Active Users</option>
                <option value="inactive">Inactive Users</option>
                <option value="banned">Banned Users</option>
            </select>
        </div>
    </div>

    <!-- Status indicators -->
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-green-600">Total Users</p>
                    <p class="text-2xl font-bold text-green-800">150</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-users text-xl text-green-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-green-600">Active Users</p>
                    <p class="text-2xl font-bold text-green-800">124</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-user-check text-xl text-green-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-green-600">Inactive Users</p>
                    <p class="text-2xl font-bold text-green-800">18</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-user-clock text-xl text-green-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-green-600">Banned Users</p>
                    <p class="text-2xl font-bold text-green-800">8</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-user-slash text-xl text-green-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto bg-white rounded-lg border border-green-200">
        <table class="w-full">
            <thead class="bg-green-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Profile</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Registered On</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-green-100">
                @foreach ($users as $user)
                <tr class="hover:bg-green-50">
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
                        <div class="ml-4">
                            <div class="text-sm font-medium text-green-900">{{$user->name}}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-800">{{$user->email}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-800">
                        @foreach ($user->roles as $role)
                            {{$role->name}}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        @if ($user->participant)
                            {{$user->participant->status}}
                        @elseif ($user->organisator)
                            {{$user->organisator->status}}
                        @endif 
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-800">{{$user->created_at}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <form action="{{ route('admin.managestatus', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                            
                                <select class="border border-green-300 rounded text-sm px-2 py-1" name="status">
                                    <option value="" selected disabled>change status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            
                                <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded text-xs">Save</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {!! $users->links() !!}
    </div>
</div>
</div>
@endsection