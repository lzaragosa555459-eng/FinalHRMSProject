<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CoreHR</title>
    
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-purple: #6f42c1;
            --dark-purple: #2d1a4d;
            --accent-gold: #ffc107;
            --soft-bg: #f3f0f7;
        }

        body {
            background-color: var(--soft-bg);
            /* Subtle geometric pattern */
            background-image: radial-gradient(var(--primary-purple) 0.5px, transparent 0.5px);
            background-size: 30px 30px;
            background-opacity: 0.05;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        .login-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(45, 26, 77, 0.1);
            background: #ffffff;
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            background: var(--dark-purple);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 4px rgba(111, 66, 193, 0.1);
        }

        .btn-login {
            background: var(--dark-purple);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: var(--primary-purple);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
        }

        .forgot-link {
            color: var(--primary-purple);
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.2s;
        }

        .forgot-link:hover {
            color: var(--dark-purple);
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-card">
            
            <div class="login-header">
                <div class="logo-circle">
                    <img src="{{ asset('logo.png') }}" height="40" alt="CoreHR">
                </div>
                <h4 class="fw-bold mb-1">Welcome Back</h4>
                <p class="small opacity-75 mb-0">Sign in to your CoreHR account</p>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="/login" method="POST">
                    @csrf

                    @if(session('error'))
                        <div class="alert alert-danger rounded-3 border-0 mb-4" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                placeholder="name@company.com" value="{{ old('email') }}" required autofocus>
                        </div>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label small fw-bold text-muted">Password</label>
                            <a href="#" class="forgot-link">Forgot?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <input type="password" name="password" id="password" 
                                class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror"
                                placeholder="••••••••" required>
                            <span class="input-group-text bg-white border-start-0 text-muted" style="cursor: pointer;" id="togglePassword">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label small text-muted" for="remember">Keep me logged in</label>
                    </div>

                    <button type="submit" class="btn btn-login w-100 mb-3">
                        Sign In <i class="bi bi-arrow-right ms-2"></i>
                    </button>

                    <p class="text-center small text-muted mb-0">
                        Don't have an account? <a href="#" class="forgot-link">Contact HR</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle the icon
        if (type === 'password') {
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        } else {
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        }
    });
</script>
</body>
</html>