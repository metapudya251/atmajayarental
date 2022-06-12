<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Atma Jaya Rental</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}" />
  </head>

  <body class="bg-gradient-primary">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
          <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-6 d-none d-lg-flex">
                  <div class="flex-grow-1 bg-login-image" style="background-image: url('/assets/img/dogs/ajr-logo-1.png')"></div>
                </div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h4 class="text-dark mb-4">Welcome Back - Customer!</h4>
                    </div>
                    <form class="user" action="{{ route('customer.check') }}" method="POST">
                      @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                      @endif
                      @csrf
                      <div class="mb-3">
                        <input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" value="{{ old('email') }}"/>
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                      </div>
                      <div class="mb-3">
                        <input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password" value="{{ old('password') }}" autocomplete="off"/>
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                      </div>

                      <button class="btn btn-primary d-block btn-user w-100" type="submit">Login</button>
                      <hr />
                      <br>
                    </form>
                    <div class="text-center"><a class="small" href="{{ route('customer.register') }}">Create an Account!</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/theme.js') }}"></script>
  </body>
</html>