<!-- Header Component -->
<header class="bg-green-800/90 backdrop-blur-sm p-4 shadow-lg fixed w-full top-0 z-50">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center mb-4 md:mb-0">
            <img src="{{ asset('images/logo.png') }}" alt="YouChallenge Logo" class="h-10 w-auto mr-3">
            <span class="text-2xl font-bold text-white">YouChallenge</span>
        </div>
        <nav>
            <ul class="flex flex-wrap space-x-2 md:space-x-4 items-center">
                <li><a href="{{route('organisator.home')}}" class="text-white hover:text-green-300 transition duration-300 px-2 py-1">Home</a></li>
                <li><a href="{{route('organisator.dashboard')}}" class="text-white hover:text-green-300 transition duration-300 px-2 py-1">Dashboard</a></li>
                <li><a href="" class="text-white hover:text-green-300 transition duration-300 px-2 py-1">Manage Tournaments</a></li>
                <li><a href="" class="text-white hover:text-green-300 transition duration-300 px-2 py-1">Create Tournament</a></li>
                <li><a href="" class="text-white hover:text-green-300 transition duration-300 px-2 py-1">Profile</a></li>
                <li>
                    <a class="text-white hover:text-green-200 flex items-center bg-green-900 px-3 py-2 rounded-lg" href="{{route('logout')}}">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>