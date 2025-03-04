{{-- {{ dd($quizzes[1]->trashed())}} --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>All Quizzes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4 text-center">All Quizzes</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('quizzes.create') }}" class="btn btn-success">Add New Quiz</a>
        </div>

        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search for quizzes...">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="quizzesTable">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Number of Questions</th>
                        <th>Status</th>
                        <td>Status Action</td>
                        <td>View</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->id }}</td>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ $quiz->description }}</td>
                            <td>{{ $quiz->questions->count() }}</td>
                            <td>
                                <span class="badge {{ $quiz->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($quiz->status) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('quizzes.toggleStatus', $quiz->id) }}" method="POST">
                                    @csrf
                                    @if ($quiz->status === 'active')
                                        <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                                    @else
                                        <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                    @endif
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-info btn-sm">View</a>
                            </td>
                            <td>
                                <a href="{{ route('quizzes.edit', $quiz->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                            </td>


                            {{-- <td>
                                @if ($quiz->trashed())
                                    <button class="btn btn-info btn-sm restore-btn" data-id="{{ $quiz->id }}">Restore</button>
                                @else
                                    <button class="btn btn-warning btn-sm delete-btn" data-id="{{ $quiz->id }}">Delete</button>
                                @endif

                            </td> --}}

                            <td id="quiz-action-{{ $quiz->id }}">
                                @if ($quiz->trashed())
                                    <button onclick="restoreQuiz({{ $quiz->id }})"
                                        class="btn btn-info btn-sm">Restore</button>
                                @else
                                    <button onclick="deleteQuiz({{ $quiz->id }})"
                                        class="btn btn-warning btn-sm">Delete</button>
                                @endif
                            </td>
                            {{-- <td>


                                @if ($quiz->trashed())
                                    <form action="{{ route('quizzes.restore', $quiz->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-info btn-sm">Restore</button>
                                    </form>
                                @else
                                    <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#quizzesTable tbody tr');

            rows.forEach(function(row) {
                var title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                var description = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (title.includes(input) || description.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>


    <script>
        function restoreQuiz(quizId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`quizzes/restore/${quizId}`, {
                    method: "PATCH",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {

                        document.getElementById(`quiz-action-${quizId}`).innerHTML = `
                            <button onclick="deleteQuiz(${quizId})" class="btn btn-warning btn-sm">Delete</button>
                        `;
                    } else {
                        alert("Failed to restore quiz.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function deleteQuiz(quizId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`quizzes/${quizId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {

                        document.getElementById(`quiz-action-${quizId}`).innerHTML = `
                            <button onclick="restoreQuiz(${quizId})" class="btn btn-info btn-sm">Restore</button>
                        `;
                    } else {
                        alert("Failed to delete quiz.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    </script>

</body>

</html>
