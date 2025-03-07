<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Scheduled</title>
    <style>
        /* General body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #343a40;
        }

        /* Container for the content */
        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
            border-left: 5px solid #28a745;
            /* Green left border */
        }

        /* Header styling */
        h1 {
            color: #343a40;
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* Paragraph styling */
        p {
            color: #6c757d;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Highlighted text for the test date */
        .test-date {
            color: #28a745;
            font-weight: bold;
            font-size: 18px;
        }

        /* Button style */
        .btn {
            background-color: #28a745;
            color: #fff;
            padding: 12px 25px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #218838;
        }

        /* Footer styling */
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
        }

        /* Signature styling */
        .signature {
            font-weight: bold;
            color: #343a40;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header -->
        <h1>Hello, {{ $Candidat->user->first_name }} {{ $Candidat->user->last_name }}</h1>

        <!-- Main content -->
        <p>Congratulations! You have successfully passed the quiz. Well done!</p>
        <p>Your test Presentiel has been scheduled for <span
                class="test-date">{{ $testDate->format('l, j F Y, H:i') }}</span>.</p>
        <p>Please ensure you are prepared and available at the scheduled time.</p>

        <!-- Button -->
        <a href="{{ route('home') }}" class="btn">View Test Details</a>

        <!-- Footer -->
        <div class="footer">
            <p>Best regards,</p>
            <p class="signature">YouCode</p>
        </div>

    </div>

</body>

</html>
