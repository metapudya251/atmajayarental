<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atma Jaya Rental</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4" style="margin-top: 45px">
                 <h4>Customer Register</h4><hr>
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
                     <div class="form-group">
                         <label for="name">Tanda Pengenal</label>
                         <input type="text" class="form-control" name="tanda_pengenal" placeholder="Enter tanda pengenal..." value="{{ old('tanda_pengenal') }}">
                         <span class="text-danger">@error('tanda_pengenal'){{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="name">No Pengenal</label>
                         <input type="text" class="form-control" name="no_pengenal" placeholder="Enter no pengenal..." value="{{ old('no_pengenal') }}">
                         <span class="text-danger">@error('no_pengenal'){{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="name">Name</label>
                         <input type="text" class="form-control" name="nama" placeholder="Enter name..." value="{{ old('nama') }}">
                         <span class="text-danger">@error('nama'){{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="name">Alamat</label>
                         <input type="text" class="form-control" name="alamat" placeholder="Enter address..." value="{{ old('alamat') }}">
                         <span class="text-danger">@error('alamat'){{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="name">Tanggal Lahir</label>
                         <input type="date" class="form-control" name="tgl_lahir" placeholder="Enter birth date..." value="{{ old('tgl_lahir') }}">
                         <span class="text-danger">@error('tgl_lahir'){{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                        <label for="email">No Telpon</label>
                        <input type="text" class="form-control" name="no_telp" placeholder="Enter phone number..." value="{{ old('no_telp') }}">
                        <span class="text-danger">@error('no_telp'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
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
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <br>
                    <a href="{{ route('customer.login') }}">I already have an account, Login now</a>
                    <br>
                 </form>
            </div>
        </div>
    </div>
</body>
</html>