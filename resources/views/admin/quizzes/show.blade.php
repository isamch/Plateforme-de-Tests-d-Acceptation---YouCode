{{-- {{ dd($quiz->questions[1]->options)}} --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .scrollable-questions {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background: #fff;
        }
    </style>
</head>


<body class="bg-light">


    <div class="container mt-5">



        <h2 class="mb-4 text-center">Quiz Details</h2>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title">{{ $quiz->title }}</h4>
                <p class="card-text text-muted">{{ $quiz->description }}</p>
                <p><strong>Number of Questions:</strong> {{ $quiz->questions->count() }}</p>
            </div>
        </div>

        <h5 class="mt-4">Questions</h5>

        <div class="scrollable-questions">
            <div class="accordion" id="questionsAccordion">
                @foreach ($quiz->questions as $index => $question)
                    <div class="accordion-item question-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $index }}">
                                <strong>Q{{ $loop->iteration }} : </strong> {{ $question->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                            data-bs-parent="#questionsAccordion">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    @foreach ($question->options as $option)
                                        <li class="list-group-item">
                                            {{ $option->option }}
                                            @if ($option->is_true)
                                                <span class="badge bg-success">✔ Correct</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Back to Quizzes</a>
            <div>
                <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this quiz?')">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
