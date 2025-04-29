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
            font-family: 'Inter', sans-serif;
            background-color: #1a202c; /* match dark theme */
        }
        .flex {
            display: flex;
            flex-wrap: wrap; /* Ensure proper wrapping on small screens */
        }
        footer {
            margin-top: auto;
        }
    </style>
    <title>youchallenge | @yield('title')</title>
</head>
<body class="bg-gray-900 text-gray-200">
    @include('partials.admin.nav')
    <div class="flex min-h-screen">
        @include('partials.admin.sidebar')
        <main class="flex-1">
            @yield('main')
        </main>
    </div>
    @include('partials.admin.footer')
    <script src="{{ asset('public/js/burger-menu.js') }}"></script>
</body>
</html>