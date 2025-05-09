<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Registration</title>

</head>
<body class="bg-green-50 flex flex-col min-h-screen">

    <nav class="bg-green-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('accueil') }}">
                            <button>                       
                                <i class="fas fa-trophy text-yellow-300 text-2xl mr-2"></i>
                                <span class="font-bold text-xl">Tournament Hub</span>
                            </button>
                        </a>
                    </div>
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="{{ route('accueil') }}" class="border-b-2 border-transparent hover:border-white text-white px-3 py-2 text-sm font-medium">Home</a>
                        <a href="#" class="border-b-2 border-transparent hover:border-white text-white px-3 py-2 text-sm font-medium">Tournaments</a>
                        <a href="#" class="border-b-2 border-transparent hover:border-white text-white px-3 py-2 text-sm font-medium">Leaderboard</a>
                        <a href="#" class="border-b-2 border-transparent hover:border-white text-white px-3 py-2 text-sm font-medium">About</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center">
                    <a href="{{ route('showregisterform') }}" class="bg-white text-green-700 hover:bg-green-100 px-4 py-2 rounded-md text-sm font-medium">Register</a>
                    <a href="{{ route('showloginform') }}" class="ml-4 text-white hover:bg-green-600 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                </div>

                <div class="flex items-center md:hidden">
                    <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-green-600 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
        

        <div class="hidden mobile-menu md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-green-600">Home</a>
                <a href="#" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-green-600">Tournaments</a>
                <a href="#" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-green-600">Leaderboard</a>
                <a href="#" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-green-600">About</a>
                <a href="{{ route('showregisterform') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-green-600">Register</a>
                <a href="{{ route('showloginform') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-green-600">Login</a>
            </div>
        </div>
    </nav>


    <div class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md border-2 border-green-600">
            <div class="flex justify-center mb-6">
                <div class="rounded-full bg-green-100 p-3">
                    <i class="fas fa-user-plus text-3xl text-green-700"></i>
                </div>
            </div>
            <h2 class="text-3xl font-bold mb-6 text-center text-green-700">Join Tournament Hub</h2>


            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">



                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-green-700">Select Role</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-users-cog text-green-500"></i>
                        </div>
                        <select
                            id="role" 
                            name="role"
                            class="pl-10 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white"
                            required
                        >
                            <option value="" selected disabled>Select your role</option>
                            <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Organizer</option>
                            <option value="3" {{ old('role') == '3' ? 'selected' : '' }}>Participant</option>
                        </select>
                    </div>
                </div>
                

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-green-700">Full Name</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-green-500"></i>
                        </div>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="John Doe"
                            class="pl-10 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            required
                        />
                    </div>
                </div>


                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-green-700">Email Address</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-green-500"></i>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="john.doe@example.com"
                            class="pl-10 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            required
                        />
                    </div>
                </div>


                <div class="mb-4">
                    <label for="photo" class="block text-sm font-medium text-green-700">Profile Photo</label>
                    <div class="mt-1 relative">
                        <div class="flex items-center">
                            <label for="photo" class="cursor-pointer bg-green-50 px-3 py-2 border border-green-300 rounded-md text-sm text-green-700 hover:bg-green-100 transition duration-150 flex items-center">
                                <i class="fas fa-camera mr-2"></i> Choose a photo
                                <input
                                    type="file"
                                    id="photo"
                                    name="photo"
                                    accept="image/*"
                                    class="sr-only"
                                />
                            </label>
                            <span class="ml-3 text-sm text-gray-500 file-name">No file chosen</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Upload a profile photo (optional)</p>
                        @error('photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-green-700">Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-green-500"></i>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            class="pl-10 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            required
                        />
                    </div>
                </div>


                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-green-700">Confirm Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-green-500"></i>
                        </div>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Confirm your password"
                            class="pl-10 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            required
                        />
                    </div>
                </div>


                <button
                    type="submit"
                    class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-300 flex items-center justify-center"
                >
                    <i class="fas fa-user-plus mr-2"></i>
                    Register
                </button>


                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('showloginform') }}" class="text-green-600 hover:text-green-800 font-medium">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>


    <footer class="bg-green-700 text-white">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-trophy text-yellow-300 text-2xl mr-2"></i>
                        <span class="font-bold text-xl">Tournament Hub</span>
                    </div>
                    <p class="text-green-100 text-sm">
                        Your ultimate platform for organizing and participating in gaming tournaments.
                        Join competitions, track your progress, and rise to the top of the leaderboard.
                    </p>
                </div>
                

                <div>
                    <h3 class="font-semibold text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-green-100">
                        <li><a href="#" class="hover:text-white"><i class="fas fa-chevron-right text-xs mr-2"></i>Home</a></li>
                        <li><a href="#" class="hover:text-white"><i class="fas fa-chevron-right text-xs mr-2"></i>Tournaments</a></li>
                        <li><a href="#" class="hover:text-white"><i class="fas fa-chevron-right text-xs mr-2"></i>Leaderboard</a></li>
                        <li><a href="#" class="hover:text-white"><i class="fas fa-chevron-right text-xs mr-2"></i>Rules & Guidelines</a></li>
                    </ul>
                </div>
                

                <div>
                    <h3 class="font-semibold text-lg mb-4">Contact Us</h3>
                    <ul class="space-y-2 text-green-100">
                        <li class="flex items-center"><i class="fas fa-envelope w-5 text-center mr-2"></i> support@tournamenthub.com</li>
                        <li class="flex items-center"><i class="fas fa-phone w-5 text-center mr-2"></i> +1 (555) 123-4567</li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt w-5 text-center mr-2"></i> 123 Gaming Street, E-Sports City</li>
                    </ul>
                    <div class="mt-4 flex space-x-3">
                        <a href="#" class="text-white hover:text-green-200"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white hover:text-green-200"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white hover:text-green-200"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white hover:text-green-200"><i class="fab fa-discord"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-green-600 mt-8 pt-6 text-center text-sm text-green-100">
                <p>&copy; 2025 Tournament Hub. All rights reserved.</p>
            </div>
        </div>
    </footer>

<script>
        document.addEventListener('DOMContentLoaded', function() {

            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });


            const photoInput = document.getElementById('photo');
            const fileNameSpan = document.querySelector('.file-name');
            
            photoInput.addEventListener('change', function() {
                if (photoInput.files.length > 0) {
                    fileNameSpan.textContent = photoInput.files[0].name;
                } else {
                    fileNameSpan.textContent = 'No file chosen';
                }
            });
        });
    </script>
</body>
</html>