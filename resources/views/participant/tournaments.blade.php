@extends('layouts.participant.master')
@section('participant.title')
Tournaments
@endsection

@section('participant-main')
<main class="bg-gray-900 min-h-screen py-8 px-4">
    <div class="container mx-auto">
        {{-- <!-- Dashboard Header --> --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">Available Tournaments</h1>
                <p class="text-gray-400 mt-2">Browse and join exciting esports competitions</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-trophy mr-2"></i>
                    My Tournaments
                </a>
            </div>
        </div>

        {{-- <!-- Tournament Filter Section --> --}}
        <div class="bg-gray-800 rounded-xl p-4 mb-8">
            <form action="" method="GET">
                <div class="flex flex-wrap gap-4 items-center">
                    <div class="flex-1 min-w-[200px]">
                        <label for="status-filter" class="block text-sm font-medium text-gray-400 mb-1">Filter by Status</label>
                        <select id="status-filter" name="status" class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                            <option value="all">All Tournaments</option>
                            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Open for Registration</option>
                            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="format-filter" class="block text-sm font-medium text-gray-400 mb-1">Filter by Game</label>
                        <select id="format-filter" name="format" class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                            <option value="all">All Games</option>
                            <option value="CSGO" {{ request('format') == 'CSGO' ? 'selected' : '' }}>CS:GO</option>
                            <option value="DOTA2" {{ request('format') == 'DOTA2' ? 'selected' : '' }}>DOTA 2</option>
                            <option value="LOL" {{ request('format') == 'LOL' ? 'selected' : '' }}>League of Legends</option>
                            <option value="VALORANT" {{ request('format') == 'VALORANT' ? 'selected' : '' }}>Valorant</option>
                        </select>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="search-tournament" class="block text-sm font-medium text-gray-400 mb-1">Search</label>
                        <div class="relative">
                            <input type="text" id="search-tournament" name="search" value="" placeholder="Search tournaments..." class="w-full bg-gray-700 text-white rounded-lg pl-10 pr-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 min-w-[120px] self-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-4 py-2 transition-colors">
                            <i class="fas fa-filter mr-2"></i>Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach ($tournaments as $tournament)
            {{-- <!-- Tournament Card --> --}}
            <div class="bg-gray-800 rounded-xl overflow-hidden transition-transform duration-300 hover:scale-[1.02] hover:shadow-lg">
                <div class="relative">
                    <img src="{{ $tournament->getPhotoUrl() }}" alt="{{$tournament->format}}" class="w-full h-48 object-cover">
                    <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-900 text-blue-300">
                                <span class="w-2 h-2 rounded-full bg-blue-400 mr-1"></span>
                                Registration Open
                            </span>
                    </div>
                    
                    @if($tournament->status == 'upcoming' && $tournament->current_participants < $tournament->max_participants)
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-900 text-green-300">
                                <i class="fas fa-user-plus mr-1"></i>
                                Spots Available
                            </span>
                        </div>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-white mb-2">{{$tournament->name}}</h3>
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-gray-400">
                            <i class="fas fa-gamepad w-5 text-center mr-2"></i>
                            <span>{{$tournament->format}}</span>
                        </div>
                        <div class="flex items-center text-gray-400">
                            <i class="far fa-calendar-alt w-5 text-center mr-2"></i>
                            <span>Starts {{$tournament->start_date}}</span>
                        </div>
                        <div class="flex items-center text-gray-400">
                            <i class="fas fa-users w-5 text-center mr-2"></i>
                            <span>{{$tournament->max_participants}}/{{$tournament->particpated_teams}} Participants</span>
                        </div>

                    </div>
                    
                    <div class="flex flex-col space-y-2">
                           
                        <a href=" {{ route('participant.tournament.details', ['tournament' => $tournament->id]) }}" class="inline-flex items-center justify-center w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                            <i class="fas fa-eye mr-2"></i>
                            View Details
                        </a>
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        {{-- <!-- Pagination --> --}}
        {!! $tournaments->links() !!}
</main>

{{-- <!-- CSS for status indicators and animations --> --}}
<style>
    /* Animation for status indicators */
    .animate-pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
    
    /* Hover effects */
    .bg-gray-800.rounded-xl {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }
    
    .bg-gray-800.rounded-xl:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }
</style>
@endsection