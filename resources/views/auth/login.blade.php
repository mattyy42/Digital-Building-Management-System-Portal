<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body style="background-color: #14141f ">
    <div class="loginbox" ;">
        <img src="img/user_pic.png" class="avater">
        <h1>Login Here</h1>
        @if(Session::get('loginredirect'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="gone">
            <strong>{{ Session::get('loginredirect' )}}</strong>
        </div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">

                @csrf
                <p>Email Address</p>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <p>Password</p>
                <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <input type="submit" value="Login" name="">

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a><br>
                @endif
                <a href="{{ route('register') }}">Don't have an account</a>


            </form>
        </div>
    </div>

</body>