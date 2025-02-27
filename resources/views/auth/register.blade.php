<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .register-container {
            margin-top: 100px;
        }

        .register-card {
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
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 register-container">
                <div class="card register-card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Register</h3>
                        <form method="POST" action="{{ route('register.form') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- First Name and Last Name Fields (in one line) -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first-name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first-name" name="first_name"
                                        placeholder="First name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last-name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last-name" name="last_name"
                                        placeholder="Last name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Age and Address Fields (in one line) -->
                            <div class="row mb-3">
                                <!-- Age Field -->
                                <div class="col-md-6">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age" name="age"
                                        placeholder="age" value="{{ old('age') }}" required min="1" max="120">
                                    @error('age')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Address Field -->
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="address" value="{{ old('address') }}">
                                    @error('address')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required>
                                @error('password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Confirmation Field -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Password" required>
                            </div>

                            <!-- Profile Image Field -->
                            <div class="mb-3">
                                <label for="profile_image" class="form-label">Profile Image</label>
                                <input type="file" class="form-control" id="profile_image" name="profile_image"
                                    accept="image/*">
                                @error('profile_image')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Upload your profile picture (JPEG, PNG,
                                    etc.).</small>
                            </div>

                            <!-- National Card Image Field -->
                            <div class="mb-3">
                                <label for="national_card_image" class="form-label">National Card Image</label>
                                <input type="file" class="form-control" id="national_card_image"
                                    name="national_card_image" accept="image/*">
                                @error('national_card_image')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Upload an image of your national ID card (JPEG, PNG,
                                    etc.).</small>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>

                            <!-- Link to Login Page -->
                            <div class="text-center mt-3">
                                <a href="{{ route('login.form') }}">Already have an account? Login here</a>
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
