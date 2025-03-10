{{-- {{ dd($questions ) }} --}}


{{-- {{ dd($questions[1]->options[0]->option) }} --}}




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4 text-center">All Questions</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('questions.create') }}" class="btn btn-success">Add New Questions</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Question</th>
                        <th>option 1</th>
                        <th>option 2</th>
                        <th>option 3</th>
                        <th>option 4</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>





                    @foreach ($questions as $question)
                        <tr>
                            <td>{{ $question->id }}</td>
                            <td>{{ $question->question }}</td>

                            {{-- {{  dd($question->options[0]->is_true) }} --}}
                            {{-- {{ $condition ? 'True Value' : 'False Value' }} --}}
                            {{-- <td style="background-color: rgba(0, 128, 0, 0.5);">{{ $question->options[0]->option }}</td> --}}

                            @foreach ($question->options as $option)
                                <td

                                    @if ($option->is_true)
                                        style="background-color: rgba(0, 128, 0, 0.5);"
                                    @endif

                                >{{ $option->option }}</td>

                            @endforeach


                            <td>
                                <a href="{{ route('questions.show', $question->id) }}" class="btn btn-info btn-sm">View</a>
                            </td>

                            <td>
                                <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this quiz?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
