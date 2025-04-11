@extends('layouts.organisator.master')
@section('organisator.title')
    Organisator | Create Tournament
@endsection
@section('organisator-main')

<main class="relative">
    <section class="relative min-h-screen bg-cover bg-center" style="background-image: url({{ asset('images/background.png') }});">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-black/20"></div>
        
        <div class="relative z-10 container mx-auto px-4 py-16">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl font-bold text-center mb-8 text-green-500">Create New Tournament</h1>
                
                <div class="bg-gray-900/90 backdrop-blur-sm rounded-xl p-8 shadow-xl border-2 border-green-700">
                    <form id="tournamentForm" method="POST" action="{{ route('organisator.tournament.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <!-- Tournament Name -->

                        <div>
                            <label for="name" class="block text-xl font-medium text-green-400 mb-2">Tournament Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full bg-gray-800 border-2 border-gray-700 focus:border-green-500 rounded-lg py-3 px-4 text-white"
                                placeholder="Enter tournament name">
                            <span id="nameError" class="error hidden">Please enter a tournament name</span>
                            @error('name')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- Tournament Photo  --}}
                        <div>
                            <label for="photo" class="block text-xl font-medium text-green-400 mb-2">Tournament Banner</label>
                            <div class="flex flex-col space-y-4">
                                <div class="w-full h-48 bg-gray-800 border-2 border-dashed border-gray-600 rounded-lg flex items-center justify-center">
                                    <img id="photoPreview" class="max-h-full max-w-full hidden" alt="Tournament banner preview">
                                    <div id="photoPlaceholder" class="text-gray-400 text-center p-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="text-sm">SVG, PNG, JPG (max. 2MB)</p>
                                    </div>
                                </div>
                                <input type="file" id="photo" name="photo" accept="image/*" class="hidden">
                                <button type="button" id="uploadBtn" class="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-300">
                                    Select Image
                                </button>
                                @error('photo')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- <!-- Game Format --> --}}
                        <div>
                            <label for="format" class="block text-xl font-medium text-green-400 mb-2">Game Format</label>
                            <select id="format" name="format" required
                                class="w-full bg-gray-800 border-2 border-gray-700 focus:border-green-500 rounded-lg py-3 px-4 text-white appearance-none">
                                <option value="" disabled {{ old('format') ? '' : 'selected' }}>Select a game</option>
                                <option value="FC25" {{ old('format') == 'FC25' ? 'selected' : '' }}>FC25</option>
                                <option value="VALORANT" {{ old('format') == 'VALORANT' ? 'selected' : '' }}>VALORANT</option>
                                <option value="CSGO" {{ old('format') == 'CSGO' ? 'selected' : '' }}>CSGO</option>
                            </select>
                            <span id="formatError" class="error hidden">Please select a game format</span>
                            @error('format')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- <!-- Max Participants --> --}}
                        <div>
                            <label for="max_participants" class="block text-xl font-medium text-green-400 mb-2">Maximum Teams</label>
                            <input type="number" id="max_participants" name="max_participants" value="{{ old('max_participants') }}" required min="2"
                                class="w-full bg-gray-800 border-2 border-gray-700 focus:border-green-500 rounded-lg py-3 px-4 text-white"
                                placeholder="Enter maximum number of teams">
                            <span id="max_participantsError" class="error hidden">Please enter a valid number (minimum 2)</span>
                            @error('max_participants')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- <!-- Start Date and Time --> --}}
                        <div>
                            <input type="datetime-local" id="start_date" name="start_date" value="{{ old('start_date') }}" required
                            class="w-full bg-gray-800 border-2 border-gray-700 focus:border-green-500 rounded-lg py-3 px-4 text-white">
                        <span id="start_dateError" class="error hidden">Please select a valid start date and time</span>
                        @error('start_date')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                        </div>
                        
                        {{-- <!-- Reward --> --}}
                        <div>
                            <label for="reward" class="block text-xl font-medium text-green-400 mb-2">Tournament Rewards</label>
                            <textarea id="reward" name="reward" rows="4"
                                class="w-full bg-gray-800 border-2 border-gray-700 focus:border-green-500 rounded-lg py-3 px-4 text-white"
                                placeholder="Describe the tournament rewards (optional)">{{ old('reward') }}</textarea>
                            @error('reward')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- <!-- Rules --> --}}
                        <div>
                            <label for="rules" class="block text-xl font-medium text-green-400 mb-2">Tournament Rules</label>
                            <textarea id="rules" name="rules" rows="6"
                                class="w-full bg-gray-800 border-2 border-gray-700 focus:border-green-500 rounded-lg py-3 px-4 text-white"
                                placeholder="Specify the tournament rules (optional)">{{ old('rules') }}</textarea>
                            @error('rules')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        {{-- <!-- Submit Button --> --}}
                        <div class="flex justify-center pt-4">
                            <button type="submit" class="bg-green-600 text-white py-3 px-8 rounded-full text-lg font-bold hover:bg-green-700 transition duration-300 shadow-xl hover:scale-105 transform">
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
    
    // Handle file uploads
    uploadBtn.addEventListener('click', function() {
        photoInput.click();
    });
    
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
                photoPreview.src = e.target.result;
                photoPreview.classList.remove('hidden');
                photoPlaceholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Format change function
    function updateMaxTeamsLabel() {
        const format = document.getElementById('format');
        const maxTeamsLabel = document.querySelector('label[for="max_participants"]');
        const maxTeamsInput = document.getElementById('max_participants');
        
        // Check if FC25 is selected
        if (format.value === 'FC25') {
            // Change to "Maximum Participants" for FC25
            maxTeamsLabel.textContent = 'Maximum Participants';
            maxTeamsInput.placeholder = 'Enter maximum number of participants';
        } else {
            // Keep as "Maximum Teams" for other games
            maxTeamsLabel.textContent = 'Maximum Teams';
            maxTeamsInput.placeholder = 'Enter maximum number of teams';
        }
    }
    
    // Run on page load to set the correct label based on current format value
    updateMaxTeamsLabel();
    
    // Add event listener for format changes
    document.getElementById('format').addEventListener('change', function() {
        updateMaxTeamsLabel();
        
        // Hide the format error message if a value is selected
        if (this.value !== '') {
            document.getElementById('formatError').classList.add('hidden');
        }
    });
    
    // Form validation
    // form.addEventListener('submit', function(event) {
    //     event.preventDefault(); // This stops the form from submitting immediately
    //     let isValid = true;
        
        // Validate name
        const name = document.getElementById('name');
        const nameError = document.getElementById('nameError');
        if (!name.value.trim()) {
            nameError.classList.remove('hidden');
            isValid = false;
        } else {
            nameError.classList.add('hidden');
        }
        
        // Validate format
        const format = document.getElementById('format');
        const formatError = document.getElementById('formatError');
        if (format.value === '') {
            formatError.classList.remove('hidden');
            isValid = false;
        } else {
            formatError.classList.add('hidden');
        }
        
        // Validate max participants
        const maxParticipants = document.getElementById('max_participants');
        const maxParticipantsError = document.getElementById('max_participantsError');
        if (!maxParticipants.value || parseInt(maxParticipants.value) < 2) {
            maxParticipantsError.classList.remove('hidden');
            isValid = false;
        } else {
            maxParticipantsError.classList.add('hidden');
        }
        
        // Validate start time
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
            // This is the important part - actually submit the form when validation passes
            form.submit();
        }
    });
    
    // Real-time validation
    document.getElementById('name').addEventListener('input', function() {
        if (this.value.trim()) {
            document.getElementById('nameError').classList.add('hidden');
        }
    });
    
    document.getElementById('max_participants').addEventListener('input', function() {
        if (this.value && parseInt(this.value) >= 2) {
            document.getElementById('max_participantsError').classList.add('hidden');
        }
    });
    
    document.getElementById('start_date').addEventListener('input', function() {
        if (this.value) {
            document.getElementById('start_dateError').classList.add('hidden');
        }
    });
    </script>
</main>
@endsection