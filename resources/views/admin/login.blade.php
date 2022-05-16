


<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--Made with love by Mutiullah Samim -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div  class="card">
            <div style="margin-top: 50px" class="card-header">
                <h3 style="text-align: center">Log In</h3>
            </div>
            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('error')}}
                </div>
            @endif
            <div  class="card-body">
                <form method="POST" action="{{route('admin.login')}}">
                    @csrf
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="email">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>

                        <input type="password" name="password" class="form-control" placeholder="password">
                    </div>
                    <div class="row align-items-center remember">
                        <input name="remember" type="checkbox">Remember Me
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn float-right login_btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

