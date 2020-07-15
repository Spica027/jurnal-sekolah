<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | Journal</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{'assets/vendor/bootstrap/css/bootstrap.min.css'}}">
    <link href="{{'assets/vendor/fonts/circular-std/style.css'}}" rel="stylesheet">
    <link rel="stylesheet" href="{{'assets/libs/css/style.css'}}">
    <link rel="stylesheet" href="{{'assets/vendor/fonts/fontawesome/css/fontawesome-all.css'}}">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            background-color: #3999FFca;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        @if ($message = Session::get('error'))
        <div class="alert alert-secondary" role="alert">
            {{$message}}
        </div>
        @endif
        <div class="card ">
            <div class="card-header text-center"><a href="/"><img class="logo-img" src="../assets/images/logo.png"
                        alt="logo"></a></div>
            <div class="card-body">
                <form method="POST" action="/login-post">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="name" id="name" type="text"
                            placeholder="Username" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password"
                            placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <center>
                    <div class="card-footer-item card-footer-item-bordered ">
                        <a href="/register" class="footer-link">Create An Account</a>
                    </div>
                </center>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="{{'assets/vendor/jquery/jquery-3.3.1.min.js'}}"></script>
    <script src="{{'assets/vendor/bootstrap/js/bootstrap.bundle.js'}}"></script>
</body>

</html>
