@extends('layouts.participant.master')
@section('participant.title')
    Participant|Home 
@endsection
@section('participant-main')

<main class="relative">
    <section class="relative h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url({{ asset('images/backgroundimg.jpg') }});">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 text-center px-4">
            <h2 class="text-5xl font-bold mb-6 text-white drop-shadow-lg">Tournament Participant Hub</h2>
            <p class="text-xl mb-8 text-gray-200 max-w-2xl mx-auto">
                Discover gaming tournaments, join competitions, and track your performance all in one place.
            </p>
            <a href="{{route('participant.tournaments')}}" class="bg-blue-600 text-white py-3 px-6 rounded-full text-lg hover:bg-blue-700 transition duration-300 inline-block shadow-xl hover:scale-105 transform">
                Browse Tournaments
            </a>
        </div>
    </section>

    <section class="bg-gray-900 py-20 px-4">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12 text-blue-500">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-800 p-8 rounded-xl border-2 border-blue-700 hover:bg-gray-700 transition duration-300">
                    <div class="text-blue-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-white">My Tournaments</h3>
                    <p class="text-gray-300">View all tournaments you've registered for.</p>
                    <a href="{{route('participant.mytournaments')}}" class="mt-4 text-blue-400 hover:text-blue-300 inline-block">View My Tournaments →</a>
                </div>
                <div class="bg-gray-800 p-8 rounded-xl border-2 border-blue-700 hover:bg-gray-700 transition duration-300">
                    <div class="text-blue-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-white">Upcoming Matches</h3>
                    <p class="text-gray-300">Check your schedule and upcoming matches.</p>
                    <a href="#" class="mt-4 text-blue-400 hover:text-blue-300 inline-block">View Schedule →</a>
                </div>
                <div class="bg-gray-800 p-8 rounded-xl border-2 border-blue-700 hover:bg-gray-700 transition duration-300">
                    <div class="text-blue-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-white">Tournament Results</h3>
                    <p class="text-gray-300">View your performance and tournament history.</p>
                    <a href="#" class="mt-4 text-blue-400 hover:text-blue-300 inline-block">Check Results →</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-800 py-20 px-4">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12 text-blue-500">Featured Tournaments</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition duration-300">
                    <div class="h-48 bg-cover bg-center" style="background-image: url({{ asset('images/csgo-tournament.jpg') }})"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-blue-400 font-bold text-lg">CS:GO Championship</span>
                            <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded">5v5</span>
                        </div>
                        <p class="text-gray-300 mb-4">Competitive tournament for CS:GO teams with prize pool of $5,000</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Starts in 3 days</span>
                            <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Register</a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition duration-300">
                    <div class="h-48 bg-cover bg-center" style="background-image: url({{ asset('images/lol-tournament.jpg') }})"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-blue-400 font-bold text-lg">League of Legends Cup</span>
                            <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded">Team</span>
                        </div>
                        <p class="text-gray-300 mb-4">Regional LoL tournament with exciting rewards and live streaming</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Starts next week</span>
                            <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Register</a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition duration-300">
                    <div class="h-48 bg-cover bg-center" style="background-image: url({{ asset('images/valorant-tournament.jpg') }})"></div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-blue-400 font-bold text-lg">Valorant Invitational</span>
                            <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded">5v5</span>
                        </div>
                        <p class="text-gray-300 mb-4">Exclusive Valorant tournament for top teams with $10,000 prize pool</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Registration closing soon</span>
                            <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-10">
                <a href="{{route('participant.tournaments')}}" class="text-blue-400 hover:text-blue-300 inline-flex items-center">
                    View All Tournaments
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section class="bg-gray-900 py-20 px-4">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12 text-blue-500">Your Activity</h2>
            <div class="max-w-4xl mx-auto bg-gray-800 rounded-xl p-8 shadow-xl">
                <div class="space-y-6">
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="text-blue-400 font-bold">CS:GO Tournament</span>
                            <span class="text-gray-400">Match scheduled tomorrow, 18:00</span>
                        </div>
                        <p class="text-gray-300 mt-2">Quarterfinals match against Team Phoenix</p>
                        <div class="mt-3">
                            <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">View Match Details →</a>
                        </div>
                    </div>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="text-blue-400 font-bold">League of Legends Cup</span>
                            <span class="text-gray-400">Registration confirmed</span>
                        </div>
                        <p class="text-gray-300 mt-2">Tournament starts next week. Team check-in required 1 hour before first match.</p>
                        <div class="mt-3">
                            <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">View Tournament Details →</a>
                        </div>
                    </div>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="text-blue-400 font-bold">Valorant Community Cup</span>
                            <span class="text-gray-400 bg-green-900/50 px-2 py-1 rounded text-green-300 text-xs">Victory</span>
                        </div>
                        <p class="text-gray-300 mt-2">Congratulations! Your team won the last match 13-7.</p>
                        <div class="mt-3">
                            <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">See Match Results →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
        
@endsection