@extends('layouts.organisator.master')
   @section('organisator.title')
       Organisator|Home 
   @endsection
   @section('organisator-main')

    <main class="relative">
        <section class="relative h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url({{ asset('images/backgroundimg.jpg') }});">
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <div class="relative z-10 text-center px-4">
                <h2 class="text-5xl font-bold mb-6 text-white drop-shadow-lg">Tournament Organizer Hub</h2>
                <p class="text-xl mb-8 text-gray-200 max-w-2xl mx-auto">
                    Streamline your tournament management, track participants, and create unforgettable gaming experiences.
                </p>
                <a href="{{route('organisator.createmytournament')}}" class="bg-green-600 text-white py-3 px-6 rounded-full text-lg hover:bg-green-700 transition duration-300 inline-block shadow-xl hover:scale-105 transform">
                    Create New Tournament
                </a>
            </div>
        </section>

        <section class="bg-gray-900 py-20 px-4">
            <div class="container mx-auto">
                <h2 class="text-4xl font-bold text-center mb-12 text-green-500">Quick Actions</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gray-800 p-8 rounded-xl border-2 border-green-700 hover:bg-gray-700 transition duration-300">
                        <div class="text-green-500 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-white">Upcoming Tournaments</h3>
                        <p class="text-gray-300">Manage and overview your scheduled tournaments.</p>
                        <a href="" class="mt-4 text-green-400 hover:text-green-300 inline-block">View Tournaments →</a>
                    </div>
                    <div class="bg-gray-800 p-8 rounded-xl border-2 border-green-700 hover:bg-gray-700 transition duration-300">
                        <div class="text-green-500 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-white">Participant Management</h3>
                        <p class="text-gray-300">Track and manage tournament participants easily.</p>
                        <a href="" class="mt-4 text-green-400 hover:text-green-300 inline-block">Manage Participants →</a>
                    </div>
                    <div class="bg-gray-800 p-8 rounded-xl border-2 border-green-700 hover:bg-gray-700 transition duration-300">
                        <div class="text-green-500 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3a8 8 0 0 1 8 8v4a4 4 0 0 1-4 4h-4a8 8 0 0 1-8-8v-4a4 4 0 0 1 4-4Z"/>
                                <path d="M12 11v6"/>
                                <line x1="8" x2="16" y1="15" y2="15"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-white">Create New Tournament</h3>
                        <p class="text-gray-300">Start a new tournament with our easy-to-use platform.</p>
                        <a href="" class="mt-4 text-green-400 hover:text-green-300 inline-block">Create Tournament →</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-gray-800 py-20 px-4">
            <div class="container mx-auto">
                <h2 class="text-4xl font-bold text-center mb-12 text-green-500">Recent Activity</h2>
                <div class="max-w-4xl mx-auto bg-gray-900 rounded-xl p-8 shadow-xl">
                    <div class="space-y-6">
                        <div class="bg-gray-800 p-4 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-green-400 font-bold">CS:GO Tournament</span>
                                <span class="text-gray-400">Started 2 days ago</span>
                            </div>
                            <p class="text-gray-300 mt-2">64 participants registered, 16 teams confirmed</p>
                        </div>
                        <div class="bg-gray-800 p-4 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-green-400 font-bold">League of Legends Cup</span>
                                <span class="text-gray-400">Upcoming next week</span>
                            </div>
                            <p class="text-gray-300 mt-2">32 participants registered, bracket generation in progress</p>
                        </div>
                        <div class="bg-gray-800 p-4 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-green-400 font-bold">Valorant Invitational</span>
                                <span class="text-gray-400">Completed 5 days ago</span>
                            </div>
                            <p class="text-gray-300 mt-2">Prize distribution completed, winner interviews published</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

           
   @endsection 