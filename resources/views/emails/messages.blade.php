<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <div>

            <h3>{{ $message ?? 'No message available.' }}</h3>
            <a href="{{ url('/home') }}" class="btn btn-primary mt-3">Go Home</a>
        </div>
    </div>

</body>

</html>
