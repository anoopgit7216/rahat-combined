<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Disaster Management Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', sans-serif;
            background: url("{{ asset('assets/webimages/bg-img.png') }}") no-repeat center center/cover;
            position: relative;
        }

        /* Red fading overlay from top */
        .red-overlay {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(220, 53, 69, 0.85) 0%, rgba(220, 53, 69, 0.4) 30%, transparent 70%);
            z-index: 1;
            pointer-events: none;
        }

        .input-group-text {
            cursor: pointer;
        }

        .error-msg {
            color: red;
            font-size: 14px;
        }

        .login-container {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }


        .login-box {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;

        }

        .login-box img {
            width: 60px;
            margin-bottom: 15px;
        }

        .login-box h4 {
            font-weight: 600;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 8px;
            margin-top: 10px;
        }

        .forgot-link {
            margin-top: 15px;
            display: block;
            font-size: 0.9rem;
            color: #555;
        }

        .logo-image {
            text-align: center;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .forgot-password {
            text-decoration: none;
            color: #007bff;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="red-overlay"></div>

    <div class="login-container">
        <div class="login-box">
            <div class="logo-image">
                <img src="{{ asset('assets/webimages/rahat_logo_2.png') }}" alt="Gov Logo"
                    style="width: 88px;" />
            </div>

            <h3 class="text-center">Rahat Ayukt</h3>

            @if ($errors->any())
                <div class="mt-2 mb-2" style="color: white; text-align:center; padding:8px; background:red;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.perform') }}" onsubmit="return validatePassword()">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="form-control" placeholder="Enter your email">
                        <span class="input-group-text" style="cursor: default">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>



                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter your password" required>
                        <span class="input-group-text" onclick="togglePassword()">
                            <i id="toggleIcon" class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                    <small id="error-message" class="error-msg"></small>
                </div>


                <div class="mb-3 options">
                    {{-- <div class="form-check">
                        <input type="checkbox" id="remember-me" class="form-check-input">
                        <label for="remember-me" class="form-check-label">Remember Me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot Password</a> --}}
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>

            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        function validatePassword() {
            const password = document.getElementById("password").value;
            const errorMessage = document.getElementById("error-message");

            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (!regex.test(password)) {
                errorMessage.textContent =
                    "Password must be at least 8 characters, including uppercase, lowercase, number, and special character.";
                return false; // Prevent form submission
            } else {
                errorMessage.textContent = "";
                return true; // Allow form submission
            }
        }
    </script>
</body>

</html>
