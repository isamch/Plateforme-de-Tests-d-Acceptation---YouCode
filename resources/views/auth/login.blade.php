<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 100px;
        }

        .login-card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            color: #dc3545;
            /* Bootstrap's danger color */
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">YouCode</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Login Link -->
                    <li class="nav-item me-2">
                        <a class="nav-link btn btn-outline-primary border rounded-pill px-3"
                            href="{{ route('login.form') }}">
                            Login
                        </a>
                    </li>
                    <!-- Register Link -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-success border rounded-pill px-3"
                            href="{{ route('register.form') }}">
                            Register
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 login-container">
                <div class="card login-card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Login</h3>
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input name="email" type="email" class="form-control" id="email"
                                    placeholder="Enter email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="password"
                                    placeholder="Password">
                                @error('password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>

                            @error('login_error')
                                <span class="error-message">{{ $message }}</span>
                            @enderror

                            <!-- Forgot Password Link -->
                            <div class="text-center mt-3">
                                <a href="#">Forgot password?</a>
                            </div>

                            <!-- Link to Register Page -->
                            <div class="text-center mt-3">
                                <a href="{{ route('register.form') }}">Don't have an account? Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>
