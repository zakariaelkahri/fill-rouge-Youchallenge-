@extends('layouts.participant.master')

@section('participant.title')
    {{ $tournament->name }} - My Matches
@endsection

@section('participant-main')
<main class="bg-gray-900 min-h-screen py-8 px-4">
    <div class="container mx-auto max-w-7xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('participant.tournaments') }}" class="text-gray-400 hover:text-white">
                <i class="fas fa-arrow-left mr-2"></i> Back to Tournaments
            </a>
        </div>

        <!-- Tournament Card -->
        <div class="bg-gray-800 rounded-xl overflow-hidden mb-8">
            <!-- Tournament Image -->
            <div class="relative h-64 w-full">
                <img src="{{ $tournament->getPhotoUrl() }}" alt="{{ $tournament->name }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
                <div class="absolute bottom-4 left-6">
                    <h1 class="text-4xl font-bold text-white mb-2 shadow-text">{{ $tournament->name }}</h1>
                    <div class="flex flex-wrap items-center gap-3">
                        @if($tournament->status == 'upcoming')
                            <span class="bg-blue-600 text-white text-sm px-3 py-1 rounded-full">Registration Open</span>
                        @elseif($tournament->status == 'ongoing')
                            <span class="bg-green-600 text-white text-sm px-3 py-1 rounded-full animate-pulse">Live Now</span>
                        @elseif($tournament->status == 'completed')
                            <span class="bg-gray-600 text-white text-sm px-3 py-1 rounded-full">Completed</span>
                        @endif
                        <span class="bg-indigo-600 text-white text-sm px-3 py-1 rounded-full">{{ $tournament->format }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Tournament Info -->
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-6">
                    <div class="flex items-center text-gray-400">
                        <i class="far fa-calendar-alt w-5 text-center mr-2"></i>
                        <span>Starts {{ $tournament->start_date }}</span>
                    </div>
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-users w-5 text-center mr-2"></i>
                        <span>{{ $tournament->particpated_teams }}/{{ $tournament->max_participants }} Teams</span>
                    </div>
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-trophy w-5 text-center mr-2"></i>
                        <span>Prize: {{$tournament->reward}}</span>
                    </div>
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-user w-5 text-center mr-2"></i>
                        <span>Organizer: {{ $tournament->organisator->user->name }}</span>
                    </div>
                </div>
                
                <!-- Registration Status & Action Buttons -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex-1">
                        @if($tournament->status == 'upcoming' && $tournament->current_participants < $tournament->max_participants)
                            @if(!$tournament->isParticipating(auth()->user()->id))
                                <div class="bg-blue-900/30 border border-blue-700 rounded-lg p-4">
                                    <p class="text-blue-300">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        This tournament is open for registration. Create a team or join with an invite code.
                                    </p>
                                </div>
                            @else
                                <div class="bg-green-900/30 border border-green-700 rounded-lg p-4">
                                    <p class="text-green-300">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        You're already registered for this tournament.
                                    </p>
                                </div>
                            @endif
                            
                        @elseif($tournament->status == 'upcoming' && !$tournament->isParticipating(auth()->user()->id) && $tournament->current_participants >= $tournament->max_participants)
                            <div class="bg-red-900/30 border border-red-700 rounded-lg p-4">
                                <p class="text-red-300">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    This tournament is full. No more teams can register.
                                </p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-3 ml-4">
                        @if($tournament->status == 'upcoming' && !$tournament->isParticipating(auth()->user()->id) && $tournament->current_participants < $tournament->max_participants)
                            <button id="createTeamBtn" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200">
                                <i class="fas fa-users-cog mr-2"></i> Create Team
                            </button>
                            @if (!$tournament->isParticipating(auth()->user()->id) && count($teams) > 0)
                                <button id="joinTeamBtn" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition duration-200">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Join Team
                                </button>
                            @endif
                        @elseif($tournament->status == 'upcoming' && $tournament->isParticipating(auth()->user()->id))
                            @if($tournament->isTeamCaptain(auth()->user()->id))
                                <button id="showInviteCodeBtn" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                                    <i class="fas fa-key mr-2"></i> Show Invite Code
                                </button>
                            @endif
                            <button id="exitTeamBtn" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i> Exit Team
                            </button>
                        @endif

                        <!-- View Toggle Buttons -->

                        
                        <a href="{{ url()->current() }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-lg transition duration-200">
                            <i class="fas fa-info-circle mr-2"></i> Details
                        </a>
                        <a href="{{ url()->current() }}" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg transition duration-200">
                            <i class="fas fa-gamepad mr-2"></i> My Matches
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Matches -->
            <div class="lg:col-span-2">
                <!-- My Matches Section -->
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-white">
                            <i class="fas fa-gamepad text-indigo-400 mr-2"></i>
                            My Matches
                        </h2>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-400 mr-2">View:</span>
                            <div class="bg-gray-700 rounded-lg p-1 flex">
                                <button class="px-3 py-1 text-sm rounded-md bg-indigo-600 text-white">All</button>
                                <button class="px-3 py-1 text-sm rounded-md text-gray-300 hover:bg-gray-600">Upcoming</button>
                                <button class="px-3 py-1 text-sm rounded-md text-gray-300 hover:bg-gray-600">Completed</button>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($rounds) && count($rounds) > 0)
                        <!-- Rounds Section -->
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
                                
                                <!-- Round Matches -->
                                <div class="round-matches overflow-hidden bg-gray-700/50 {{ $roundIndex === 0 ? '' : 'hidden' }}" id="round-matches-{{ $round->id }}">
                                    <div class="divide-y divide-gray-700">
                                        @php 
                                            // Get user's team from tournament using the correct method
                                            $userTeam = $tournament->getCaptainTeam(auth()->user()->id);
                                            $userTeamId = $userTeam ? $userTeam->id : 0;
                                            // dd($userTeam);
                                        @endphp
                                        
                                        @foreach($round->matches as $matchIndex => $match)
                                            @php 
                                                $isUserMatch = ($match->team1_id == $userTeamId || $match->team2_id == $userTeamId);
                                                $userTeamIsTeam1 = ($match->team1_id == $userTeamId);
                                            @endphp
                                            
                                            <div class="p-4 hover:bg-gray-700/80 transition duration-200 match-row {{ $isUserMatch ? 'bg-indigo-900/20' : '' }}">
                                                <div class="flex items-center justify-between">
                                                    <!-- Match Info -->
                                                    <div class="w-full sm:w-auto flex items-center mb-2 sm:mb-0">
                                                        <span class="text-gray-400 text-sm font-medium">Match #{{ $match->id }}</span>
                                                        @if($isUserMatch)
                                                            <span class="ml-2 bg-indigo-500/30 text-indigo-300 text-xs px-2 py-0.5 rounded-full">
                                                                <i class="fas fa-user mr-1"></i> Your Match
                                                            </span>
                                                        @endif
                                                    </div>
                                                    
                                                    @if($match->status == 'finished')
                                                        <span class="text-xs font-medium {{ $match->winner_id == $userTeamId ? 'text-green-400' : ($isUserMatch ? 'text-red-400' : 'text-gray-400') }}">
                                                            {{ $match->status == 'finished' ? ($match->winner_id == $userTeamId ? '(You Won!)' : ($isUserMatch ? '(You Lost)' : 'Completed')) : 'Upcoming' }}
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <!-- Teams and Scores -->
                                                <div class="flex flex-wrap sm:flex-nowrap items-center justify-between mt-3">
                                                    <!-- Team 1 -->
                                                    <div class="flex items-center w-full sm:w-2/5 justify-end mb-2 sm:mb-0">
                                                        <div class="text-right mr-3">
                                                            <p class="font-medium {{ $userTeamIsTeam1 ? 'text-indigo-300' : 'text-white' }}">
                                                                {{ $match->getTeamName($match->team1_id) }} 
                                                                @if($match->team1_id == $userTeamId)
                                                                    <span class="text-xs text-indigo-400">(You)</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="h-10 w-10 rounded-full overflow-hidden border-2 {{ $userTeamIsTeam1 ? 'border-indigo-500' : 'border-gray-700' }} bg-gray-800">
                                                            <img src="{{ $match->getTeamPhotoUrl($match->team1_id) ?? asset('images/default-team.png') }}" class="h-full w-full object-cover" alt="Team 1">
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Score Display -->
                                                    <div class="flex items-center justify-center mx-4 px-4 py-2 rounded-lg {{ $match->status == 'finished' ? 'bg-gray-700' : 'bg-gray-800' }} w-full sm:w-auto mb-2 sm:mb-0">
                                                        @if($match->status == 'finished')
                                                            <span class="text-xl font-bold {{ $match->winner_id == $match->team1_id ? 'text-green-400' : 'text-white' }}">
                                                                {{ $match->getResault($match->id)->score_team1 }}
                                                            </span>
                                                            <span class="text-gray-400 mx-2">-</span>
                                                            <span class="text-xl font-bold {{ $match->winner_id == $match->team2_id ? 'text-green-400' : 'text-white' }}">
                                                                {{ $match->getResault($match->id)->score_team2 }}
                                                            </span>
                                                        @else
                                                            <span class="text-gray-400 text-sm">
                                                                <i class="far fa-clock mr-1"></i> Upcoming
                                                            </span>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Team 2 -->
                                                    <div class="flex items-center w-full sm:w-2/5 justify-start">
                                                        <div class="h-10 w-10 rounded-full overflow-hidden border-2 {{ !$userTeamIsTeam1 && $match->team2_id == $userTeamId ? 'border-indigo-500' : 'border-gray-700' }} mr-3 bg-gray-800">
                                                            <img src="{{ $match->getTeamPhotoUrl($match->team2_id) ?? asset('images/default-team.png') }}" class="h-full w-full object-cover" alt="Team 2">
                                                        </div>
                                                        <div>
                                                            <p class="font-medium {{ !$userTeamIsTeam1 && $match->team2_id == $userTeamId ? 'text-indigo-300' : 'text-white' }}">
                                                                {{ $match->getTeamName($match->team2_id) }}
                                                                @if($match->team2_id == $userTeamId)
                                                                    <span class="text-xs text-indigo-400">(You)</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Match Details -->
                                                @if($match->status == 'finished')
                                                    <div class="mt-3 pt-2 border-t border-gray-700">
                                                        <div class="flex flex-wrap justify-between items-center">
                                                            <div class="text-sm text-gray-400 mb-2 sm:mb-0">
                                                                <i class="fas fa-calendar-check mr-1"></i> Completed on {{ date('M d, Y', strtotime($match->updated_at)) }}
                                                            </div>
                                                            <div>
                                                                <span class="bg-gray-700 text-gray-300 text-xs px-3 py-1 rounded-full">
                                                                    <i class="fas fa-trophy mr-1 {{ $match->winner_id == $userTeamId ? 'text-yellow-400' : '' }}"></i>
                                                                    Winner: {{ $match->getTeamName($match->winner_id) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="mt-3 pt-2 border-t border-gray-700">
                                                        <div class="flex flex-wrap justify-between items-center">
                                                            <div class="text-sm text-gray-400 mb-2 sm:mb-0">
                                                                <i class="far fa-clock mr-1"></i> Match date will be announced
                                                            </div>
                                                            @if($isUserMatch)
                                                                <div>
                                                                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-3 py-1 rounded-full transition duration-200">
                                                                        <i class="fas fa-bell mr-1"></i> Set Reminder
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10">
                            <div class="inline-block p-6 rounded-full bg-gray-700/50 mb-4">
                                <i class="fas fa-gamepad text-4xl text-gray-500"></i>
                            </div>
                            <h3 class="text-xl font-medium text-white mb-2">No Matches Available</h3>
                            <p class="text-gray-400">Matches will be scheduled once the tournament begins.</p>
                        </div>
                    @endif
                </div>
                
                <!-- Tournament Rules -->
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-6 lg:mb-0">
                    <h2 class="text-2xl font-bold text-white mb-4">
                        <i class="fas fa-book-open text-indigo-400 mr-2"></i>
                        Tournament Rules
                    </h2>
                    <div class="prose prose-invert max-w-none">
                        {!! $tournament->rules !!}
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Team Info & Timeline -->
            <div>
                <!-- User's Team Card -->
                @php 
                    // Get user's team from tournament using the correct method
                    $userTeam = $tournament->getCaptainTeam(auth()->user()->id); 
                @endphp
                @if($userTeam)
                    <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-6">
                        <h2 class="text-xl font-bold text-white mb-4">
                            <i class="fas fa-users text-indigo-400 mr-2"></i>
                            Your Team
                        </h2>
                        <div class="flex items-center mb-4">
                            <div class="h-14 w-14 rounded-full overflow-hidden border-2 border-indigo-600 mr-4 flex-shrink-0">
                                <img src="{{ $userTeam->getPhotoUrl() }}" alt="{{ $userTeam->name }}" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white">{{ $userTeam->name }}</h3>
                                <p class="text-gray-400 text-sm">
                                    <i class="fas fa-users mr-1"></i> 
                                    {{ $userTeam->participated_members }}/{{ $tournament->team_mode }} Members
                                </p>
                            </div>
                        </div>
                        
                        <!-- Team Stats -->
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="bg-gray-700/50 rounded-lg p-3 text-center">
                                <p class="text-sm text-gray-400">Matches</p>
                                <p class="text-2xl font-bold text-white">{{ $userTeam->matches_played ?? 0 }}</p>
                            </div>
                            <div class="bg-gray-700/50 rounded-lg p-3 text-center">
                                <p class="text-sm text-gray-400">Wins</p>
                                <p class="text-2xl font-bold text-green-400">{{ $userTeam->matches_won ?? 0 }}</p>
                            </div>
                        </div>
                        
                        <!-- Team Status -->
                        @if($userTeam->eliminated)
                            <div class="bg-red-900/30 border border-red-700 rounded-lg p-3 mb-4">
                                <p class="text-red-300 text-center">
                                    <i class="fas fa-times-circle mr-2"></i>
                                    Your team has been eliminated
                                </p>
                            </div>
                        @elseif($tournament->status == 'ongoing')
                            <div class="bg-green-900/30 border border-green-700 rounded-lg p-3 mb-4">
                                <p class="text-green-300 text-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Your team is still in the tournament
                                </p>
                            </div>
                        @endif
                        
                        <!-- Team Members -->
                        <h3 class="text-sm font-semibold text-gray-400 mb-2 flex items-center">
                            <i class="fas fa-user-friends mr-1"></i> Team Members
                        </h3>
                        <div class="space-y-2">
                            {{-- @foreach($userTeam->members as $member)
                                <div class="flex items-center bg-gray-700/50 rounded-lg p-2">
                                    <div class="h-8 w-8 rounded-full overflow-hidden mr-3 flex-shrink-0">
                                        <img src="{{ $member->user->getPhotoUrl() }}" alt="{{ $member->user->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-white">{{ $member->user->name }}</p>
                                        <p class="text-xs text-gray-400">
                                            @if($member->is_captain)
                                                <i class="fas fa-crown text-yellow-400 mr-1"></i> Captain
                                            @else
                                                <i class="fas fa-user mr-1"></i> Member
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach --}}
                        </div>
                    </div>
                @endif
                
                <!-- Tournament Bracket Preview -->
                @if($tournament->status == 'ongoing' || $tournament->status == 'completed')
                    <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-6">
                        <h2 class="text-xl font-bold text-white mb-4">
                            <i class="fas fa-sitemap text-indigo-400 mr-2"></i>
                            Tournament Bracket
                        </h2>
                        <div class="bg-gray-700/50 rounded-lg p-4 h-48 flex items-center justify-center">
                            <p class="text-gray-400">Tournament bracket visualization will be displayed here.</p>
                        </div>
                    </div>
                @endif
                
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
        
        <!-- Registered Teams -->
        <div class="bg-gray-800 rounded-xl p-6 mt-8">
            <h2 class="text-2xl font-bold text-white mb-4">Registered Teams ({{ $tournament->particpated_teams }}/{{ $tournament->max_participants }})</h2>
            
            @if(count($teams) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($teams as $team)
                        @php 
                            // Check if this is the user's team using the correct method
                            $my = $tournament->getCaptainTeam(auth()->user()->id);
                            $isUserTeam = $userTeam && $userTeam->id === $team->id;
                        @endphp
                        <div class="bg-gray-700 rounded-lg p-4 flex items-center {{ $isUserTeam ? 'border-2 border-indigo-500' : '' }} {{ $team->eliminated == 1 ? 'opacity-75' : '' }}">
                            <div class="h-12 w-12 rounded-full bg-gray-600 mr-4 flex-shrink-0 overflow-hidden {{ $team->eliminated ? 'grayscale' : '' }}">
                                <img src="{{ $team->getPhotoUrl() ?? asset('images/default.png') }}" alt="{{ $team->name }}" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <div class="text-white font-medium flex items-center">
                                    {{ $team->name }}
                                    @if($isUserTeam)
                                        <span class="ml-2 text-xs bg-indigo-500/30 text-indigo-300 px-2 py-0.5 rounded-full">Your Team</span>
                                    @endif
                                </div>
                                <div class="text-xs text-gray-400">
                                    Captain: {{ $team->getTeamCaptainName() }}
                                    <br> 
                                    Members: {{ $team->participated_members.'/'.$tournament->team_mode }}
                                    @if($team->eliminated == 1)
                                        <span class="inline-block mt-1 text-red-400">
                                            <i class="fas fa-times-circle mr-1"></i> Eliminated
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">No teams have registered yet. Be the first!</p>
            @endif
        </div>
    </div>
</main>

{{-- <!-- Create Team Modal --> --}}
<div id="createTeamModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 rounded-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white">Create Your Team</h2>
                <button class="closeModal text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form action="{{route('participant.team.create')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Team Name</label>
                    <input type="text" id="name" name="name" required 
                        class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                </div>
                
                <div class="mb-4">
                    <label for="photo" class="block text-sm font-medium text-gray-400 mb-1">Team Logo (Optional)</label>
                    <input type="file" id="photo" name="photo" accept="image/*"
                        class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                </div>
                
                <div class="mb-4">
                    <label for="team_bio" class="block text-sm font-medium text-gray-400 mb-1">Team Bio (Optional)</label>
                    <textarea id="team_bio" name="team_bio" rows="3" 
                        class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20"></textarea>
                </div>
                
                <div class="space-y-3 mb-4">
                    <label class="block text-sm font-medium text-gray-400">Team Captain</label>
                    
                    {{-- <!-- You (Captain) --> --}}
                    <div class="p-3 bg-gray-700 rounded-lg border border-gray-600 flex items-center">
                        <div class="h-10 w-10 rounded-full overflow-hidden bg-gray-600 mr-3">
                            <img src="{{ auth()->user()->getPhotoUrl() }}" alt="{{ auth()->user()->name }}" class="h-full w-full object-cover">
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-medium">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-400">You (Captain)</p>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg py-3 px-4 transition duration-200">
                    <i class="fas fa-users mr-2"></i> Create Team & Join Tournament
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Join Team Modal -->
<div id="joinTeamModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 rounded-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white">Join a Team</h2>
                <button class="closeModal text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form action="{{route('participant.join.team')}}" method="POST">
                @csrf
                <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">
                
                <div class="mb-4">
                    <label for="invitation_code" class="block text-sm font-medium text-gray-400 mb-1">Team Invite Code</label>
                    <input type="number" id="invitation_code" name="invitation_code" required 
                        class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
                    <p class="mt-1 text-xs text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Ask the team captain for their invite code.
                    </p>
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg py-3 px-4 transition duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i> Join Team
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Show Invite Code Modal -->
<div id="inviteCodeModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 rounded-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white">Team Invitation Code</h2>
                <button class="closeModal text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="bg-gray-700 rounded-lg p-6 text-center mb-6">
                <p class="text-gray-400 mb-2">Share this code with players you want to invite to your team:</p>
                @php $captainTeam = $tournament->getCaptainTeam(auth()->user()->id); @endphp
                <div class="text-3xl font-bold text-white tracking-wider mb-2">{{ $tournament->isTeamCaptain(auth()->user()->id) && $captainTeam ? $captainTeam->invitation_code : '' }}</div>
                <p class="text-xs text-gray-400">This code is unique to your team.</p>
            </div>
            
            <button id="copyInviteCode" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg py-3 px-4 transition duration-200">
                <i class="fas fa-copy mr-2"></i> Copy Invitation Code
            </button>
        </div>
    </div>
</div>

<!-- Exit Team Confirmation Modal -->
<div id="exitTeamModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 rounded-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white">Exit Team</h2>
                <button class="closeModal text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="bg-red-900/30 border border-red-700 rounded-lg p-4 mb-6">
                <p class="text-red-300">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Are you sure you want to leave your team? This action cannot be undone.
                </p>
                @if($tournament->isTeamCaptain(auth()->user()->id))
                <p class="text-red-300 mt-2">
                    <i class="fas fa-crown mr-2"></i>
                    <strong>Warning:</strong> As the team captain, leaving will dissolve the team for all members.
                </p>
                @endif
            </div>
               
            <form action="{{ route('participant.exit.team') }}" method="POST">
                @csrf
                @method('DELETE')

                <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">
                
                <div class="flex space-x-3">
                    <button type="button" class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-lg py-3 px-4 transition duration-200 closeModal">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg py-3 px-4 transition duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i> Exit Team
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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

@if (session('joinfailed'))
<script>
    Swal.fire({
        position: "center", 
        icon: "error",
        title: "Oops...",
        text: @json(session('joinfailed')),
        footer: '<a href="#">Why do I have this issue?</a>',
        showConfirmButton: true,
        customClass: {
            popup: 'rounded-xl shadow-lg'
        }
    });
</script>
@endif

<style>
    .shadow-text {
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }
    
    /* Animation for status indicators */
    .animate-pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
    
    /* Modal animations */
    .modal-enter {
        animation: fadeIn 0.3s ease-out forwards;
    }
    
    .modal-leave {
        animation: fadeOut 0.2s ease-in forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
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
    
    /* Grayscale for eliminated teams */
    .grayscale {
        filter: grayscale(100%);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal functionality
        const modals = ['createTeamModal', 'joinTeamModal', 'inviteCodeModal', 'exitTeamModal'];
        const buttons = ['createTeamBtn', 'joinTeamBtn', 'showInviteCodeBtn', 'exitTeamBtn'];
        
        // Open modals
        buttons.forEach((btnId, index) => {
            const btn = document.getElementById(btnId);
            if (btn) {
                btn.addEventListener('click', function() {
                    document.getElementById(modals[index]).classList.remove('hidden');
                    document.getElementById(modals[index]).classList.add('modal-enter');
                });
            }
        });
        
        // Close modals
        document.querySelectorAll('.closeModal').forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = this.closest('[id$="Modal"]');
                closeModal(modal);
            });
        });
        
        // Close modals when clicking outside
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.addEventListener('click', function(event) {
                    if (event.target === this) {
                        closeModal(this);
                    }
                });
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
        
        // Copy Invite Code functionality
        const copyInviteCode = document.getElementById('copyInviteCode');
        if (copyInviteCode) {
            copyInviteCode.addEventListener('click', function() {
                const codeText = document.querySelector('#inviteCodeModal .text-3xl').textContent;
                navigator.clipboard.writeText(codeText).then(function() {
                    // Change button text temporarily
                    const originalText = copyInviteCode.innerHTML;
                    copyInviteCode.innerHTML = '<i class="fas fa-check mr-2"></i> Copied!';
                    copyInviteCode.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                    copyInviteCode.classList.add('bg-green-600', 'hover:bg-green-700');
                    
                    setTimeout(function() {
                        copyInviteCode.innerHTML = originalText;
                        copyInviteCode.classList.add('bg-blue-600', 'hover:bg-blue-700');
                        copyInviteCode.classList.remove('bg-green-600', 'hover:bg-green-700');
                    }, 2000);
                });
            });
        }
        
        // Close modal function
        function closeModal(modal) {
            modal.classList.add('modal-leave');
            setTimeout(function() {
                modal.classList.add('hidden');
                modal.classList.remove('modal-leave', 'modal-enter');
            }, 200);
        }
    });
</script>
@endsection