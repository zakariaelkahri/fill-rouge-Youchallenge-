@extends('layouts.participant.master')

@section('participant.title')
    {{ $tournament->name }}
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
                            <span class="bg-green-600 text-white text-sm px-3 py-1 rounded-full">Live Now</span>
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
                    @if($tournament->status == 'upcoming' && !$tournament->isParticipating(auth()->user()->id) && $tournament->current_participants < $tournament->max_participants)
                        <div class="flex space-x-3 ml-4">
                            <button id="createTeamBtn" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200">
                                <i class="fas fa-users-cog mr-2"></i> Create Team
                            </button>
                            @if (!$tournament->isParticipating(auth()->user()->id) && count($teams) > 0)
                                <button id="joinTeamBtn" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition duration-200">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Join Team
                                </button>
                            @endif
        
                        </div>
                    @endif
                </div>
                
                <!-- Tournament Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Prize Information -->
                    <div>
                        <h2 class="text-xl font-bold text-white mb-3">Prize</h2>
                        <div class="bg-gray-700/50 rounded-lg p-4 text-gray-300">
                            {{ $tournament->reward }}
                        </div>
                    </div>
                    
                    <!-- Tournament Rules Summary -->
                    <div class="md:col-span-2">
                        <h2 class="text-xl font-bold text-white mb-3">Rules</h2>
                        <div class="bg-gray-700/50 rounded-lg p-4 text-gray-300 prose prose-invert max-w-none">
                            {!! $tournament->rules !!}
                        </div>
                    </div>
                </div>
                
                <!-- Match Schedule Section -->
<!-- Simplified Match Schedule Section -->
                @if($tournament->status == 'ongoing' || $tournament->status == 'completed')
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-white mb-4">Matches</h2>
                        <div class="overflow-hidden bg-gray-700/50 rounded-xl">
                            <div class="divide-y divide-gray-700">
                                <!-- Simple Team vs Team rows -->
                                @for($i = 1; $i <= 4; $i++)
                                <div class="p-4 hover:bg-gray-700 transition duration-200">
                                    <div class="flex items-center justify-between">
                                        <!-- Left Team -->
                                        <div class="flex items-center w-2/5">
                                            <div class="h-10 w-10 bg-gray-600 rounded-full mr-3 flex-shrink-0"></div>
                                            <div class="font-medium text-white">Team Alpha</div>
                                        </div>
                                        
                                        <!-- VS -->
                                        <div class="text-center px-4">
                                            <span class="text-lg font-bold text-gray-400">VS</span>
                                        </div>
                                        
                                        <!-- Right Team -->
                                        <div class="flex items-center justify-end w-2/5">
                                            <div class="font-medium text-white text-right">Team Omega</div>
                                            <div class="h-10 w-10 bg-gray-600 rounded-full ml-3 flex-shrink-0"></div>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Registered Teams -->
        <div class="bg-gray-800 rounded-xl p-6 mb-8">

            <h2 class="text-2xl font-bold text-white mb-4">Registered Teams ({{ $tournament->particpated_teams }}/{{ $tournament->max_participants }})</h2>
            
            @if(count($teams) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($teams as $team)
                        <div class="bg-gray-700 rounded-lg p-4 flex items-center">
                            <div class="h-12 w-12 rounded-full bg-gray-600 mr-4 flex-shrink-0">
                                <img src="{{ $team->getPhotoUrl() ?? asset('images/default.png') }}" alt="{{ $team->name }}" class="h-full w-full object-cover rounded-full">
                            </div>
                            <div>
                                <div class="text-white font-medium">{{ $team->name }}</div>
                                <div class="text-xs text-gray-400">Captain: {{ $team->getTeamCaptainName() }}    <br> Member : {{  $team->participated_members.'/'.$tournament->team_mode }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">No teams have registered yet. Be the first!</p>
            @endif
        </div>
        
        <!-- Tournament Bracket (for ongoing or completed tournaments) -->
        @if($tournament->status == 'ongoing' || $tournament->status == 'completed')
            <div class="bg-gray-800 rounded-xl p-6">
                <h2 class="text-2xl font-bold text-white mb-4">Tournament Bracket</h2>
                <div class="bg-gray-700/50 rounded-lg p-4 h-96 flex items-center justify-center">
                    <p class="text-gray-400">Tournament bracket visualization will be displayed here.</p>
                </div>
            </div>
        @endif
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get modal elements
        const createTeamModal = document.getElementById('createTeamModal');
        const joinTeamModal = document.getElementById('joinTeamModal');
        
        // Get buttons
        const createTeamBtn = document.getElementById('createTeamBtn');
        const joinTeamBtn = document.getElementById('joinTeamBtn');
        
        // Get close buttons
        const closeButtons = document.querySelectorAll('.closeModal');
        
        // Open Create Team Modal
        if (createTeamBtn) {
            createTeamBtn.addEventListener('click', function() {
                createTeamModal.classList.remove('hidden');
                createTeamModal.classList.add('modal-enter');
            });
        }
        
        // Open Join Team Modal
        if (joinTeamBtn) {
            joinTeamBtn.addEventListener('click', function() {
                joinTeamModal.classList.remove('hidden');
                joinTeamModal.classList.add('modal-enter');
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
        
        // Close modals when clicking close button
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modal = this.closest('[id$="Modal"]');
                closeModal(modal);
            });
        });
        
        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === createTeamModal) {
                closeModal(createTeamModal);
            }
            if (event.target === joinTeamModal) {
                closeModal(joinTeamModal);
            }
        });
        
        // Prevent closing when clicking inside modal content
        document.querySelectorAll('#createTeamModal > div, #joinTeamModal > div').forEach(modalContent => {
            modalContent.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    });



</script>

@endsection