@extends('layouts.participant.master')
@section('participant.title')
My Tournaments
@endsection

@section('participant-main')
<main class="bg-gray-900 min-h-screen py-8 px-4">
    <div class="container mx-auto">
        {{-- <!-- Dashboard Header --> --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div class="relative">
                <h1 class="text-3xl font-bold text-white inline-flex items-center">
                    My Tournaments
                    <span class="ml-3 bg-blue-600 text-xs font-medium text-white px-2.5 py-1 rounded-full">{{ count($tournaments) }}</span>
                </h1>
                <p class="text-gray-400 mt-2">Manage your active tournament participation</p>
                <div class="absolute -bottom-4 left-0 w-20 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></div>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{route('participant.tournaments')}}" class="inline-flex items-center justify-center px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-indigo-500/30">
                    <i class="fas fa-trophy mr-2"></i>
                    Browse Tournaments
                </a>
            </div>
        </div>

        {{-- <!-- Tournament Filter Section --> --}}
        <div class="bg-gray-800 rounded-xl p-6 mb-8 shadow-lg border border-gray-700 backdrop-blur">
            <form action="" method="GET">
                <div class="flex flex-wrap gap-4 items-center">
                    <div class="flex-1 min-w-[200px]">
                        <label for="status-filter" class="block text-sm font-medium text-gray-300 mb-1">Tournament Status</label>
                        <div class="relative">
                            <select id="status-filter" name="status" class="w-full bg-gray-700 text-white rounded-lg pl-4 pr-10 py-3 border border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 appearance-none">
                                <option value="all">All My Tournaments</option>
                                <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="format-filter" class="block text-sm font-medium text-gray-300 mb-1">Game Title</label>
                        <div class="relative">
                            <select id="format-filter" name="format" class="w-full bg-gray-700 text-white rounded-lg pl-4 pr-10 py-3 border border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 appearance-none">
                                <option value="all">All Games</option>
                                <option value="CSGO" {{ request('format') == 'CSGO' ? 'selected' : '' }}>CS:GO</option>
                                <option value="DOTA2" {{ request('format') == 'DOTA2' ? 'selected' : '' }}>DOTA 2</option>
                                <option value="FC25" {{ request('format') == 'LOL' ? 'selected' : '' }}>FC 25</option>
                                <option value="VALORANT" {{ request('format') == 'VALORANT' ? 'selected' : '' }}>Valorant</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="search-tournament" class="block text-sm font-medium text-gray-300 mb-1">Search</label>
                        <div class="relative">
                            <input type="text" id="search-tournament" name="search" value="{{ request('search') }}" placeholder="Search your tournaments..." class="w-full bg-gray-700 text-white rounded-lg pl-10 pr-4 py-3 border border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 min-w-[120px] self-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-4 py-3 transition-colors duration-300 flex items-center justify-center">
                            <i class="fas fa-filter mr-2"></i>Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if(!$tournaments)
            <div class="bg-gray-800 rounded-xl p-8 text-center">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <div class="w-24 h-24 rounded-full bg-gray-700 flex items-center justify-center">
                        <i class="fas fa-trophy text-4xl text-gray-500"></i>
                    </div>
                    <h3 class="text-xl font-medium text-white">No tournaments joined yet</h3>
                    <p class="text-gray-400 max-w-md mx-auto">You haven't registered for any tournaments. Browse available tournaments to join exciting esports competitions!</p>
                    <a href="" class="mt-4 inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-search mr-2"></i>
                        Browse Tournaments
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach ($tournaments as $tournament)
                {{-- <!-- Tournament Card --> --}}
                <div class="bg-gray-800 rounded-xl overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-lg border border-gray-700/50 tournament-card">
                    <div class="relative">
                        <img src="{{ $tournament->getPhotoUrl() }}" alt="{{$tournament->format}}" class="w-full h-48 object-cover">
                        
                        {{-- Status Badge --}}
                        @if($tournament->status == 'upcoming')
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-900 text-indigo-200 shadow-lg animate-pulse-slow">
                                    <span class="w-2 h-2 rounded-full bg-indigo-300 mr-1"></span>
                                    Upcoming
                                </span>
                            </div>
                        @elseif($tournament->status == 'ongoing')
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-900 text-green-200 shadow-lg animate-pulse-slow">
                                    <span class="w-2 h-2 rounded-full bg-green-300 mr-1"></span>
                                    Live Now
                                </span>
                            </div>
                        @elseif($tournament->status == 'completed')
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-700 text-gray-300 shadow-lg">
                                    <i class="fas fa-flag-checkered mr-1 text-xs"></i>
                                    Completed
                                </span>
                            </div>
                        @endif
                        
                        {{-- Game Format Badge --}}
                        <div class="absolute bottom-3 left-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-black/70 backdrop-blur-sm text-white border border-gray-700">
                                <i class="fas fa-gamepad mr-1"></i>
                                {{$tournament->format}}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-white mb-2 line-clamp-1">{{$tournament->name}}</h3>
                        
                        <div class="space-y-3 mb-4">
                            {{-- Your team name --}}
                            <div class="flex items-center text-gray-300">
                                <i class="fas fa-users w-5 text-center mr-2 text-blue-400"></i>
                                <span>Team: <span class="font-medium">{{$tournament->getTeamName()?->name}}</span></span>
                            </div>
                            
                            {{-- Tournament time/date --}}
                            <div class="flex items-center text-gray-300">
                                <i class="far fa-calendar-alt w-5 text-center mr-2 text-blue-400"></i>
                                @if($tournament->status == 'upcoming')
                                    <span>Starts {{ \Carbon\Carbon::parse($tournament->start_date)->format('M d, Y') }}</span>
                                @elseif($tournament->status == 'ongoing')
                                    <span>Started {{ \Carbon\Carbon::parse($tournament->start_date)->format('M d') }}</span>
                                @else
                                    <span>Ended {{ \Carbon\Carbon::parse($tournament->end_date)->format('M d, Y') }}</span>
                                @endif
                            </div>
                            
                            {{-- Match information --}}
                            @if($tournament->status == 'upcoming')
                                <div class="flex items-center text-gray-300">
                                    <i class="fas fa-hourglass-start w-5 text-center mr-2 text-blue-400"></i>
                                    <span>First match in {{ \Carbon\Carbon::parse($tournament->start_date)->diffForHumans() }}</span>
                                </div>
                            @elseif($tournament->status == 'ongoing')
                                <div class="flex items-center text-gray-300">
                                    <i class="fas fa-gamepad w-5 text-center mr-2 text-blue-400"></i>
                                    <span>Next match: {{ \Carbon\Carbon::parse($tournament->next_match_date)->format('M d, H:i') }}</span>
                                </div>
                            @else
                                <div class="flex items-center text-gray-300">
                                    <i class="fas fa-medal w-5 text-center mr-2 text-blue-400"></i>
                                    <span>Rank: <span class="font-medium">{{$tournament->participant_rank ?? 'N/A'}}</span></span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex flex-col space-y-2">
                            {{-- Primary action button based on tournament status --}}
                            @if($tournament->status == 'upcoming')
                                <a href=" {{ route('participant.mytournament.details', ['tournament' => $tournament->id]) }}" class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-calendar-day mr-2"></i>
                                    View Schedule
                                </a>
                            @elseif($tournament->status == 'ongoing')
                                <a href=" {{ route('participant.mytournament.details', ['tournament' => $tournament->id]) }}" class="inline-flex items-center justify-center w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-gamepad mr-2"></i>
                                    Next Match
                                </a>
                            @else
                                <a href=" {{ route('participant.mytournament.details', ['tournament' => $tournament->id]) }}" class="inline-flex items-center justify-center w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-trophy mr-2"></i>
                                    View Results
                                </a>
                            @endif
                            
                            {{-- Secondary action button --}}
                            <a href="" class="inline-flex items-center justify-center w-full px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-lg transition-all duration-300 border border-gray-600">
                                <i class="fas fa-info-circle mr-2"></i>
                                Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</main>

{{-- <!-- CSS for status indicators and animations --> --}}
<style>
    /* Status indicator pulse animations */
    .animate-pulse-slow {
        animation: pulse 3s infinite;
    }
    
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.7; }
        100% { opacity: 1; }
    }
    
    /* Tournament card styling */
    .tournament-card {
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.2);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        will-change: transform;
    }
    
    .tournament-card:hover {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 0 10px rgba(59, 130, 246, 0.3);
        transform: translateY(-5px);
    }
    
    /* Custom pagination styling */
    .pagination-container .pagination {
        @apply flex justify-center items-center space-x-2 mt-8;
    }
    
    .pagination-container .pagination li {
        @apply inline-flex;
    }
    
    .pagination-container .pagination li .page-link,
    .pagination-container .pagination li.active span {
        @apply px-4 py-2 rounded-lg transition-colors duration-200;
    }
    
    .pagination-container .pagination li .page-link {
        @apply bg-gray-700 text-white hover:bg-gray-600;
    }
    
    .pagination-container .pagination li.active span {
        @apply bg-blue-600 text-white;
    }
    
    .pagination-container .pagination li.disabled span {
        @apply bg-gray-800 text-gray-500 cursor-not-allowed;
    }
    
    /* Line clamp for title truncation */
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Button focus styles */
    button:focus, a:focus {
        @apply outline-none ring-2 ring-blue-500/50;
    }
    
    /* Apply gradient border effect on hover */
    .tournament-card:hover::before {
        content: "";
        position: absolute;
        top: -1px;
        left: -1px;
        right: -1px;
        bottom: -1px;
        border-radius: 0.75rem;
        padding: 1px;
        background: linear-gradient(45deg, #3b82f6, #6366f1, #4f46e5);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
        z-index: 10;
    }
</style>
@endsection