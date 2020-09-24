<html>
<head>
    <title>Application Logs</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
</head>
<body class="bg-gray-300">

<div class="container mx-auto p-10 text-gray-800">
    <div class="flex my-4 items-center">
        @yield('search')
    </div>

    <div class="container mx-auto">
        @yield('content')
    </div>
</div>
</body>
</html>
