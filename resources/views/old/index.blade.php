<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .correct-answer {
            background: #28a745 !important;
            color: white;
            font-weight: bold;
            padding: 5px;
            border-radius: 5px;
        }

        .btn-sm {
            font-size: 12px;
            padding: 5px 10px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">All Questions</h2>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Option 1</th>
                    <th>Option 2</th>
                    <th>Option 3</th>
                    <th>Option 4</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->question }}</td>

                        @foreach ($question->options as $index => $option)
                            <td class="{{ $option->is_true ? 'correct-answer' : '' }}">
                                {{ $option->option_text }}
                            </td>
                        @endforeach

                        <td>
                            <a href="{{ route('questions.show', $question->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('questions.edit', $question->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>

</html>
