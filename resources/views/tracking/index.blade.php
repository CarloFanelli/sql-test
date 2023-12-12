<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/js/app.js')

</head>

<body>

    <main class="bg-light">
        <div class="container">
            <div class="row">
                @foreach ($clients as $item)
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <p>customer: {{ $item['client_id'] }}</p>
                                <p>hours: {{ $item['total_hours'] }}</p>
                            </div>
                            <ul>
                                @foreach ($item['total_hours_per_employee'] as $employee => $hour)
                                    <li>{{ $employee }} - {{ $hour }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </main>

</body>

</html>
