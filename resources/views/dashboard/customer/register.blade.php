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
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url('/assets/img/dogs/ajr-logo-1.png')"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account!</h4>
                            </div>
                            <form action="{{ route('customer.add') }}" method="post">
                                @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                @if (Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                                @endif

                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="first_name">Tanda Pengenal</label>
                                    <select class="form-select" name="tanda_pengenal">
                                        <optgroup label="Tanda Pengena;">
                                        @if (old('tanda_pengenal' ) == "KTP")
                                            <option value="KTP"selected >KTP</option>
                                            <option value="Kartu Pelajar">Kartu Pelajar</option>
                                        @else
                                            <option value="KTP" >KTP</option>
                                            <option value="Kartu Pelajar" selected >Kartu Pelajar</option>
                                        @endif
                                        </optgroup>
                                    </select>
                                    <span class="text-danger">@error('tanda_pengenal'){{ $message }}@enderror</span>
                                </div>
                                <div class="mb-3">
                                    <label for="name">No Pengenal</label>
                                    <input type="text" class="form-control" name="no_pengenal" placeholder="Enter no pengenal..." value="{{ old('no_pengenal') }}">
                                    <span class="text-danger">@error('no_pengenal'){{ $message }}@enderror</span>
                                </div>
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Enter name..." value="{{ old('nama') }}">
                                    <span class="text-danger">@error('nama'){{ $message }}@enderror</span>
                                </div>
                                <div class="mb-3">
                                    <label for="name">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" placeholder="Enter address..." value="{{ old('alamat') }}">
                                    <span class="text-danger">@error('alamat'){{ $message }}@enderror</span>
                                </div>
                                <div class="mb-3">
                                    <label for="name">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" placeholder="Enter birth date..." value="{{ old('tgl_lahir') }}">
                                    <span class="text-danger">@error('tgl_lahir'){{ $message }}@enderror</span>
                                </div>
                                <div class="mb-3">
                                    <label for="email">No Telpon</label>
                                    <input type="text" class="form-control" name="no_telp" placeholder="Enter phone number..." value="{{ old('no_telp') }}">
                                    <span class="text-danger">@error('no_telp'){{ $message }}@enderror</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="first_name">Jenis Kelamin</label>
                                    <select class="form-select" name="gender">
                                    <optgroup label="Gender">
                                        @if (old('gender') == 'Laki-laki')
                                        <option value="Laki-laki"selected >Laki-laki</option>
                                        <option value="Perempuan" >Perempuan</option>
                                        @else
                                        <option value="Laki-laki" >Laki-laki</option>
                                        <option value="Perempuan" selected >Perempuan</option>
                                        @endif
                                    </optgroup>
                                    </select>
                                    <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                </div>
                                    <button class="btn btn-primary d-block btn-user w-100" type="submit">Register Account</button>
                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="{{ route('customer.login') }}">Already have an account? Login!</a></div>
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