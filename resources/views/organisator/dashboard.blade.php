@extends('layouts.organisator.master')

@section('organisator.title')
    My Tournament Dashboard
@endsection

@section('organisator-main')

<main class="bg-gray-900 min-h-screen py-8 px-4">
    <div class="container mx-auto">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">My Tournament Dashboard</h1>
                <p class="text-gray-400 mt-2">Welcome back, [Organizer Name]</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="#" class="btn-primary flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Create New Tournament
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
            <!-- Total Tournaments Card -->
            <div class="card border-l-4 border-green-500">
                <div class="card-body">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Tournaments</p>
                            <h3 class="text-2xl font-bold text-white mt-1">12</h3>
                        </div>
                        <div class="bg-green-900/50 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                            <i class="fas fa-trophy text-green-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Tournaments Card -->
            <div class="card border-l-4 border-blue-500">
                <div class="card-body">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Active Tournaments</p>
                            <h3 class="text-2xl font-bold text-white mt-1">4</h3>
                        </div>
                        <div class="bg-blue-900/50 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-blue-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Participants Card -->
            <div class="card border-l-4 border-purple-500">
                <div class="card-body">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Participants</p>
                            <h3 class="text-2xl font-bold text-white mt-1">384</h3>
                        </div>
                        <div class="bg-purple-900/50 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                            <i class="fas fa-users text-purple-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Dashboard Content Section Example -->
        <div class="card mb-8">
            <div class="card-header flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Active Tournaments</h3>
                <a href="#" class="text-green-400 hover:text-green-300 text-sm">View All</a>
            </div>
            <div class="card-body">
                <div class="bg-gray-700/50 p-4 rounded-lg">
                    <p class="text-gray-300">Example content area</p>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
