

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background-color: #007bff;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-top: 20px;
        }

        .hero-section .btn {
            margin-top: 30px;
            font-size: 1.25rem;
            padding: 10px 30px;
        }

        .about-section {
            padding: 80px 0;
            background-color: white;
        }

        .about-section h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .about-section p {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .footer .social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .footer .social-icons a:hover {
            color: #007bff;
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
                <ul class="navbar-nav ms-auto d-flex align-items-center justify-content-end">
                    <!-- Profile Link with Circle Image -->
                    <li class="nav-item me-3">
                        <a class="nav-link d-flex align-items-center btn" href="#">
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile"
                                class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                        </a>
                    </li>
                    <!-- Logout Button -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger border rounded-pill">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Welcome to YouCode Quizzes</h1>
            <p>Test your web development skills with our interactive quizzes and take your coding knowledge to the next
                level!</p>
            <a href="{{ Auth::user()->hasRole('candidat') ? route('candidat.quiz.index') : route('quizzes.index'); }}" class="btn btn-light btn-lg">Get Started</a>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h2 class="text-center">About YouCode</h2>
            <p class="text-center">
                YouCode is a leading school for web development and programming. Our mission is to empower students with
                the skills and knowledge needed to succeed in the tech industry. Whether you're a beginner or an
                experienced developer, YouCode offers a range of courses and resources to help you achieve your goals.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="social-icons">
                <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
            </div>
            <p class="mt-3">&copy; 2023 YouCode. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


</body>

</html>
