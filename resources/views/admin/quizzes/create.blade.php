<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Scrollable questions section */
        .scrollable-questions {
            max-height: 400px;
            /* Adjust height */
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
        <div class="card shadow-lg p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="mb-0">Create New Quiz</h2>
                <a href="{{ route('questions.create') }}" type="button" class="btn btn-success btn-sm">
                    + Add New Question
                </a>
            </div>

            <form action="{{ route('quizzes.store') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Left Side (Title & Description) -->
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                    </div>

                    <!-- Right Side (Questions) -->
                    <div class="col-md-7">
                        <h4>Select Questions</h4>

                        <!-- Search Box -->
                        <div class="mb-3">
                            <input type="text" id="searchBox" class="form-control"
                                placeholder="Search for a question...">
                        </div>

                        <!-- Scrollable Questions Container -->
                        <div class="scrollable-questions">
                            <div class="accordion" id="questionsAccordion">
                                @foreach ($questions as $index => $question)
                                    <div class="accordion-item question-item">
                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}">
                                                <input type="checkbox" class="form-check-input me-2"
                                                    name="question_ids[]" value="{{ $question->id }}">
                                                {{ $question->question }}
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
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-4">Save</button>
            </form>
        </div>
    </div>

    <script>
        // Search Functionality
        document.getElementById("searchBox").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let questions = document.querySelectorAll(".question-item");

            questions.forEach(function(question) {
                let text = question.innerText.toLowerCase();
                if (text.includes(filter)) {
                    question.style.display = "";
                } else {
                    question.style.display = "none";
                }
            });
        });
    </script>

</body>

</html>
