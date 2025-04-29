<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>youchallenge | @yield('participant.title')</title>
</head>
<body class='bg-gray-900 text-white min-h-screen flex flex-col'>
    @include('partials.participant.nav')
    <div class="flex-grow pt-16">

        @yield('participant-main')

        </div>
    @include('partials.participant.footer')
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