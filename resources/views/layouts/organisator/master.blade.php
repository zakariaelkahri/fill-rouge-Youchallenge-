<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            padding-top: 4rem;
        }
        
        .card-gradient {
            background: linear-gradient(to bottom right, #1f2937, #111827);
        }
        
        .btn-primary {
            @apply bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300;
        }
        
        .btn-secondary {
            @apply bg-gray-700 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-300;
        }
        
        .card {
            @apply bg-gray-800 rounded-xl shadow-lg overflow-hidden;
        }
        
        .card-header {
            @apply p-4 border-b border-gray-700;
        }
        
        .card-body {
            @apply p-4;
        }
    </style>

    <title>YouChallenge | @yield('organisator-title')</title>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">
    @include('partials.organisator.nav')
    <div class="flex-grow pt-16">
        @yield('organisator-main')
    </div>
    @include('partials.organisator.footer')
    
    <script>
        if (performance.navigation.type === 2) {
            location.reload(); 
        }
        
       
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle functionality could go here
        });
    </script>
</body>
</html>