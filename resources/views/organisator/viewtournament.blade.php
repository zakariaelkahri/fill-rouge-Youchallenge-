@extends('layouts.organisator.master')

@section('organisator.title')
    {{ $tournament->name }} Details
@endsection

@section('organisator-main')
<main class="bg-gray-900 min-h-screen py-8 px-4">
    <div class="container mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{route('organisator.managetournament')}}" class="inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Tournaments
            </a>
        </div>

        <!-- Tournament Header -->
        <div class="relative rounded-xl overflow-hidden mb-8">
            <div class="absolute inset-0">
                <img src="{{ $tournament->getPhotoUrl() }}" alt="{{ $tournament->name }}" class="w-full h-full object-cover blur-sm opacity-50">
            </div>
            <div class="relative bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent p-8">
                <div class="flex flex-col md:flex-row items-start gap-6">
                    <!-- Tournament Image -->
                    <div class="w-full md:w-1/3 lg:w-1/4">
                        <div class="rounded-lg overflow-hidden shadow-lg border-4 border-gray-700">
                            <img src="{{ $tournament->getPhotoUrl() }}" alt="{{ $tournament->name }}" class="w-full aspect-video object-cover">
                        </div>
                    </div>

                    <!-- Tournament Info -->
                    <div class="w-full md:w-2/3 lg:w-3/4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $tournament->name }}</h1>
                                <div class="flex flex-wrap items-center gap-4 text-sm mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-900 text-indigo-300">
                                        <i class="fas fa-gamepad mr-1"></i>
                                        {{ $tournament->format }}
                                    </span>
                                    
                                    <!-- Status Badge -->
                                    @if(strtolower($tournament->status) == 'upcoming')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-900 text-blue-300">
                                            <span class="w-2 h-2 rounded-full bg-blue-400 mr-1"></span>
                                            {{$tournament->status}}
                                        </span>
                                    @elseif(strtolower($tournament->status) == 'ongoing')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-900 text-green-300">
                                            <span class="w-2 h-2 rounded-full bg-green-400 mr-1 animate-pulse"></span>
                                            {{$tournament->status}}
                                        </span>
                                    @elseif(strtolower($tournament->status) == 'completed')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                                            <span class="w-2 h-2 rounded-full bg-gray-400 mr-1"></span>
                                            {{$tournament->status}}
                                        </span>
                                    @endif
                                    
                                    <span class="inline-flex items-center text-gray-400">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        Starts {{ $tournament->start_date }}
                                    </span>
                                    
                                    <span class="inline-flex items-center text-gray-400">
                                        <i class="fas fa-users mr-1"></i>
                                        {{-- {{ $participants_count }} --}}
                                        /{{ $tournament->max_participants }} Participants
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-2">
                                <a href="" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit
                                </a>
                                @if(strtolower($tournament->status) == 'upcoming')
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 w-full">
                                        <i class="fas fa-play mr-2"></i>
                                        Start Tournament
                                    </button>
                                </form>
                                @elseif(strtolower($tournament->status) == 'ongoing')
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors duration-200 w-full">
                                        <i class="fas fa-flag-checkered mr-2"></i>
                                        Complete
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Reward Info -->
                        <div class="mt-4 mb-6">
                            <h3 class="text-xl font-bold text-white mb-2">
                                <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                                Reward
                            </h3>
                            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                                <p class="text-gray-300">{{ $tournament->reward }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tournament Match Management Section -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white">
                    <i class="fas fa-gamepad text-indigo-400 mr-2"></i>
                    Match Management
                </h2>
                @if(strtolower($tournament->status) == 'ongoing')
                <button id="createMatchBtn" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Create Match
                </button>
                @endif
            </div>
            
            {{-- @if($matches->count() > 0) --}}
            <!-- Match Form -->
            <form id="matchResultsForm" action="" method="POST">
                @csrf
                
                <!-- Match Filters -->
                <div class="flex flex-wrap gap-3 mb-4">
                    <button type="button" class="match-filter-btn active px-3 py-2 text-sm font-medium rounded-lg bg-indigo-600 text-white" data-filter="all">
                        All Matches
                    </button>
                    <button type="button" class="match-filter-btn px-3 py-2 text-sm font-medium rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600" data-filter="pending">
                        Pending
                    </button>
                    <button type="button" class="match-filter-btn px-3 py-2 text-sm font-medium rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600" data-filter="completed">
                        Completed
                    </button>
                </div>
                
                <!-- Match List -->
                <div class="overflow-hidden bg-gray-700/50 rounded-xl">
                    <div class="divide-y divide-gray-700" id="match-list">
                        <!-- Match rows generated from database data -->
                        {{-- @foreach($matches as $index => $match) --}}
                        <div class="p-4 hover:bg-gray-700/80 transition duration-200 match-row 
                        {{-- {{ $match->status == 'completed' ? 'completed' : 'pending' }}" data-match-id="{{ $match->id }} --}}
                            ">
                            <div class="flex flex-wrap items-center gap-4">
                                <!-- Match Info -->
                                <div class="w-full sm:w-auto flex items-center mb-2 sm:mb-0">
                                    <span class="text-gray-400 text-sm font-medium">Match #</span>
                                    <input type="hidden" name="matches[{{ $index }}][id]" value="{{ $match->id }}">
                                </div>
                                
                                <!-- Teams and Scores -->
                                <div class="flex-1 flex items-center">
                                    <!-- Team A (clickable for winner selection) -->
                                    {{-- <div class="team-select cursor-pointer flex items-center p-2 rounded-lg transition-colors {{ $match->winner_id == $match->team_a_id ? 'bg-green-900/30 border border-green-700' : '' }}" 
                                         data-team-id="{{ $match->team_a_id }}" data-match-index="{{ $index }}">
                                        <div class="h-10 w-10 bg-gray-600 rounded-full mr-3 flex-shrink-0">
                                            @if($match->teamA->photo)
                                                <img src="{{ $match->teamA->getPhotoUrl() }}" alt="{{ $match->teamA->name }}" class="h-10 w-10 object-cover rounded-full">
                                            @endif
                                        </div>
                                        <div class="font-medium text-white">{{ $match->teamA->name }}</div>
                                    </div> --}}
                                    
                                    <!-- Score Inputs -->
                                    <div class="flex items-center mx-4">
                                        <input type="number" min="0" name="matches[{{ $index }}][team_a_score]" value="" 
                                               class="w-12 text-center bg-gray-700 text-white rounded-lg px-2 py-1 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20"
                                               {{ $match->status == 'completed' ? 'disabled' : '' }}>
                                        <span class="text-gray-400 font-bold mx-2">:</span>
                                        <input type="number" min="0" name="matches[{{ $index }}][team_b_score]" value="{{ $match->team_b_score }}" 
                                               class="w-12 text-center bg-gray-700 text-white rounded-lg px-2 py-1 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20"
                                               {{ $match->status == 'completed' ? 'disabled' : '' }}>
                                    </div>
                                    
                                    <!-- Team B (clickable for winner selection) -->
                                    <div class="team-select cursor-pointer flex items-center p-2 rounded-lg transition-colors {{ $match->winner_id == $match->team_b_id ? 'bg-green-900/30 border border-green-700' : '' }}" 
                                         data-team-id="" data-match-index="{{ $index }}">
                                        <div class="font-medium text-white">
                                            {{-- {{ $match->teamB->name }} --}}
                                        </div>
                                        <div class="h-10 w-10 bg-gray-600 rounded-full ml-3 flex-shrink-0">
                                            @if($match->teamB->photo)
                                                <img src="{{ $match->teamB->getPhotoUrl() }}" alt="" class="h-10 w-10 object-cover rounded-full">
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" name="matches[{{ $index }}][winner_id]" value="{{ $match->winner_id }}">
                                </div>
                                
                                <!-- Action Button -->
                                <div>
                                    {{-- @if($match->status == 'pending') --}}
                                        <button type="button" class="save-match-btn inline-flex items-center justify-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                                                data-match-index="{{ $index }}" data-match-id="{{ $match->id }}">
                                            <i class="fas fa-check mr-1"></i> Submit
                                        </button>
                                    {{-- @else --}}
                                        {{-- <div class="flex items-center space-x-2">
                                            <span class="text-green-400 text-sm"><i class="fas fa-check-circle"></i> Complete</span>
                                            <button type="button" class="edit-match-btn inline-flex items-center justify-center px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                                                    data-match-index="{{ $index }}" data-match-id="{{ $match->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div> --}}
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                        {{-- @endforeach --}}
                    </div>
                </div>
                
                <!-- Submit All Button -->
                <div class="mt-4 flex justify-end">
                    <button id="saveAllResultsBtn" type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>
                        Save All Changes
                    </button>
                </div>
            </form>
            {{-- @else --}}
                @if(strtolower($tournament->status) == 'upcoming')
                    <div class="text-center py-10 text-gray-400">
                        <p>No matches available. Start the tournament to generate matches.</p>
                    </div>
                @else
                    <div class="text-center py-10 text-gray-400">
                        <p>No matches available. Use the "Create Match" button to add matches.</p>
                    </div>
                @endif
            {{-- @endif --}}
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Rules -->
            <div class="lg:col-span-2">
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold text-white mb-4">
                        <i class="fas fa-book-open text-indigo-400 mr-2"></i>
                        Tournament Rules
                    </h2>
                    <div class="prose prose-invert max-w-none">
                        {!! $tournament->rules !!}
                    </div>
                </div>
            </div>

            <!-- Right Column - Participants & Timeline -->
            <div>
                <!-- Participants Card -->
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-white">
                            <i class="fas fa-users text-indigo-400 mr-2"></i>
                            Participants
                        </h2>
                        <span class="text-sm text-gray-400">{{ $participants_count }}/{{ $tournament->max_participants }}</span>
                    </div>
                    
                    <div class="space-y-3">
                        <!-- Progress bar -->
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            @php
                                $participantPercentage = min(100, ($participants_count / $tournament->max_participants) * 100);
                            @endphp
                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $participantPercentage }}%"></div>
                        </div>
                        
                        <!-- Participant list -->
                        <div class="divide-y divide-gray-700">
                            @foreach($participants as $participant)
                            <div class="flex items-center py-3">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full overflow-hidden">
                                    @if($participant->photo)
                                        <img src="{{ $participant->getPhotoUrl() }}" alt="{{ $participant->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-600"></div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-white">{{ $participant->name }}</p>
                                </div>
                            </div>
                            @endforeach
                            
                            @if($participants_count > count($participants))
                            <div class="text-center py-2">
                                <a href="{{ route('organisator.tournament.participants', $tournament->id) }}" class="text-indigo-400 hover:text-indigo-300 text-sm">
                                    View all participants
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Tournament Timeline -->
                <div class="bg-gray-800 rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-white mb-4">
                        <i class="fas fa-calendar-alt text-indigo-400 mr-2"></i>
                        Timeline
                    </h2>
                    
                    <div class="relative">
                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-700"></div>
                        
                        <div class="relative pl-10 pb-6">
                            <div class="absolute left-0 top-1 rounded-full h-8 w-8 flex items-center justify-center bg-blue-900 text-blue-300">
                                <i class="fas fa-hourglass-start"></i>
                            </div>
                            <h3 class="text-md font-semibold text-white">Registration</h3>
                            <p class="text-sm text-gray-400">Started on {{ date('M d, Y', strtotime('-10 days', strtotime($tournament->start_date))) }}</p>
                        </div>
                        
                        <div class="relative pl-10 pb-6">
                            <div class="absolute left-0 top-1 rounded-full h-8 w-8 flex items-center justify-center {{ strtolower($tournament->status) == 'upcoming' ? 'bg-gray-700 text-gray-400' : 'bg-indigo-900 text-indigo-300' }}">
                                <i class="fas fa-flag"></i>
                            </div>
                            <h3 class="text-md font-semibold text-white">Tournament Starts</h3>
                            <p class="text-sm text-gray-400">{{ date('M d, Y', strtotime($tournament->start_date)) }}</p>
                        </div>
                        
                        <div class="relative pl-10">
                            <div class="absolute left-0 top-1 rounded-full h-8 w-8 flex items-center justify-center {{ strtolower($tournament->status) == 'completed' ? 'bg-purple-900 text-purple-300' : 'bg-gray-700 text-gray-400' }}">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <h3 class="text-md font-semibold text-white">Finals</h3>
                            <p class="text-sm text-gray-400">{{ date('M d, Y', strtotime('+5 days', strtotime($tournament->start_date))) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Create Match Modal -->
<div id="createMatchModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 rounded-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white">Create New Match</h2>
                <button type="button" class="closeModal text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">
                
                <div class="mb-4">
                    <label for="team_a_id" class="block text-sm font-medium text-gray-400 mb-1">Team A</label>
                    <select id="team_a_id" name="team_a_id" required 
                            class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                        <option value="">Select Team A</option>
                        @foreach($participants as $participant)
                            <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="team_b_id" class="block text-sm font-medium text-gray-400 mb-1">Team B</label>
                    <select id="team_b_id" name="team_b_id" required 
                            class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                        <option value="">Select Team B</option>
                        @foreach($participants as $participant)
                            <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="match_time" class="block text-sm font-medium text-gray-400 mb-1">Match Time</label>
                    <input type="datetime-local" id="match_time" name="match_time" required 
                           class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                </div>
                
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg py-2 px-4 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i> Create Match
                </button>
            </form>
        </div>
    </div>
</div>

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
    
    /* Rich text content styling */
    .prose pre {
        background-color: #1f2937;
        border-radius: 0.5rem;
        padding: 1rem;
    }
    
    .prose ul {
        list-style-type: disc;
        margin-left: 1.5rem;
    }
    
    .prose ol {
        list-style-type: decimal;
        margin-left: 1.5rem;
    }
    
    .prose a {
        color: #818cf8;
        text-decoration: underline;
    }
    
    .prose h2, .prose h3, .prose h4 {
        color: white;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
    
    /* Match management styles */
    .match-filter-btn.active {
        background-color: #4f46e5;
        color: white;
    }
    
    .team-select {
        transition: all 0.2s ease;
    }
    
    .team-select:hover {
        background-color: rgba(79, 70, 229, 0.1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal functionality
        const createMatchModal = document.getElementById('createMatchModal');
        const createMatchBtn = document.getElementById('createMatchBtn');
        const closeModalBtns = document.querySelectorAll('.closeModal');
        
        if (createMatchBtn) {
            createMatchBtn.addEventListener('click', function() {
                createMatchModal.classList.remove('hidden');
            });
        }
        
        closeModalBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                createMatchModal.classList.add('hidden');
            });
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === createMatchModal) {
                createMatchModal.classList.add('hidden');
            }
        });
        
        // Match filtering
        const filterButtons = document.querySelectorAll('.match-filter-btn');
        const matchRows = document.querySelectorAll('.match-row');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Update active button
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-indigo-600', 'text-white');
                    btn.classList.add('bg-gray-700', 'text-gray-300', 'hover:bg-gray-600');
                });
                
                this.classList.add('active', 'bg-indigo-600', 'text-white');
                this.classList.remove('bg-gray-700', 'text-gray-300', 'hover:bg-gray-600');
                
                // Filter matches
                matchRows.forEach(row => {
                    if (filter === 'all' || row.classList.contains(filter)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
        
        // Team selection for winner
        const teamSelectors = document.querySelectorAll('.team-select');
        teamSelectors.forEach(team => {
            team.addEventListener('click', function() {
                const matchIndex = this.getAttribute('data-match-index');
                const teamId = this.getAttribute('data-team-id');
                const matchRow = this.closest('.match-row');
                
                // Don't allow selection for completed matches
                if (matchRow.classList.contains('completed') && !matchRow.classList.contains('editing')) {
                    return;
                }
                
                // Update hidden winner input
                const winnerInput = matchRow.querySelector(`input[name="matches[${matchIndex}][winner_id]"]`);
                winnerInput.value = teamId;
                
                // Update UI
                matchRow.querySelectorAll('.team-select').forEach(t => {
                    t.classList.remove('bg-green-900/30', 'border', 'border-green-700');
                });
                
                this.classList.add('bg-green-900/30', 'border', 'border-green-700');
            });
        });
        
        // Individual save match buttons
        const saveMatchButtons = document.querySelectorAll('.save-match-btn');
        saveMatchButtons.forEach(button => {
            button.addEventListener('click', function() {
                const matchIndex = this.getAttribute('data-match-index');
                const matchId = this.getAttribute('data-match-id');
                const matchRow = this.closest('.match-row');
                const winnerId = matchRow.querySelector(`input[name="matches[${matchIndex}][winner_id]"]`).value;
                const teamAScore = matchRow.querySelector(`input[name="matches[${matchIndex}][team_a_score]"]`).value;
                const teamBScore = matchRow.querySelector(`input[name="matches[${matchIndex}][team_b_score]"]`).value;
                
                if (!winnerId) {
                    alert('Please select a winner by clicking on a team.');
                    return;
                }
                
                // Change button to loading state
                const originalHtml = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Saving...';
                this.disabled = true;
                
                // AJAX request to update single match
                fetch(`{{ route('organisator.match.update', '') }}/${matchId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        winner_id: winnerId,
                        team_a_score: teamAScore,
                        team_b_score: teamBScore
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update match status
                        matchRow.classList.remove('pending');
                        matchRow.classList.add('completed');
                        
                        // Disable inputs
                        matchRow.querySelectorAll('input[type="number"]').forEach(input => {
                            input.disabled = true;
                        });
                        
                        // Replace button with completed status
                        this.parentNode.innerHTML = `
                            <div class="flex items-center space-x-2">
                                <span class="text-green-400 text-sm"><i class="fas fa-check-circle"></i> Complete</span>
                                <button type="button" class="edit-match-btn inline-flex items-center justify-center px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                                        data-match-index="${matchIndex}" data-match-id="${matchId}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        `;
                        
                        // Add event listener to new edit button
                        addEditButtonListeners();
                    } else {
                        alert('Error updating match: ' + data.message);
                        this.innerHTML = originalHtml;
                        this.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the match.');
                    this.innerHTML = originalHtml;
                    this.disabled = false;
                });
            });
        });
        
        // Edit match button functionality
        function addEditButtonListeners() {
            document.querySelectorAll('.edit-match-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const matchIndex = this.getAttribute('data-match-index');
                    const matchId = this.getAttribute('data-match-id');
                    const matchRow = this.closest('.match-row');
                    
                    // Enable editing
                    matchRow.classList.add('editing');
                    
                    // Enable score inputs
                    matchRow.querySelectorAll('input[type="number"]').forEach(input => {
                        input.disabled = false;
                    });
                    
                    // Replace edit button with save button
                    this.parentNode.innerHTML = `
                        <button type="button" class="save-match-btn inline-flex items-center justify-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                                data-match-index="${matchIndex}" data-match-id="${matchId}">
                            <i class="fas fa-check mr-1"></i> Update
                        </button>
                    `;
                    
                    // Add save button listener
                    const newSaveBtn = matchRow.querySelector('.save-match-btn');
                    newSaveBtn.addEventListener('click', function() {
                        const winnerId = matchRow.querySelector(`input[name="matches[${matchIndex}][winner_id]"]`).value;
                        const teamAScore = matchRow.querySelector(`input[name="matches[${matchIndex}][team_a_score]"]`).value;
                        const teamBScore = matchRow.querySelector(`input[name="matches[${matchIndex}][team_b_score]"]`).value;
                        
                        if (!winnerId) {
                            alert('Please select a winner by clicking on a team.');
                            return;
                        }
                        
                        // Loading state
                        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Saving...';
                        this.disabled = true;
                        
                        // AJAX request to update match
                        fetch(`{{ route('organisator.match.update', '') }}/${matchId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                winner_id: winnerId,
                                team_a_score: teamAScore,
                                team_b_score: teamBScore
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Disable editing
                                matchRow.classList.remove('editing');
                                
                                // Disable inputs
                                matchRow.querySelectorAll('input[type="number"]').forEach(input => {
                                    input.disabled = true;
                                });
                                
                                // Replace with completed status
                                this.parentNode.innerHTML = `
                                    <div class="flex items-center space-x-2">
                                        <span class="text-green-400 text-sm"><i class="fas fa-check-circle"></i> Complete</span>
                                        <button type="button" class="edit-match-btn inline-flex items-center justify-center px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                                                data-match-index="${matchIndex}" data-match-id="${matchId}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                `;
                                
                                // Re-add edit button listeners
                                addEditButtonListeners();
                            } else {
                                alert('Error updating match: ' + data.message);
                                this.innerHTML = '<i class="fas fa-check mr-1"></i> Update';
                                this.disabled = false;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while updating the match.');
                            this.innerHTML = '<i class="fas fa-check mr-1"></i> Update';
                            this.disabled = false;
                        });
                    });
                });
            });
        }
        
        // Initialize edit button listeners
        addEditButtonListeners();
    });
</script>
@endsection