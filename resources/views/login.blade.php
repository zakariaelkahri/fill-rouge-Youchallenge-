<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md border-2 border-green-600">
        <h2 class="text-3xl font-bold mb-6 text-center text-green-700">Login</h2>

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

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf <!-- CSRF Token for Security -->

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

            {{-- <!-- Remember Me Checkbox -->
            <div class="mb-4 flex items-center">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-green-300 rounded"
                />
                <label for="remember" class="ml-2 block text-sm text-green-700">
                    Remember me
                </label>
            </div> --}}

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150"
            >
                Login
            </button>

            <!-- Register Link -->
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('showregisterform') }}" class="text-green-600 hover:text-green-800 font-medium">Register here</a>
                </p>
            </div>
            
            {{-- <!-- Forgot Password Link -->
            <div class="mt-2 text-center">
                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-800">
                    Forgot your password?
                </a>
            </div> --}}
        </form>
    </div>
</body>
</html>