<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Reminder</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="app-header">
            <h1>Smart Reminder</h1>
            <p class="tagline">Never miss an important task again</p>
        </header>
        
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>