<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md border-2 border-green-600">
        <h2 class="text-3xl font-bold mb-6 text-center text-green-700">Tournament Registration</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Registration Form -->
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- CSRF Token for Security -->

            <!-- Role Selection -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-green-700">Select Role</label>
                <select
                    id="role" 
                    name="role"
                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white"
                    required
                >
                    <option value="" selected disabled>Select your role</option>
                    <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Organizer</option>
                    <option value="3" {{ old('role') == '3' ? 'selected' : '' }}>Participant</option>
                </select>
            </div>
            
            <!-- Name Field -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-green-700">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="John Doe"
                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    required
                />
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-green-700">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="john.doe@example.com"
                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    required
                />
            </div>

            <!-- Photo Upload Field -->
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-green-700">Profile Photo</label>
                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept="image/*"
                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                />
                <p class="mt-1 text-sm text-gray-500">Upload a profile photo (optional)</p>
                @error('photo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-green-700">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    required
                />
            </div>

            <!-- Confirmation Password Field -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-green-700">Confirm Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm your password"
                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    required
                />
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150"
            >
                Register
            </button>

            <!-- Login Link -->
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('showloginform') }}" class="text-green-600 hover:text-green-800 font-medium">Login here</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>