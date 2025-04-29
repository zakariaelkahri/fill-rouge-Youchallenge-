@extends('layouts.organisator.master')

@section('organisator.title')
    Manage Tournaments
@endsection

@section('organisator-main')
<main class="bg-gray-900 min-h-screen py-8 px-4">
    <div class="container mx-auto">
        {{-- <!-- Dashboard Header --> --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">Manage Tournaments</h1>
                <p class="text-gray-400 mt-2">Control and monitor all your esports events</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Create Tournament
                </a>
            </div>
        </div>

        {{-- <!-- Tournament Filter Section --> --}}
        <div class="bg-gray-800 rounded-xl p-4 mb-8">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="flex-1 min-w-[200px]">
                    <label for="status-filter" class="block text-sm font-medium text-gray-400 mb-1">Filter by Status</label>
                    <select id="status-filter" class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                        <option value="all">All Tournaments</option>
                        <option value="upcoming">Upcoming</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="format-filter" class="block text-sm font-medium text-gray-400 mb-1">Filter by Format</label>
                    <select id="format-filter" class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                        <option value="all">All Formats</option>
                        <option value="CSGO">CS:GO</option>
                        <option value="DOTA2">FC</option>
                        <option value="LOL">League of Legends</option>
                        <option value="VALORANT">Valorant</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="search-tournament" class="block text-sm font-medium text-gray-400 mb-1">Search</label>
                    <div class="relative">
                        <input type="text" id="search-tournament" placeholder="Search tournaments..." class="w-full bg-gray-700 text-white rounded-lg pl-10 pr-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach ($tournaments as $tournament)
            {{-- <!-- Tournament Card --> --}}
            <div class="bg-gray-800 rounded-xl overflow-hidden transition-transform duration-300 hover:scale-[1.02] hover:shadow-lg">
                <div class="relative">
                    <img src="{{ $tournament->getPhotoUrl() }}" alt="{{$tournament->format}}" class="w-full h-48 object-cover">
                    <div class="absolute top-3 right-3">
                        @if($tournament->status == 'upcoming')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-900 text-blue-300">
                                <span class="w-2 h-2 rounded-full bg-blue-400 mr-1"></span>
                                {{$tournament->status}}
                            </span>
                        @elseif($tournament->status == 'ongoing')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-900 text-green-300">
                                <span class="w-2 h-2 rounded-full bg-green-400 mr-1 animate-pulse"></span>
                                {{$tournament->status}} 
                            </span>
                        @elseif($tournament->status == 'completed')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                                <span class="w-2 h-2 rounded-full bg-gray-400 mr-1"></span>
                                {{$tournament->status}}
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-900 text-purple-300">
                                <span class="w-2 h-2 rounded-full bg-purple-400 mr-1"></span>
                                {{$tournament->status}}
                            </span>
                        @endif
                    </div>
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
                            <span>{{ $tournament->particpated_teams }}/{{ $tournament->max_participants }}</span>
                        </div>
                    </div>
                    <a href="{{route('organisator.tournamentdetails',['tournament'=>$tournament])}}" class="inline-flex items-center justify-center w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-eye mr-2"></i>
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        {!! $tournaments->links() !!}
    </div>
</main>

{{-- <!-- CSS for status indicators --> --}}
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

{{-- <!-- JavaScript for filter functionality --> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality can be implemented here
        const statusFilter = document.getElementById('status-filter');
        const formatFilter = document.getElementById('format-filter');
        const searchInput = document.getElementById('search-tournament');
        
        // Example of filter implementation
        statusFilter.addEventListener('change', filterTournaments);
        formatFilter.addEventListener('change', filterTournaments);
        searchInput.addEventListener('input', filterTournaments);
        
        function filterTournaments() {
            // This would be implemented with actual filtering logic
            console.log('Filtering with:', {
                status: statusFilter.value,
                format: formatFilter.value,
                search: searchInput.value
            });
            
            // In a real implementation, you would filter the tournament cards
            // based on these values, or make an AJAX request to get filtered data
        }
    });
</script>
@endsection