<header class="bg-blue-800/90 backdrop-blur-sm p-4 shadow-lg fixed w-full top-0 z-50">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center mb-4 md:mb-0">
            <img src="{{ asset('images/logo.png') }}" alt="YouChallenge Logo" class="h-10 w-auto mr-3">
            <span class="text-2xl font-bold text-white">YouChallenge</span>
        </div>
        <nav>
            <ul class="flex flex-wrap space-x-2 md:space-x-4 items-center">
                <li><a href="{{ route('participant.home') }}" class="text-white hover:text-blue-300 transition duration-300 px-2 py-1">Home</a></li>
                <li><a href="{{route('participant.tournaments')}}" class="text-white hover:text-blue-300 transition duration-300 px-2 py-1">Tournaments</a></li>
                <li><a href="" class="text-white hover:text-blue-300 transition duration-300 px-2 py-1">Matches</a></li>
                <li><a href="" class="text-white hover:text-blue-300 transition duration-300 px-2 py-1">Profile</a></li>
                <li>
                    <a href="{{ route('logout') }}" class="text-white hover:text-blue-200 flex items-center bg-blue-900 px-3 py-2 rounded-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>