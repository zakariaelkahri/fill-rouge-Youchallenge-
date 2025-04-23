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
                                        {{ $tournament->particpated_teams }}/{{ $tournament->max_participants }} Participants
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-2">
                                @if (strtolower($tournament->status) == 'upcoming')
                                    
                                <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit
                                </a>
                                @endif
                                @if(strtolower($tournament->status) == 'upcoming')
                                <form action="{{route('organisator.start.tournament',['tournament'=>$tournament->id])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 w-full">
                                        <i class="fas fa-play mr-2"></i>
                                        Start Tournament
                                    </button>
                                </form>
                                @elseif(strtolower($tournament->status) == 'ongoing')
                                <form action="{{route('organisator.tournament.complete')}}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="id" value="{{ $tournament->id }}">
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
                @php
                    $next_round = true;
                    if((isset($rounds) && count($rounds) > 0))
                    {
                        foreach ($rounds as $round)
                        {
                            if($round->status != 'finished')
                            {
                                $next_round = false;
                            }
                        }
                    }
                @endphp

                @if ($next_round == true)
                    <form action="{{route('organisator.start.tournament',['tournament'=>$tournament->id])}}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 w-full">
                            <i class="fas fa-play mr-2"></i>
                            Next Round
                        </button>
                    </form>    
                @endif
            </div>
            
            @if(isset($rounds) && count($rounds) > 0)
            
            <!-- Rounds Section - One form per round -->
            <div class="space-y-4 rounds-container">
                @foreach($rounds as $roundIndex => $round)
                <div class="round-container bg-gray-700/30 rounded-xl overflow-hidden">
                    <!-- Round Header (Clickable) -->
                    <div class="round-header bg-gray-700/70 p-4 flex items-center justify-between cursor-pointer" data-round-id="{{ $round->id }}">
                        <span class="text-lg font-semibold text-white">Round {{ $round->round }}</span>
                        <button type="button" class="toggle-round-btn p-2 text-gray-400 hover:text-white focus:outline-none" data-round-id="{{ $round->id }}">
                            <i class="fas fa-chevron-down transition-transform duration-200 {{ $roundIndex === 0 ? 'rotate-180' : '' }}"></i>
                        </button>
                    </div>
                    
                    <!-- Round Matches (Hidden by default except first round) -->
                    <div class="round-matches overflow-hidden bg-gray-700/50 {{ $roundIndex === 0 ? '' : 'hidden' }}" id="round-matches-{{ $round->id }}">
                        <form class="round-form" action="{{route('organisator.save.round')}}" method="POST" id="round-form-{{ $round->id }}">
                            @csrf
                            @method('PATCH')                            
                            <input type="hidden" name="round_id" value="{{ $round->id }}">
                            <input type="hidden" name="last_match" value="{{ count($round->matches) }}">
                            
                            <div class="divide-y divide-gray-700">
                                @foreach($round->matches as $matchIndex => $match)
                                <div class="p-4 hover:bg-gray-700/80 transition duration-200 match-row {{ $match->status == 'completed' ? 'completed' : 'pending' }}" data-match-id="{{ $match->id }}">
                                    <div class="flex flex-wrap items-center gap-4">
                                        <!-- Match Info -->
                                        <div class="w-full sm:w-auto flex items-center mb-2 sm:mb-0">
                                            <span class="text-gray-400 text-sm font-medium">Match #{{ $match->id }}</span>
                                            <input type="hidden" name="matches[{{ $matchIndex }}][id]" value="{{ $match->id }}">
                                        </div>
                                        
                                        <!-- Teams and Scores -->
                                        <div class="flex-1 flex items-center">
                                            <!-- Team A -->
                                            <div class="flex flex-col items-start flex-1">
                                                <!-- Team name field -->
                                                <h3 class="mb-2 w-full bg-gray-700 text-white text-sm rounded px-2 py-1 border border-gray-600">
                                                    {{ $match->getTeamName($match->team1_id) }}
                                                </h3>
 
                                                <!-- Team selection -->
                                                <div class="team-select cursor-pointer flex items-center p-2 rounded-lg transition-colors {{ $match->winner_id == $match->team_a_id ? 'bg-green-900/30 border border-green-700' : '' }}" 
                                                    data-team-id="{{ $match->team1_id }}" data-match-index="{{ $matchIndex }}">
                                                    <div class="h-10 w-10 bg-gray-600 rounded-full mr-3 flex-shrink-0">
                                                        <!-- Team photo display -->
                                                        <div class="h-10 w-10 rounded-full border border-gray-600 overflow-hidden flex-shrink-0 bg-gray-800">
                                                            <img src="{{ $match->getTeamPhotoUrl($match->team1_id) ?? asset('images/default-team.png') }}" class="h-full w-full object-cover" alt="Team A">
                                                        </div>
                                                    </div>
                                                    <div class="font-medium text-white">Select as winner</div>
                                                </div>
                                            </div>
                                            
                                            <!-- Score Inputs -->
                                            @if ($match->status == 'finished')
                                                
                                            <div class="flex items-center mx-4">
                                                <input type="number" min="0" name="matches[{{ $matchIndex }}][score_team1]" value="{{ $match->getResault($match->id)->score_team1 }}" 
                                                    class="w-12 text-center bg-gray-700 text-white rounded-lg px-2 py-1 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20 score-input"
                                                    {{  $match->status == 'finished' ? 'disabled' : '' }}>
                                                <span class="text-gray-400 font-bold mx-2">:</span>
                                                <input type="number" min="0" name="matches[{{ $matchIndex }}][score_team2]" value="{{ $match->getResault($match->id)->score_team2 }}" 
                                                    class="w-12 text-center bg-gray-700 text-white rounded-lg px-2 py-1 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20 score-input"
                                                    {{  $match->status == 'finished' ? 'disabled' : '' }}>
                                            </div>                                                
                                            @else
                                            <div class="flex items-center mx-4">
                                                <input type="number" min="0" name="matches[{{ $matchIndex }}][score_team1]" value="{{ $match->score_team1 }}" 
                                                    class="w-12 text-center bg-gray-700 text-white rounded-lg px-2 py-1 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20 score-input"
                                                    {{ $match->status == 'completed' ? 'disabled' : '' }}>
                                                <span class="text-gray-400 font-bold mx-2">:</span>
                                                <input type="number" min="0" name="matches[{{ $matchIndex }}][score_team2]" value="{{ $match->score_team2 }}" 
                                                    class="w-12 text-center bg-gray-700 text-white rounded-lg px-2 py-1 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20 score-input"
                                                    {{ $match->status == 'completed' ? 'disabled' : '' }}>
                                            </div>
                                            @endif
                                            
                                            <!-- Team B -->
                                            <div class="flex flex-col items-end flex-1">
                                                <!-- Team name field -->
                                                <h3 class="mb-2 w-full bg-gray-700 text-white text-sm rounded px-2 py-1 border border-gray-600">
                                                    {{ $match->getTeamName($match->team2_id) }}
                                                </h3>
  
                                                <!-- Team selection -->
                                                <div class="team-select cursor-pointer flex items-center p-2 rounded-lg transition-colors {{ $match->winner_id == $match->team_b_id ? 'bg-green-900/30 border border-green-700' : '' }}" 
                                                    data-team-id="{{ $match->team2_id }}" data-match-index="{{ $matchIndex }}">
                                                    <div class="font-medium text-white">Select as winner</div>
                                                    <div class="h-10 w-10 bg-gray-600 rounded-full ml-3 flex-shrink-0">
                                                        <!-- Team photo display -->
                                                        <div class="h-10 w-10 rounded-full border border-gray-600 overflow-hidden flex-shrink-0 bg-gray-800">
                                                            <img src="{{ $match->getTeamPhotoUrl($match->team2_id) ?? asset('images/default-team.png') }}" class="h-full w-full object-cover" alt="Team B">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="matches[{{ $matchIndex }}][winner_id]" value="{{ $match->winner_team }}" class="winner-input">
                                        </div>
                                    </div>
                                    <!-- Error message container for this match -->
                                    <div class="match-error-container mt-2"></div>
                                </div>
                                @endforeach
                            </div>
                            
                            <!-- Submit Round Button -->
                            @if ($round->status == 'not_started' && $tournament->status == 'ongoing')
                            
                            <div class="p-4 flex justify-end">
                                <button type="submit" class="save-round-btn inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <i class="fas fa-save mr-2"></i>
                                    Save Round {{$round->round}}
                                </button>
                            </div>
                                
                            @endif
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                @if(strtolower($tournament->status) == 'upcoming')
                    <div class="text-center py-10 text-gray-400">
                        <p>No matches available. Start the tournament to generate matches.</p>
                    </div>
                @else
                    <div class="text-center py-10 text-gray-400">
                        <p>No matches available. Use the "Create Match" button to add matches.</p>
                    </div>
                @endif
            @endif
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
                        <span class="text-sm text-gray-400">{{ $tournament->particpated_teams }}/{{ $tournament->max_participants }}</span>
                    </div>
                    
                    <div class="space-y-3">
                        <!-- Progress bar -->
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            @php
                                $participantPercentage = min(100, ($tournament->particpated_teams / $tournament->max_participants) * 100);
                            @endphp
                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $participantPercentage }}%"></div>
                        </div>
                        
                        <!-- NEW: Qualified Teams Section -->
                        <div class="mt-4 border-t border-gray-700 pt-4">
                            <div class="flex items-center mb-2">
                                <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                <h3 class="text-sm font-semibold text-white">Qualified Teams</h3>
                            </div>
                            
                            <div class="divide-y divide-gray-700">
                                @php $qualifiedTeams = $teams->where('eliminated', false); @endphp
                                
                                @if($qualifiedTeams->count() > 0)
                                    @foreach($qualifiedTeams as $team)
                                    <div class="flex items-center py-2">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full overflow-hidden">
                                            <img src="{{ $team->getPhotoUrl() }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-white">
                                                {{ $team->name }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-400 py-2">No qualified teams yet.</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- NEW: Eliminated Teams Section -->
                        <div class="mt-4 border-t border-gray-700 pt-4">
                            <div class="flex items-center mb-2">
                                <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span>
                                <h3 class="text-sm font-semibold text-white">Eliminated Teams</h3>
                            </div>
                            
                            <div class="divide-y divide-gray-700">
                                @php $eliminatedTeams = $teams->where('eliminated', true); @endphp
                                
                                @if($eliminatedTeams->count() > 0)
                                    @foreach($eliminatedTeams as $team)
                                    <div class="flex items-center py-2 opacity-75">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full overflow-hidden grayscale">
                                            <img src="{{ $team->getPhotoUrl() }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-400">
                                                {{ $team->name }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-400 py-2">No eliminated teams yet.</p>
                                @endif
                            </div>
                        </div>
                        
                        @if(count($teams) > 5)
                        <div class="text-center py-2 border-t border-gray-700 mt-3">
                            <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">
                                View all teams
                            </a>
                        </div>
                        @endif
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


@if (session('success'))
<script>
Swal.fire({
    position: "center",
    icon: "success",
    title: @json(session('success') . ' 🎮'),
    showConfirmButton: false,
    timer: 2000,
    customClass: {
        popup: 'rounded-xl bg-gray-800 text-white'
    },
    background: '#1f2937', 
});
</script>
@endif


@if (session('failed'))
    <script>
      Swal.fire({
  position: "center", 
  icon: "error",
  title: "Oops...",
  text: @json(session('failed')),
  footer: '<a href="#">Why do I have this issue?</a>',
  showConfirmButton: true,
  customClass: {
    popup: 'rounded-xl shadow-lg'
  }
      });
</script>
@endif


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
    
    /* Round toggle animation */
    .toggle-round-btn i {
        transition: transform 0.3s ease;
    }
    
    .toggle-round-btn i.rotate-180 {
        transform: rotate(180deg);
    }
    
    .round-matches {
        transition: all 0.3s ease;
    }
    
    /* Form validation styles */
    .input-error {
        border-color: #ef4444 !important;
    }
    
    .error-message {
        font-size: 0.875rem;
        color: #ef4444;
        margin-top: 0.25rem;
    }
    
    /* Team selection highlight */
    .team-select.selected {
        background-color: rgba(22, 163, 74, 0.3);
        border: 1px solid rgb(22, 163, 74);
    }
    
    /* New styles for qualified/eliminated teams */
    .grayscale {
        filter: grayscale(100%);
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
        
        // Round toggle functionality
        const roundHeaders = document.querySelectorAll('.round-header');
        const toggleButtons = document.querySelectorAll('.toggle-round-btn');
        
        // Add click event to the entire header
        roundHeaders.forEach(header => {
            header.addEventListener('click', function(e) {
                // Don't trigger if clicking on the button itself (will be handled separately)
                if (e.target.closest('.toggle-round-btn')) {
                    return;
                }
                
                const roundId = this.getAttribute('data-round-id');
                toggleRound(roundId);
            });
        });
        
        // Add click event to just the button
        toggleButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent triggering the header click
                const roundId = this.getAttribute('data-round-id');
                toggleRound(roundId);
            });
        });
        
        // Function to toggle round visibility
        function toggleRound(roundId) {
            const matchesContainer = document.getElementById('round-matches-' + roundId);
            const button = document.querySelector(`.toggle-round-btn[data-round-id="${roundId}"]`);
            const icon = button.querySelector('i');
            
            // Toggle current round
            matchesContainer.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
            
            // Hide all other rounds when showing this one
            if (!matchesContainer.classList.contains('hidden')) {
                document.querySelectorAll('.round-matches').forEach(container => {
                    if (container.id !== 'round-matches-' + roundId && !container.classList.contains('hidden')) {
                        container.classList.add('hidden');
                        const otherRoundId = container.id.replace('round-matches-', '');
                        const otherButton = document.querySelector(`.toggle-round-btn[data-round-id="${otherRoundId}"]`);
                        if (otherButton) {
                            otherButton.querySelector('i').classList.remove('rotate-180');
                        }
                    }
                });
            }
        }
        
        // Team selection for winner - Fixed to properly set the winner
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
                
                // Clear any existing error messages
                const errorContainer = matchRow.querySelector('.match-error-container');
                if (errorContainer) {
                    errorContainer.innerHTML = '';
                }
                
                // Update UI
                matchRow.querySelectorAll('.team-select').forEach(t => {
                    t.classList.remove('bg-green-900/30', 'border', 'border-green-700', 'selected');
                });
                
                this.classList.add('bg-green-900/30', 'border', 'border-green-700', 'selected');
                
                // Show visual feedback
                const notification = document.createElement('div');
                notification.className = 'text-green-400 text-sm text-center mt-2 mb-0';
                notification.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Team selected as winner';
                
                // Replace any existing notification
                const existingNotification = matchRow.querySelector('.winner-notification');
                if (existingNotification) {
                    existingNotification.remove();
                }
                
                notification.classList.add('winner-notification');
                errorContainer.appendChild(notification);
                
                // Fade out notification after 2 seconds
                setTimeout(() => {
                    notification.style.transition = 'opacity 1s';
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        notification.remove();
                    }, 1000);
                }, 2000);
            });
        });
        
        // Create Match Form Validation
        const createMatchForm = document.getElementById('createMatchForm');
        if (createMatchForm) {
            createMatchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Reset errors
                resetFormErrors(this);
                
                let isValid = true;
                
                // Validate team A
                const teamA = document.getElementById('team_a_id');
                if (!teamA.value) {
                    showError(teamA, 'team_a_error', 'Please select Team A');
                    isValid = false;
                }
                
                // Validate team B
                const teamB = document.getElementById('team_b_id');
                if (!teamB.value) {
                    showError(teamB, 'team_b_error', 'Please select Team B');
                    isValid = false;
                } else if (teamB.value === teamA.value) {
                    showError(teamB, 'team_b_error', 'Teams cannot be the same');
                    isValid = false;
                }
                
                // Validate match time
                const matchTime = document.getElementById('match_time');
                if (!matchTime.value) {
                    showError(matchTime, 'match_time_error', 'Please set a match time');
                    isValid = false;
                }
                
                if (isValid) {
                    this.submit();
                }
            });
        }
        
        // Round Form Validation with improved winner checking
        const roundForms = document.querySelectorAll('.round-form');
        roundForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                let isValid = true;
                
                // Remove existing error messages
                const errorMessages = form.querySelectorAll('.error-message, .match-error-container .text-red-500');
                errorMessages.forEach(msg => msg.remove());
                
                // Validate each match that's not completed
                const pendingMatches = form.querySelectorAll('.match-row.pending');
                pendingMatches.forEach(match => {
                    const matchId = match.getAttribute('data-match-id');
                    const errorContainer = match.querySelector('.match-error-container');
                    
                    // Get score inputs
                    const teamAScoreInput = match.querySelector('input[name$="[score_team1]"]');
                    const teamBScoreInput = match.querySelector('input[name$="[score_team2]"]');
                    const winnerInput = match.querySelector('input[name$="[winner_id]"]');
                    
                    // Check if scores are filled
                    if (teamAScoreInput.value === '' || teamBScoreInput.value === '') {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message text-red-500 text-sm mt-2 text-center';
                        errorDiv.textContent = 'Please enter scores for both teams';
                        errorContainer.appendChild(errorDiv);
                        
                        teamAScoreInput.classList.add('input-error');
                        teamBScoreInput.classList.add('input-error');
                        isValid = false;
                    }
                    
                    // Check winner selection
                    if (!winnerInput.value || winnerInput.value === "0" || winnerInput.value === "") {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message text-red-500 text-sm mt-2 text-center';
                        errorDiv.textContent = 'Please select a winning team by clicking on one of the teams';
                        errorContainer.appendChild(errorDiv);
                        isValid = false;
                    } else {
                        // Verify winner selection matches the score
                        const teamAId = match.querySelector('.team-select[data-team-id]').getAttribute('data-team-id');
                        const teamBId = match.querySelectorAll('.team-select[data-team-id]')[1].getAttribute('data-team-id');
                        
                        const teamAScore = parseInt(teamAScoreInput.value) || 0;
                        const teamBScore = parseInt(teamBScoreInput.value) || 0;
                        
                        // Only validate score matching if both scores are set
                        if (teamAScoreInput.value !== '' && teamBScoreInput.value !== '') {
                            if ((teamAScore > teamBScore && winnerInput.value != teamAId) || 
                                (teamBScore > teamAScore && winnerInput.value != teamBId)) {
                                
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'error-message text-red-500 text-sm mt-2 text-center';
                                errorDiv.textContent = 'Winner selection does not match the scores';
                                errorContainer.appendChild(errorDiv);
                                isValid = false;
                            } else if (teamAScore === teamBScore) {
                                const warningDiv = document.createElement('div');
                                warningDiv.className = 'text-yellow-400 text-sm mt-2 text-center';
                                warningDiv.textContent = 'Scores are tied. Make sure this is intentional.';
                                errorContainer.appendChild(warningDiv);
                            }
                        }
                    }
                });
                
                if (isValid) {
                    this.submit();
                } else {
                    // Scroll to the first error
                    const firstError = form.querySelector('.error-message');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        });
        
        // Helper function to show error
        function showError(input, errorId, message) {
            input.classList.add('input-error');
            const errorElement = document.getElementById(errorId);
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        }
        
        // Helper function to reset form errors
        function resetFormErrors(form) {
            const inputs = form.querySelectorAll('input, select');
            const errorMessages = form.querySelectorAll('.error-message');
            
            inputs.forEach(input => {
                input.classList.remove('input-error');
            });
            
            errorMessages.forEach(msg => {
                msg.textContent = '';
                msg.classList.add('hidden');
            });
        }
    });
</script>
@endsection