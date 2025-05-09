@extends('layouts.organisator.master')
@section('organisator.title')
    Organisator | Create Tournament
@endsection
@section('organisator-main')

<main class="relative">
    <section class="relative min-h-screen bg-cover bg-center" style="background-image: url({{ asset('images/background.png') }});">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-black/20"></div>
        
        <div class="relative z-10 container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl font-extrabold text-center mb-12 text-green-500">Create a Tournament</h1>
        
                <div class="bg-gray-900/90 backdrop-blur-md rounded-2xl p-10 shadow-2xl border border-green-700">
                    <form id="tournamentForm" method="POST" action="{{ route('organisator.tournament.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @csrf
        

                        <div class="col-span-1 md:col-span-2">
                            <label for="name" class="text-lg font-semibold text-green-400 mb-2 block">Tournament Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full bg-gray-800 border border-gray-600 focus:border-green-500 rounded-xl py-3 px-5 text-white transition-all duration-200"
                                placeholder="e.g. Spring Cup 2025">
                            @error('name')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
        

                        <div class="col-span-1">
                            <label for="photo" class="text-lg font-semibold text-green-400 mb-2 block">Tournament Banner</label>
                            <div class="w-full h-48 bg-gray-800 border-2 border-dashed border-gray-600 rounded-lg flex items-center justify-center relative cursor-pointer" id="dropArea">
                                <input type="file" id="photo" name="photo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                                <img id="photoPreview" class="max-h-full max-w-full hidden" alt="Preview" />
                                <div id="photoPlaceholder" class="text-gray-400 text-center p-4 pointer-events-none">
                                    <p class="text-sm">Drag & Drop or Click to Upload</p>
                                    <p class="text-xs">Supported: JPG, PNG, SVG (Max 2MB)</p>
                                </div>
                            </div>
                            @error('photo')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
        

                        <div class="col-span-1">
                            <label for="format" class="text-lg font-semibold text-green-400 mb-2 block">Select Game</label>
                            <select id="format" name="format" required
                                class="w-full bg-gray-800 border border-gray-600 focus:border-green-500 rounded-xl py-3 px-4 text-white">
                                <option value="" disabled {{ old('format') ? '' : 'selected' }}>Choose Game</option>
                                <option value="FC25" {{ old('format') == 'FC25' ? 'selected' : '' }}>FC25</option>
                                <option value="VALORANT" {{ old('format') == 'VALORANT' ? 'selected' : '' }}>VALORANT</option>
                                <option value="CSGO" {{ old('format') == 'CSGO' ? 'selected' : '' }}>CSGO</option>
                            </select>
                            @error('format')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
        

                        <div class="col-span-1">
                            <label for="team_mode" class="text-lg font-semibold text-green-400 mb-2 block">Team Mode</label>
                            <select id="team_mode" name="team_mode" required
                                class="w-full bg-gray-800 border border-gray-600 focus:border-green-500 rounded-xl py-3 px-4 text-white">
                                <option value="" disabled {{ old('team_mode') ? '' : 'selected' }}>Select mode</option>
                                <option value="2" {{ old('team_mode') == '2' ? 'selected' : '' }}>Duo</option>
                                <option value="4" {{ old('team_mode') == '4' ? 'selected' : '' }}>Squad</option>
                            </select>
                            @error('team_mode')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
        

                        <div class="col-span-1">
                            <label for="max_participants" class="text-lg font-semibold text-green-400 mb-2 block">Maximum Teams</label>
                            <select id="max_participants" name="max_participants" required
                                class="w-full bg-gray-800 border border-gray-600 focus:border-green-500 rounded-xl py-3 px-4 text-white">
                                <option value="8" {{ old('max_participants') == 8 ? 'selected' : '' }}>8</option>
                                <option value="16" {{ old('max_participants') == 16 ? 'selected' : '' }}>16</option>
                                <option value="32" {{ old('max_participants') == 32 ? 'selected' : '' }}>32</option>
                            </select>
                            @error('max_participants')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
        

                        <div class="col-span-1">
                            <label for="start_date" class="text-lg font-semibold text-green-400 mb-2 block">Start Date & Time</label>
                            <input type="datetime-local" id="start_date" name="start_date" value="{{ old('start_date') }}" required
                                class="w-full bg-gray-800 border border-gray-600 focus:border-green-500 rounded-xl py-3 px-4 text-white">
                            @error('start_date')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
        

                        <div class="col-span-1 md:col-span-2">
                            <label for="reward" class="text-lg font-semibold text-green-400 mb-2 block">Rewards (Optional)</label>
                            <textarea id="reward" name="reward" rows="3"
                                class="w-full bg-gray-800 border border-gray-600 focus:border-green-500 rounded-xl py-3 px-4 text-white"
                                placeholder="e.g. $500 prize pool, exclusive merch">{{ old('reward') }}</textarea>
                            @error('reward')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
        

                        <div class="col-span-1 md:col-span-2">
                            <label for="rules" class="text-lg font-semibold text-green-400 mb-2 block">Rules (Optional)</label>
                            <textarea id="rules" name="rules" rows="5"
                                class="w-full bg-gray-800 border border-gray-600 focus:border-green-500 rounded-xl py-3 px-4 text-white"
                                placeholder="List tournament rules or guidelines here">{{ old('rules') }}</textarea>
                            @error('rules')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
        

                        <div class="col-span-1 md:col-span-2 flex justify-center pt-6">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transform hover:scale-105 transition-all duration-300">
                                Create Tournament
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </section>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('tournamentForm');
    const uploadBtn = document.getElementById('uploadBtn');
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');
    
    // Handle file uploads and trigger preview immediately
    photoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            
            // Validate file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size exceeds 2MB. Please choose a smaller image.');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                // Display image preview
                photoPreview.src = e.target.result;
                photoPreview.classList.remove('hidden');
                photoPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Remove click event on "Select Image" button as it's no longer needed
    uploadBtn.classList.add('hidden'); // Hide the 'Select Image' button once it's redundant
    
    // Update label and placeholder based on game format (Unchanged)
    function updateMaxTeamsLabel() {
        const format = document.getElementById('format');
        const maxTeamsLabel = document.querySelector('label[for="max_participants"]');
        const maxTeamsInput = document.getElementById('max_participants');
        
        if (format.value === 'FC25') {
            maxTeamsLabel.textContent = 'Maximum Participants';
            maxTeamsInput.placeholder = 'Enter maximum number of participants';
        } else {
            maxTeamsLabel.textContent = 'Maximum Teams';
            maxTeamsInput.placeholder = 'Enter maximum number of teams';
        }
    }

    // Run on page load to set the correct label based on current format value
    updateMaxTeamsLabel();
    
    document.getElementById('format').addEventListener('change', function() {
        updateMaxTeamsLabel();
        
        // Hide format error message when a valid option is selected
        if (this.value !== '') {
            document.getElementById('formatError').classList.add('hidden');
        }
    });
    
    // Real-time validation (Unchanged)
    document.getElementById('name').addEventListener('input', function() {
        if (this.value.trim()) {
            document.getElementById('nameError').classList.add('hidden');
        }
    });
    
    document.getElementById('max_participants').addEventListener('input', function() {
        if (this.value && parseInt(this.value) == 8 || parseInt(this.value) ==16 || parseInt(this.value) == 32) {
            document.getElementById('max_participantsError').classList.add('hidden');
        }
    });
    
    document.getElementById('start_date').addEventListener('input', function() {
        if (this.value) {
            document.getElementById('start_dateError').classList.add('hidden');
        }
    });
    
    // Form validation on submit (Unchanged)
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Stops immediate submission
        let isValid = true;
        
        // Validate name (Unchanged)
        const name = document.getElementById('name');
        const nameError = document.getElementById('nameError');
        if (!name.value.trim()) {
            nameError.classList.remove('hidden');
            isValid = false;
        } else {
            nameError.classList.add('hidden');
        }
        
        // Validate format (Unchanged)
        const format = document.getElementById('format');
        const formatError = document.getElementById('formatError');
        if (format.value === '') {
            formatError.classList.remove('hidden');
            isValid = false;
        } else {
            formatError.classList.add('hidden');
        }
        
        // Validate max participants (Unchanged)
        const maxParticipants = document.getElementById('max_participants');
        const maxParticipantsError = document.getElementById('max_participantsError');
        if (!maxParticipants.value || parseInt(maxParticipants.value) != 8 || parseInt(maxParticipants.value) != 16 || parseInt(maxParticipants.value) != 32) {
            maxParticipantsError.classList.remove('hidden');
            isValid = false;
        } else {
            maxParticipantsError.classList.add('hidden');
        }
        
        // Validate start time (Unchanged)
        const startTime = document.getElementById('start_date');
        const startTimeError = document.getElementById('start_dateError');
        if (!startTime.value) {
            startTimeError.classList.remove('hidden');
            isValid = false;
        } else {
            startTimeError.classList.add('hidden');
        }
        
        // If form is valid, submit it
        if (isValid) {
            form.submit();
        }
    });
});

    </script>
</main>
@endsection