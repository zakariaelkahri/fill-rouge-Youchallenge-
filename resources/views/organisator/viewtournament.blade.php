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
                                        16/{{ $tournament->max_participants }} Participants
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-2">
                                <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit
                                </a>
                                @if(strtolower($tournament->status) == 'upcoming')
                                <form action="#" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 w-full">
                                        <i class="fas fa-play mr-2"></i>
                                        Start Tournament
                                    </button>
                                </form>
                                @elseif(strtolower($tournament->status) == 'ongoing')
                                <form action="#" method="POST">
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
                        <span class="text-sm text-gray-400">{{ $tournament->max_participants }}/16</span>
                    </div>
                    
                    <div class="space-y-3">
                        <!-- Progress bar -->
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            @php
                                $participantPercentage = min(100, (16 / $tournament->max_participants) * 100);
                            @endphp
                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $participantPercentage }}%"></div>
                        </div>
                        
                        <!-- Participant list -->
                        <div class="divide-y divide-gray-700">
                            @for ($i = 1; $i <= 5; $i++)
                            <div class="flex items-center py-3">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full overflow-hidden">
                                    <img src="/placeholder/avatar{{ $i }}.jpg" alt="Participant {{ $i }}" class="w-full h-full object-cover">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-white">Team {{ $i }}</p>
                                </div>
                            </div>
                            @endfor
                            
                            @if(16 > 5)
                            <div class="text-center py-2">
                                <button class="text-indigo-400 hover:text-indigo-300 text-sm">
                                    View all participants
                                </button>
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
                            <div class="absolute left-0 top-1 rounded-full h-8 w-8 flex items-center justify-center bg-indigo-900 text-indigo-300">
                                <i class="fas fa-flag"></i>
                            </div>
                            <h3 class="text-md font-semibold text-white">Tournament Starts</h3>
                            <p class="text-sm text-gray-400">{{ date('M d, Y', strtotime($tournament->start_date)) }}</p>
                        </div>
                        
                        <div class="relative pl-10">
                            <div class="absolute left-0 top-1 rounded-full h-8 w-8 flex items-center justify-center bg-gray-700 text-gray-400">
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
</style>
@endsection