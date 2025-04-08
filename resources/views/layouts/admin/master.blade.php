<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>youchallenge | @yield('title')</title>
</head>
<body>
    @include('partials.admin.nav')
        <div class="flex">
        @include('partials.admin.sidebar')
        @yield('main')

        </div>
    @include('partials.admin.footer ')


</body>
</html>