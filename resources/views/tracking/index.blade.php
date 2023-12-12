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
            <div class="row py-5">
                @foreach ($clients as $item)
                    <div class="col-4 g-3">
                        <div class="card h-100 p-2">
                            <div class="card-header">
                                <p>customer: {{ $item['client_id'] }} | hours: {{ $item['total_hours'] }}</p>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach ($item['total_hours_per_employee'] as $employee => $hour)
                                        <li>Employee: {{ $employee }} - time spent: {{ $hour }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </main>

</body>

</html>
