@extends('layouts.admin.master')

@section('admin-title')
    Statistics
@endsection

@section('main')
    <main class="flex-1 p-6 bg-gray-900 text-gray-100">
        <h1 class="text-3xl font-bold mb-4 text-green-400">Welcome to the Admin Dashboard</h1>
        <p class="mb-4 text-green-300">Select an option from the sidebar to manage the application.</p>
        <h2 class="text-2xl font-bold mt-5 text-green-400">Statistics</h2>
        <div class="bg-gray-800 rounded-lg shadow-lg mt-4 p-6 border border-gray-700">
            <div class="grid grid-cols-2 gap-4">
                @foreach ($statistics as $stat)
                    <div class="flex items-center p-4 bg-white text-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow border border-gray-200">
                        <div class="flex items-center justify-center w-12 h-12 bg-green-500 rounded-full text-white">
                            <i class="fas fa-{{ $stat['icon'] }} text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">{{ $stat['label'] }}</h3>
                            <p class="text-xl font-bold text-gray-800">{{ $stat['value'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection