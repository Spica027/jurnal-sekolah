@extends('Template.template')

@section('title')
Login | Journal
@endsection

@section('content')

<body>

    <div class="container-fluid">
        <!-- Header -->
        <!-- <div class="header" style="border-bottom: none;">
			<h3>Profile</h3>
		</div> -->

        <!-- Content -->
        <div class="konten" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="col-lg-12">
                <div class="card mx-auto">
                    <div class="card-header">
                        <img src="{{asset('assets/default.svg')}}" class="profile">
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" action="/login-post" method="post" novalidate>
                            @csrf
                            <div class="form col-sm-12 mb-4">
                                <label>Username :</label>
                                <input type="text" class="form-control" name="name" placeholder="Username"
                                    autocomplete="off" required>
                            </div>

                            <div class="form col-sm-12 mb-4">
                                <label>Password :</label>
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    autocomplete="off" required>
                            </div>

                            <div class="form-group col-lg-12">
                                <button type="submit" class="btn ganti">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @endsection
