<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
</head>

<body class="flex flex-col md:flex-row p-0 m-0">

    <div class="w-full md:w-64 lg:w-64">
        @include('components.sidebar')
    </div>
    <!-- Konten -->
    <div class="flex-1 bg-gray-900/95 p-4 md:p-6 lg:p-8 min-h-screen">
        @if (session('success'))
            <x-toast id="success" :icons="'fa-solid fa-circle-check'" :messages="session('success')" />
        @endif

        @if (session('error'))
            <x-toast id="danger" :icons="'fa-solid fa-circle-xmark'" :messages="'Something was wrong, please try again later'" />
        @endif

        @yield('content')
    </div>
</body>

</html>