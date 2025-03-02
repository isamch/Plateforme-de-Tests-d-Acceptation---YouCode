{{-- {{ dd( $question ) }} --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="mb-3">Edit Question</h2>

            <form action="{{ route('questions.update', $question->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="question" class="form-label">Question:</label>
                    <input type="text" class="form-control" id="question" name="question"
                        value="{{ $question->question }}" required>
                </div>

                <h6 class="mb-3">Options:</h6>


                @foreach ($question->options as $index => $option)
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="options[]" value="{{ $option->option }}"
                            required>
                        <div class="input-group-text">
                            <input type="radio" name="correct_option" value="{{ $index }}"
                                {{ $option->is_true ? 'checked' : '' }}> Correct
                        </div>
                    </div>
                @endforeach

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Question</button>
                    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
