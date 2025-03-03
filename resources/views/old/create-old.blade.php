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
                <a href="" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#newQuestionModal">
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

                        <!-- Display Selected Questions Count -->
                        <h5 class="mt-3">Select Questions (Must choose exactly 10)</h5>
                        <p id="questionCount">0 / 10</p>

                        <!-- Scrollable Questions Container -->
                        <div class="scrollable-questions">
                            <div class="accordion" id="questionsAccordion">
                                @foreach ($questions as $index => $question)
                                    <div class="accordion-item question-item">
                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}">
                                                <input type="checkbox" class="form-check-input me-2 question-checkbox"
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

    <!-- Modal for Adding New Question -->
    <div class="modal fade" id="newQuestionModal" tabindex="-1" aria-labelledby="newQuestionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newQuestionModalLabel">Add New Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="question" class="form-label">Question:</label>
                            <input type="text" name="question" class="form-control" required>
                        </div>

                        <h6>Options:</h6>
                        <div id="optionsContainer">
                            <div class="input-group mb-2">
                                <input type="text" name="options[]" class="form-control" placeholder="Option 1"
                                    required>
                                <div class="input-group-text">
                                    <input type="radio" name="correct_option" value="0"> Correct
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary btn-sm" onclick="addOption()">+ Add
                            Option</button>

                        <button type="submit" class="btn btn-success w-100 mt-3">Save Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Search Functionality with "Add New Question" Button
        document.getElementById("searchBox").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let questions = document.querySelectorAll(".question-item");
            let found = false;

            questions.forEach(function(question) {
                let text = question.innerText.toLowerCase();
                if (text.includes(filter)) {
                    question.style.display = "";
                    found = true;
                } else {
                    question.style.display = "none";
                }
            });

            // Show "Add New Question" button if no matching questions found
            document.getElementById("addQuestionBtn").classList.toggle("d-none", found);
        });

        // Function to add new option fields
        function addOption() {
            let optionsContainer = document.getElementById("optionsContainer");
            let index = optionsContainer.children.length;

            let div = document.createElement("div");
            div.classList.add("input-group", "mb-2");

            div.innerHTML = `
                <input type="text" name="options[]" class="form-control" placeholder="Option ${index + 1}" required>
                <div class="input-group-text">
                    <input type="radio" name="correct_option" value="${index}"> Correct
                </div>
            `;

            optionsContainer.appendChild(div);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.question-checkbox');
            const questionCount = document.getElementById('questionCount');
            const submitButton = document.querySelector('button[type="submit"]');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateQuestionCount);
                // Prevent accordion toggle when clicking on checkbox
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });

            function updateQuestionCount() {
                const selectedCount = document.querySelectorAll('.question-checkbox:checked').length;
                questionCount.textContent = `${selectedCount} / 10`;

                checkboxes.forEach(checkbox => {
                    if (selectedCount >= 10) {
                        if (!checkbox.checked) {
                            checkbox.disabled = true;
                        }
                    } else {
                        checkbox.disabled = false;
                    }
                });

                // Disable submit button if selected count is not 10
                submitButton.disabled = selectedCount !== 10;
            }

            // Initial check to disable submit button if no checkboxes are selected
            updateQuestionCount();
        });
    </script>

</body>

</html>
