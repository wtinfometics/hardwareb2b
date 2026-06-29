<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Confirm Your Email</title>
    <style>
        body {
            background-color: #f8f9fc;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 520px;
            margin: 40px auto;
            background-color: #ffffff;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            padding: 30px 25px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
        }

        p {
            font-size: 15px;
            color: #333333;
            line-height: 1.6;
            margin: 0 0 15px 0;
        }

        .btn {
            display: inline-block;
            background-color: #353c4e;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #777777;
            margin-top: 25px;
        }

        .signature {
            margin-top: 25px;
        }

        .signature strong {
            color: #000;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <p>Don’t Share the OTP and It expire with in 3 Minutes </p>

        <a class="btn">{{ $data['otp'] }}</a>

    </div>
</body>

</html>
