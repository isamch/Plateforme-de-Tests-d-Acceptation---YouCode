<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* Quiz Container */
        .quiz-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.6s ease-in-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Question Styling */
        .question {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: transform 0.3s ease-in-out;
        }

        .question:hover {
            transform: scale(1.02);
            background: #eef2ff;
        }

        /* Radio Button Styling */
        .option {
            display: block;
            text-align: left;
            margin: 8px 0;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
            cursor: pointer;
        }

        .option:hover {
            background: #e2e8f0;
            color: #333;
        }

        .option input {
            margin-right: 10px;
            cursor: pointer;
        }

        /* Submit Button Styling */
        .submit-btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #4CAF50;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .submit-btn:hover {
            background: #45a049;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="quiz-container">
            <h2 class="text-center text-primary">📝 Take the Quiz</h2>
            <form method="POST" action="{{ route('candidat.quiz.submit') }}">
                @csrf

                @foreach ($quiz->questions as $question)
                    <div class="question">
                        <h5>Question {{ $loop->iteration }}:</h5>
                        <p>{{ $question->question }}</p>

                        @foreach ($question->options as $option)
                            <label class="option">
                                <input type="radio" name="answers[{{ $option->question_id }}]"
                                    value="{{ $option->id }}">
                                {{ $option->option }}
                            </label>
                        @endforeach
                    </div>
                @endforeach

                <button id="autoSubmitForm" type="submit" class="btn submit-btn">🚀 Submit Quiz</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        let intervalId =setInterval(function() {

            let passedTime = (Math.floor(Date.now() / 1000) - {{ strtotime($candidatQuiz->start_time) }}) / 60;

            let quizDuration = {{ $quiz->duration }};

            if (passedTime >= quizDuration) {
                let btnSubmit = document.getElementById("autoSubmitForm");
                if (btnSubmit) {
                    // console.log("Submitting form automatically...");
                    btnSubmit.click();
                    clearInterval(intervalId);
                } else {
                    console.error("Element #autoSubmitForm not found!");
                }
            }
        }, 1000);

    </script>

</body>

</html>
