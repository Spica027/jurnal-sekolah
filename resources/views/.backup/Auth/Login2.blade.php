<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Journal</title>
    <!-- Meta Required -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: rgb(115, 121, 255);
            background: linear-gradient(133deg, rgba(115, 121, 255, 1) 0%, rgba(112, 172, 255, 1) 100%);
        }

        .wave {
            position: fixed;
            height: 100%;
            left: 0;
            bottom: 0;
            z-index: -1;
        }

        .container {
            width: 100vw;
            height: 100vh;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 7rem;
            padding: 0 2rem;
        }

        .img {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .img img {
            width: 500px;
        }

        .avatar {
            width: 100px;
        }

        .login-container {
            display: flex;
            align-items: center;
            text-align: center;

        }

        form {
            width: 360px;
        }

        form h2 {
            font-size: 2.9rem;
            text-transform: uppercase;
            margin: .9rem 0;
            color: #eee;
        }

        .input-div {
            position: relative;
            display: grid;
            grid-template-columns: 7% 93%;
            margin: 1.6rem 1rem;
            padding: 0.312rem 0;
            border-bottom: 2px solid #d9d9d9;
        }

        .input-div::after,
        .input-div::before {
            content: '';
            position: absolute;
            bottom: -2px;
            width: 0;
            height: 2px;
            background: #90C2EF;
            transition: .5s;
        }

        .input-div::after {
            right: 50%;
        }

        .input-div::before {
            left: 50%;
        }

        .input-div.focus .i #input-icon {
            color: #fff;
        }

        .input-div.focus div h5 {
            top: -5px;
            font-size: .9rem;
        }

        .input-div.focus::after,
        .input-div.focus::before {
            width: 50%;
        }

        .input-div .one {
            margin-top: 0;
        }

        .input-div .two {
            margin-bottom: 4px;
        }

        .i {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .i #input-icon {
            color: #fff;
            transition: .5s;
        }

        .input-div>div {
            position: relative;
            height: 45px;
        }

        .input-div>div h5 {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            font-size: 1.2rem;
            transition: .5s;
        }

        .input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            border: none;
            outline: none;
            background: none;
            padding: .5rem .7rem;
            font-size: 1.2rem;
            font-family: 'Poppins', sans-serif;
            color: #ddd;
        }

        .submit-btn {
            display: block;
            width: 100%;
            height: 50px;
            border-radius: 25px;
            margin: 1rem 0;
            font-size: 1.2rem;
            outline: none;
            border: none;
            background: #fff;
            cursor: pointer;
            color: #7379ff;
            text-transform: uppercase;
            font-family: 'Poppins', sans-serif;
            background-size: 200%;
            transition: .5s;
        }

        .submit-btn:hover {
            background-position: right;
        }

        @media screen and (max-width: 1050px) {
            .container {
                grid-gap: 5rem;
            }
        }

        @media screen and (max-width: 1000px) {
            form {
                width: 290px;
            }

            form h2 {
                font-size: 2.4rem;
                margin: 8px 0;
            }

            .img img {
                width: 400px;
            }
        }

        @media screen and (max-width: 900px) {
            .img {
                display: none;
            }

            .container {
                grid-template-columns: 1fr;
            }

            .wave {
                display: none;
            }

            .login-container {
                justify-content: center;
                background-color: rgba(32, 25, 94, 0.8855917366946778);
                height: 70%;
                padding: 0 0.5rem 0 0.5rem;
                border-radius: 25px;
                vertical-align: middle;
                margin-top: 6rem;
            }
        }
    </style>
</head>

<body>
    <img class="wave" src="{{asset('assets/images/wave.svg')}}">
    <div class="container">
        <div class="img">
            <img src="{{asset('assets/images/back.svg')}}">
        </div>
        <div class="login-container">
            <form method="POST" action="/login-post">
                @csrf
                <img class="avatar" src="{{asset('assets/images/avatar.svg')}}">
                <h2>Journal</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user" id="input-icon"></i>
                    </div>
                    <div>
                        <h5>Username</h5>
                        <input type="text" class="input" name="name" autocomplete="off" required>
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fas fa-user-lock" id="input-icon"></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" required>
                    </div>
                </div>
                <input type="submit" class="submit-btn" name="login" value="Login">
            </form>
        </div>
    </div>

    <!-- JQuery -->
    <script src="{{asset('assets/plugins/js/jquery-3.4.1.min.js')}}"></script>

    <!-- Fontawesome JS -->
    <script src="{{asset('assets/plugins/fontawesome/js/fontawesome.min.js')}}"></script>

    <!-- Main Script -->
    <script>
        const inputs = document.querySelectorAll('.input');

        function focusFunc()
        {
            let parent = this.parentNode.parentNode;
            parent.classList.add('focus');
        }

        function blurFunc()
        {
            let parent = this.parentNode.parentNode;
            if (this.value == "")
            {
                parent.classList.remove('focus');
            }
        }

        inputs.forEach(input =>
        {
            input.addEventListener('focus', focusFunc);
            input.addEventListener('blur', blurFunc);
        });
    </script>
</body>

</html>
