{{-- {{ dd( $question ) }} --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .correct-answer {
            background-color: rgba(0, 128, 0, 0.5);
            /* Green with 50% opacity */
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="mb-3">Question Details</h2>

            <div class="mb-3">
                <h5>
                    <strong>Question:</strong>
                    question title here!!!!
                </h5>
            </div>

            <h6 class="mb-3">Options:</h6>
            <ul class="list-group">


                options here !!!!
{{--
                @foreach ($question->options as $option)
                    <li class="list-group-item {{ $option->is_true ? 'correct-answer' : '' }}">
                        {{ $option->option }}
                    </li>
                @endforeach --}}
            </ul>

            <div class="mt-4">
                {{-- <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to All Questions</a> --}}
                {{-- <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning">Edit</a> --}}
                {{-- <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-inline"> --}}
                    {{-- @csrf --}}
                    {{-- @method('DELETE') --}}
                    {{-- <button type="submit" class="btn btn-danger" --}}
                        {{-- onclick="return confirm('Are you sure?')">Delete</button> --}}
                {{-- </form> --}}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
