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
                <p class="text-gray-400 mt-2">Welcome back, {{ auth()->user()->name }}</p>
            </div>  
            <div class="mt-4 md:mt-0">
                <a href="{{route('organisator.createmytournament')}}">
                <button type="button"  class="btn-primary flex items-center" data-modal-target="createTournamentModal" data-modal-toggle="createTournamentModal">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Create New Tournament
                </button>
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
                            <h3 class="text-2xl font-bold text-white mt-1">{{ $tournaments->count() }}</h3>
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
                            <h3 class="text-2xl font-bold text-white mt-1">{{ $tournaments->where('status', 'ongoing')->count() }}</h3>
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
                            <p class="text-gray-400 text-sm">Steel Not Validated</p>
                            <h3 class="text-2xl font-bold text-white mt-1">{{ $tournaments->where('is_validated', 0)->count() }}</h3>
                        </div>
                        <div class="bg-purple-900/50 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                            <i class="fas fa-users text-purple-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tournament List Section -->
        <div class="card mb-8">
            <div class="card-header flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">My Tournaments</h3>
            </div>
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-800 rounded-lg overflow-hidden">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Format</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Max Participants</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Start Date</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-700">                                
                           @forelse($tournaments as $tournament)
                            <tr class="hover:bg-gray-750">
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($tournament->photo)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $tournament->photo) }}" alt="{{ $tournament->name }}">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gray-600 flex items-center justify-center">
                                                    <i class="fas fa-trophy text-gray-400"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white">{{ $tournament->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($tournament->format == 'FC25') bg-blue-800 text-blue-100
                                        @elseif($tournament->format == 'VALORANT') bg-red-800 text-red-100
                                        @elseif($tournament->format == 'CSGO') bg-yellow-800 text-yellow-100
                                        @else bg-green-800 text-green-100 @endif">
                                        {{ $tournament->format }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $tournament->max_participants }}
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($tournament->status == 'upcoming') bg-yellow-800 text-yellow-100
                                        @elseif($tournament->status == 'ongoing') bg-green-800 text-green-100
                                        @else bg-gray-600 text-gray-100 @endif">
                                        {{ ucfirst($tournament->status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $tournament->start_date ? date('M d, Y', strtotime($tournament->start_date)) : 'Not set' }}
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                    @if ($tournament->status == 'upcoming' && $tournament->particpated_teams == 0)
                                        <button type="button" 
                                            class="text-blue-400 hover:text-blue-300 mr-3" 
                                            data-modal-target="updateTournamentModal" 
                                            data-modal-toggle="updateTournamentModal"
                                            data-tournament-id="{{ $tournament->id }}"
                                            data-tournament-name="{{ $tournament->name }}"
                                            data-tournament-format="{{ $tournament->format }}"
                                            data-tournament-max-participants="{{ $tournament->max_participants }}"
                                            data-tournament-reward="{{ $tournament->reward }}"
                                            data-tournament-rules="{{ $tournament->rules }}"
                                            data-tournament-start-date="{{ $tournament->start_date ? date('Y-m-d\TH:i', strtotime($tournament->start_date)) : '' }}"
                                            onclick="populateUpdateForm(this)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif
                                    <button type="button" 
                                        class="text-red-400 hover:text-red-300" 
                                        data-modal-target="deleteTournamentModal" 
                                        data-modal-toggle="deleteTournamentModal"
                                        data-tournament-id="{{ $tournament->id }}"
                                        data-tournament-name="{{ $tournament->name }}"
                                        onclick="confirmDelete(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center text-gray-400">
                                    No tournaments found. Create your first tournament now!
                                </td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Update Tournament Modal -->
<div id="updateTournamentModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-gray-800 rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700 rounded-t">
                <h3 class="text-xl font-semibold text-white">Update Tournament</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="updateTournamentModal">
                    <i class="fas fa-times"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="updateTournamentForm" method="POST" action="{{route('organisator.tournament.edit')}}" enctype="multipart/form-data" class="validate-form">
                @csrf
                @method('PUT')
                @if (count($tournaments) > 0)

                    <input type="hidden" id="update_tournament_id" name="tournament_id" value={{$tournament->id}}>   

                @endif
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label for="update_name" class="block mb-2 text-sm font-medium text-white">Tournament Name</label>
                            <input type="text" id="update_name" name="name" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <p class="error-message text-red-500 text-xs mt-1 hidden"></p>
                        </div>
                        <div>
                            <label for="update_format" class="block mb-2 text-sm font-medium text-white">Format</label>
                            <select id="update_format" name="format" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="FC25">FC25</option>
                                <option value="VALORANT">VALORANT</option>
                                <option value="CSGO">CSGO</option>
                                <option value="eFOOTBALL">eFOOTBALL</option>
                            </select>
                            <p class="error-message text-red-500 text-xs mt-1 hidden"></p>
                        </div>
                        <div>
                            <label for="update_max_participants" class="block mb-2 text-sm font-medium text-white">Max Participants</label>
                            <select id="update_max_participants" name="max_participants" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="8">8</option>
                                <option value="16">16</option>
                                <option value="32">32</option>
                            </select>
                            <p class="error-message text-red-500 text-xs mt-1 hidden"></p>
                        </div>

                        <div>
                            <label for="update_start_date" class="block mb-2 text-sm font-medium text-white">Start Date</label>
                            <input type="datetime-local" id="update_start_date" name="start_date" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <p class="error-message text-red-500 text-xs mt-1 hidden"></p>
                        </div>
                        <div class="col-span-2">
                            <label for="update_photo" class="block mb-2 text-sm font-medium text-white">Tournament Photo</label>
                            <input type="file" id="update_photo" name="photo" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 file:bg-gray-600 file:text-white file:border-0 file:rounded file:px-4 file:py-2 file:mr-4">
                            <p class="text-gray-400 text-xs mt-1">Leave empty to keep current photo. Recommended size: 800x600px, Max: 2MB</p>
                            <p class="error-message text-red-500 text-xs mt-1 hidden"></p>
                        </div>
                        <div class="col-span-2">
                            <label for="update_reward" class="block mb-2 text-sm font-medium text-white">Reward</label>
                            <textarea id="update_reward" name="reward" rows="3" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                            <p class="error-message text-red-500 text-xs mt-1 hidden"></p>
                        </div>
                        <div class="col-span-2">
                            <label for="update_rules" class="block mb-2 text-sm font-medium text-white">Rules</label>
                            <textarea id="update_rules" name="rules" rows="4" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                            <p class="error-message text-red-500 text-xs mt-1 hidden"></p>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-700 rounded-b">
                    <button type="button" class="text-gray-300 bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-600 rounded-lg border border-gray-600 text-sm font-medium px-5 py-2.5" data-modal-hide="updateTournamentModal">Cancel</button>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Update Tournament</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Tournament Modal -->
<div id="deleteTournamentModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-gray-800 rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700 rounded-t">
                <h3 class="text-xl font-semibold text-white">Delete Tournament</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="deleteTournamentModal">
                    <i class="fas fa-times"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-300">Are you sure you want to delete <span id="delete_tournament_name" class="font-semibold"></span>?</h3>
                <p class="mb-4 text-sm text-gray-400">This action cannot be undone. All data related to this tournament will be permanently deleted.</p>
                <form id="deleteTournamentForm" action="{{route('organisator.tournament.delete')}}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if (count($tournaments) > 0)
                        <input type="hidden" id="delete_tournament_id" name="tournament_id" value={{$tournament->id}}>   
                    @endif
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, delete it
                    </button>
                    <button type="button" class="text-gray-300 bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-600 rounded-lg border border-gray-600 text-sm font-medium px-5 py-2.5" data-modal-hide="deleteTournamentModal">Cancel</button>
                </form>
            </div>
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


@endsection


@push('organisator-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation
        const forms = document.querySelectorAll('.validate-form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Reset previous errors
                form.querySelectorAll('.error-message').forEach(msg => {
                    msg.textContent = '';
                    msg.classList.add('hidden');
                });
                
                // Perform validation
                let isValid = true;
                
                // Name validation
                const nameInput = form.querySelector('[name="name"]');
                if (nameInput && nameInput.value.trim() === '') {
                    showError(nameInput, 'Tournament name is required');
                    isValid = false;
                } else if (nameInput && nameInput.value.trim().length < 3) {
                    showError(nameInput, 'Tournament name must be at least 3 characters');
                    isValid = false;
                }
                
                // Format validation
                const formatInput = form.querySelector('[name="format"]');
                if (formatInput && (!formatInput.value || formatInput.value === '')) {
                    showError(formatInput, 'Please select a tournament format');
                    isValid = false;
                }
                
                // Max participants validation
                const maxParticipantsInput = form.querySelector('[name="max_participants"]');
                if (maxParticipantsInput && (!maxParticipantsInput.value || maxParticipantsInput.value === '')) {
                    showError(maxParticipantsInput, 'Please select max participants');
                    isValid = false;
                }
                
                // Start date validation
                const startDateInput = form.querySelector('[name="start_date"]');
                if (startDateInput && (!startDateInput.value || startDateInput.value === '')) {
                    showError(startDateInput, 'Start date is required');
                    isValid = false;
                }
                
                // Photo validation (only for new uploads)
                const photoInput = form.querySelector('[name="photo"]');
                if (photoInput && photoInput.files.length > 0) {
                    const file = photoInput.files[0];
                    const fileType = file.type;
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    
                    if (!validTypes.includes(fileType)) {
                        showError(photoInput, 'Photo must be a valid image (JPEG, PNG)');
                        isValid = false;
                    } else if (file.size > 2 * 1024 * 1024) { // 2MB
                        showError(photoInput, 'Photo size cannot exceed 2MB');
                        isValid = false;
                    }
                }
                
                // If form is valid, submit it
                if (isValid) {
                    // For update form, set the proper action URL
                    if (form.id === 'updateTournamentForm') {
                        const tournamentId = document.getElementById('update_tournament_id').value;
                        form.action = `/organisator/tournaments/${tournamentId}`;
                    }
                    
                    form.submit();
                }
            });
        });
        
        function showError(element, message) {
            const errorElement = element.nextElementSibling;
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        }
    });
    
    // Populate update form with tournament data
    function populateUpdateForm(button) {
        const tournamentId = button.getAttribute('data-tournament-id');
        const name = button.getAttribute('data-tournament-name');
        const format = button.getAttribute('data-tournament-format');
        const maxParticipants = button.getAttribute('data-tournament-max-participants');
        const reward = button.getAttribute('data-tournament-reward');
        const rules = button.getAttribute('data-tournament-rules');
        const status = button.getAttribute('data-tournament-status');
        const startDate = button.getAttribute('data-tournament-start-date');
        
        // Set form values
        document.getElementById('update_tournament_id').value = tournamentId;
        document.getElementById('update_name').value = name;
        document.getElementById('update_format').value = format;
        document.getElementById('update_max_participants').value = maxParticipants;
        document.getElementById('update_reward').value = reward;
        document.getElementById('update_rules').value = rules;
        document.getElementById('update_status').value = status;
        document.getElementById('update_start_date').value = startDate;
        
        // Set form action dynamically
        document.getElementById('updateTournamentForm').action = `/organisator/tournaments/${tournamentId}`;
    }
    
    // Confirm delete
    function confirmDelete(button) {
        const tournamentId = button.getAttribute('data-tournament-id');
        const tournamentName = button.getAttribute('data-tournament-name');
        
        document.getElementById('delete_tournament_id').value = tournamentId;
        document.getElementById('delete_tournament_name').textContent = tournamentName;
        document.getElementById('deleteTournamentForm').action = `/organisator/tournaments/${tournamentId}`;
    }
</script>
@endpush