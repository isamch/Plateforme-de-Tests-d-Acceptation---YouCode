<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container text-center">
        <div class="alert alert-danger">
            <h2>Verification Failed</h2>
            <p>{{ $message }}</p>
            <a href="{{ route('verification.notice') }}" class="btn btn-primary">Try Again</a>
        </div>
    </div>
</body>

</html>
