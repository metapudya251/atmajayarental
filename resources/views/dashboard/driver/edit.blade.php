@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Edit Driver</h3>

  <form action="{{ route('driver.update',$driver->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>No Driver</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_driver" value="{{ old('no_driver', $driver->no_driver) }}" autocomplete="off" disabled>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Foto Driver</strong></label>
      <input class="form-control" type="file" name="img" autocomplete="off">
      <span class="text-danger">@error('img'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Nama driver</strong></label>
      <input class="form-control" type="text" id="first_name" name="nama_driver" value="{{ old('nama_driver', $driver->nama_driver) }}" autocomplete="off" disabled>
      <span class="text-danger">@error('nama_driver'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Alamat driver</strong></label>
      <input class="form-control" type="text" id="first_name" name="alamat_driver" value="{{ old('alamat_driver', $driver->alamat_driver) }}" autocomplete="off" disabled>
      <span class="text-danger">@error('alamat_driver'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanggal Lahir</strong></label>
      <input class="form-control" type="date" id="first_name" name="tgl_lahir_driver" value="{{ old('tgl_lahir_driver', $driver->tgl_lahir_driver) }}" autocomplete="off" disabled>
      <span class="text-danger">@error('tgl_lahir_driver'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Jenis Kelamin</strong></label>
      <select class="form-select" name="gender_driver" disabled>
        <optgroup label="Gender">
          @if (old('gender_driver',$driver->gender_driver ) == "Laki-laki")
            <option value="{{ $driver->gender_driver }}"selected >Laki-laki</option>
            <option value="Perempuan" >Perempuan</option>
          @else
            <option value="Laki-laki" >Laki-laki</option>
            <option value="{{ $driver->gender_driver }}" selected >Perempuan</option>
          @endif
        </optgroup>
      </select>
      <span class="text-danger">@error('gender_driver'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Phone Number</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_telp_driver" value="{{ old('no_telp_driver', $driver->no_telp_driver) }}" autocomplete="off" disabled>
      <span class="text-danger">@error('no_telp_driver'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Email</strong></label>
      <input class="form-control" type="email" id="first_name" name="email" value="{{ old('email', $driver->email) }}" autocomplete="off" disabled>
      <span class="text-danger">@error('email'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Password</strong></label>
      <input class="form-control" type="password" id="first_name" name="password"  value="{{ old('password', $driver->password) }}" autocomplete="off" disabled>
      <span class="text-danger">@error('password'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Status Driver</strong></label>
      <select class="form-select" name="status_tersedia">
        <optgroup label="Status Driver">
          @if (old('status_tersedia',$driver->status_tersedia ) == "Tersedia")
            <option value="{{ $driver->status_tersedia }}"selected >Tersedia</option>
            <option value="Tidak Tersedia" >Tidak Tersedia</option>
          @else
            <option value="Tersedia" >Tersedia</option>
            <option value="{{ $driver->status_tersedia }}" selected >Tidak Tersedia</option>
          @endif
        </optgroup>
      </select>
      <span class="text-danger">@error('status_tersedia'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Bahasa</strong></label>
      <input class="form-control" type="text" id="first_name" name="bahasa" value="{{ old('bahasa', $driver->bahasa) }}" autocomplete="off">
      <span class="text-danger">@error('bahasa'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Biaya Driver</strong></label>
      <input class="form-control" id="first_name" name="biaya_driver" value="{{ old('biaya_driver',$driver->biaya_driver) }}" autocomplete="off">
      <span class="text-danger">@error('biaya_driver'){{ $message }}@enderror</span>
    </div>
        
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary" name="edit">Edit</button>
      <a href="{{ route('driver.index') }} " type="button" class="btn btn-outline-primary">Cancel</a>
    </div>
  </form>

</div>
@endsection