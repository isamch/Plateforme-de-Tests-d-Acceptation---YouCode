{{-- {{  dd($quiz);  }} --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .quiz-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .start-btn {
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="quiz-container text-center">
            <h2 class="mb-3">{{ $quiz->title }}</h2>
            <p class="text-muted">{{ $quiz->description }}</p>
            <p><strong>Number of questions:</strong> {{ $quiz->questions->count() }}</p>
            <a href="{{ route('candidat.quiz.start') }}" class="btn btn-primary start-btn">Start Quiz</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
