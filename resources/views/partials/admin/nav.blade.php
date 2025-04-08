   
   
   <header class="bg-gradient-to-r from-green-600 to-green-800 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-white p-2 rounded-full">
                    <img src="{{ asset('images/logo.png', true) }}" alt="YouChallenge Logo" class="h-8 w-8 rounded-full">
                </div>
                <h1 class="text-3xl font-bold text-white">YouChallenge</h1>
                <span class="text-green-200 text-sm bg-green-900 px-3 py-1 rounded-full">Admin Portal</span>
            </div>
            <nav>
                <ul class="flex items-center space-x-6">
                    <li><a class="text-white hover:text-green-200 flex items-center" href="#"><i class="fas fa-home mr-2"></i>Home</a></li>
                    <li><a class="text-white hover:text-green-200 flex items-center" href="#"><i class="fas fa-user mr-2"></i>Profile</a></li>
                    <li><a class="text-white hover:text-green-200 flex items-center bg-green-900 px-3 py-2 rounded-lg" href="{{route('logout')}}"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>