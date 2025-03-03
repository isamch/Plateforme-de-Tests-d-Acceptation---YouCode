<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
        }

        h5 {
            font-weight: bold;
            color: #333;
        }

        input:focus {
            border-color: #007bff !important;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2) !important;
        }

        .input-group-text {
            background: #f8f9fa;
            cursor: pointer;
        }

        .btn-success {
            font-weight: bold;
            border-radius: 8px;
        }

        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h5 class="mb-3 text-center">Add New Question</h5>

        <form action="{{ route('questions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="question" class="form-label">Question:</label>
                <textarea name="question" class="form-control" rows="3">{{ old('question') }}</textarea>
                @error('question')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <h6>Options:</h6>

            <div id="optionsContainer">
                @error('correct_option')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="input-group mb-2">
                    <input type="text" name="options[]" class="form-control" placeholder="Option 1"
                        value="{{ old('options.0') }}" required>

                    <div class="input-group-text">
                        <input type="radio" name="correct_option" value="0"
                            {{ old('correct_option') == 0 ? 'checked' : '' }}> Correct
                    </div>
                </div>
                @error('options.0')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="input-group mb-2">
                    <input type="text" name="options[]" class="form-control" placeholder="Option 2"
                        value="{{ old('options.1') }}" required>

                    <div class="input-group-text">
                        <input type="radio" name="correct_option" value="1"
                            {{ old('correct_option') == 1 ? 'checked' : '' }}> Correct
                    </div>
                </div>
                @error('options.1')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="input-group mb-2">
                    <input type="text" name="options[]" class="form-control" placeholder="Option 3"
                        value="{{ old('options.2') }}" required>
                    <div class="input-group-text">
                        <input type="radio" name="correct_option" value="2"
                            {{ old('correct_option') == 2 ? 'checked' : '' }}> Correct
                    </div>
                </div>
                @error('options.2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="input-group mb-2">
                    <input type="text" name="options[]" class="form-control" placeholder="Option 4"
                        value="{{ old('options.3') }}" required>
                    <div class="input-group-text">
                        <input type="radio" name="correct_option" value="3"
                            {{ old('correct_option') == 3 ? 'checked' : '' }}> Correct
                    </div>
                </div>
                @error('options.3')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


            </div>

            <button type="submit" class="btn btn-success w-100 mt-3">Save Question</button>
        </form>
    </div>

</body>

</html>
