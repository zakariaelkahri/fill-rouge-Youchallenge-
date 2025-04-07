<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouChallenge - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <header class="bg-green-800/70 backdrop-blur-sm p-6 shadow-2xl fixed w-full top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3a8 8 0 0 1 8 8v4a4 4 0 0 1-4 4h-4a8 8 0 0 1-8-8v-4a4 4 0 0 1 4-4Z"/>
                    <path d="M12 11v6"/>
                    <line x1="8" x2="16" y1="15" y2="15"/>
                </svg>
                YouChallenge
            </h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="{{ route('home') }}" class="text-white hover:text-green-300 transition duration-300">Home</a></li>
                    <li><a href="{{ route('showregisterform') }}" class="text-white hover:text-green-300 transition duration-300">Register</a></li>
                    <li><a href="{{ route('showloginform') }}" class="text-white hover:text-green-300 transition duration-300">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="relative">
        <!-- Hero Section with Tournament Background -->
        <section class="relative h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://th.bing.com/th/id/R.9322d7cb917f50682f66424fd677f402?rik=Yy3b1i9JLUj1lw&pid=ImgRaw&r=0');">
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <div class="relative z-10 text-center px-4">
                <h2 class="text-5xl font-bold mb-6 text-white drop-shadow-lg">Welcome to YouChallenge!</h2>
                <p class="text-xl mb-8 text-gray-200 max-w-2xl mx-auto">
                    Dive into the ultimate gaming arena where skills meet competition. Join tournaments, connect with gamers, and prove your prowess.
                </p>
                <a href="{{ route('showregisterform') }}" class="bg-green-600 text-white py-3 px-6 rounded-full text-lg hover:bg-green-700 transition duration-300 inline-block shadow-xl hover:scale-105 transform">
                    Start Your Challenge
                </a>
            </div>
        </section>

        <!-- Features Section -->
        <section class="bg-gray-900 py-20 px-4">
            <div class="container mx-auto">
                <h2 class="text-4xl font-bold text-center mb-12 text-green-500">Platform Features</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gray-800 p-8 rounded-xl border-2 border-green-700 hover:bg-gray-700 transition duration-300">
                        <div class="text-green-500 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <line x1="3" y1="9" x2="21" y2="9"/>
                                <line x1="9" y1="21" x2="9" y2="9"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-white">User-Friendly Interface</h3>
                        <p class="text-gray-300">Intuitive design that makes navigation seamless and enjoyable.</p>
                    </div>
                    <div class="bg-gray-800 p-8 rounded-xl border-2 border-green-700 hover:bg-gray-700 transition duration-300">
                        <div class="text-green-500 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-white">Real-Time Updates</h3>
                        <p class="text-gray-300">Stay informed with instant notifications on tournaments and events.</p>
                    </div>
                    <div class="bg-gray-800 p-8 rounded-xl border-2 border-green-700 hover:bg-gray-700 transition duration-300">
                        <div class="text-green-500 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-white">Community Engagement</h3>
                        <p class="text-gray-300">Connect and interact with passionate gamers worldwide.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Section -->
        <section class="bg-gray-800 py-20 px-4">
            <div class="container mx-auto">
                <h2 class="text-4xl font-bold text-center mb-12 text-green-500">Why YouChallenge?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gray-900 p-8 rounded-xl border-2 border-green-700 hover:bg-gray-800 transition duration-300">
                        <h3 class="text-xl font-bold mb-4 text-white">Competitive Play</h3>
                        <p class="text-gray-300">Challenge top players globally and elevate your competitive spirit.</p>
                    </div>
                    <div class="bg-gray-900 p-8 rounded-xl border-2 border-green-700 hover:bg-gray-800 transition duration-300">
                        <h3 class="text-xl font-bold mb-4 text-white">Exciting Prizes</h3>
                        <p class="text-gray-300">Unlock incredible rewards and recognition for your gaming achievements.</p>
                    </div>
                    <div class="bg-gray-900 p-8 rounded-xl border-2 border-green-700 hover:bg-gray-800 transition duration-300">
                        <h3 class="text-xl font-bold mb-4 text-white">Community Support</h3>
                        <p class="text-gray-300">Join a supportive network of gamers who share your passion.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-green-900 p-6 text-center">
        <p class="text-white">© 2024 YouChallenge. All rights reserved.</p>
        <div class="mt-4 space-x-4">
            <a href="#" class="text-green-300 hover:text-white">Privacy Policy</a>
            <a href="#" class="text-green-300 hover:text-white">Terms of Service</a>
            <a href="#" class="text-green-300 hover:text-white">Contact</a>
        </div>
    </footer>
</body>
</html>