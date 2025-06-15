<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <title>{{$title}}{{config('app.name')}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/33e081594a.js" crossorigin="anonymous"></script>


    <!-- Styles -->
    @vite('resources/css/app.css')


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="bg-default m-0 p-0 w-full h-full font-maven text-white text-xl">
    <x-nav/>
    {{$slot}}
    <x-footer/>
</body>
</html>
