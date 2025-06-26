<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Via Computer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="login-card">
            <div class="logo">
                <img src="{{ asset('image/Via Computer Logo.png') }}" alt="Via Computer Logo">
            </div>
            
            <h1>Login</h1>
            
            <form method="post" action="{{ route('login.success')}}" id="loginForm">
                @csrf
                @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" id="email" name="email" required >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" required >
                        <button type="button" id="togglePassword" class="toggle-password">
                            <img src="https://api.iconify.design/lucide:eye.svg" alt="show password" class="eye-icon">
                        </button>
                        @error('login') 
                        <small class="message">{{$message}}</small> 
                    @enderror
                    </div>
                </div>

                <div class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="login-button" id="btnLogin">Login</button>
            </form>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>
</html>