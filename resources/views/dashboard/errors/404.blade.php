<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 | Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            min-height: 100vh;
            color: #5d4037; /* بني */
        }

        .error-box {
            background: #ffffff;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .error-code {
            font-size: 120px;
            font-weight: 700;
            color: #66bb6a; /* أخضر فاتح */
        }

        .error-title {
            font-weight: 700;
            color: #4e342e; /* بني غامق */
        }

        .error-text {
            color: #6d4c41; /* بني فاتح */
        }

        .btn-home {
            background-color: #66bb6a;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-home:hover {
            background-color: #43a047;
            color: #fff;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="error-box">

                    <div class="error-code">404</div>

                    <h2 class="error-title mb-3">Page Not Found</h2>

                    <p class="error-text mb-4">
                        Sorry, the page you’re looking for doesn’t exist.<br>
                        Let’s get you back to the store and keep moving Dashboard 
                    </p>

                    <a href="{{ url('/') }}" class="btn btn-home">
                        ⬅ Back to Home
                    </a>

                </div>
            </div>
        </div>
    </div>

</body>
</html>
