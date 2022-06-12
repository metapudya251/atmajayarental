@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Tambah Driver</h3>

  <form action="{{ route('driver.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Foto Driver</strong></label>
      <input class="form-control" type="file" name="img" >
      <span class="text-danger">@error('img'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Nama driver</strong></label>
      <input class="form-control" type="text" id="first_name" name="nama_driver" value="{{ old('nama_driver') }}" >
      <span class="text-danger">@error('nama_driver'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Alamat driver</strong></label>
      <input class="form-control" type="text" id="first_name" name="alamat_driver" value="{{ old('alamat_driver') }}" >
      <span class="text-danger">@error('alamat_driver'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanggal Lahir</strong></label>
      <input class="form-control" type="date" id="first_name" name="tgl_lahir_driver" value="{{ old('tgl_lahir_driver') }}" >
      <span class="text-danger">@error('tgl_lahir_driver'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Jenis Kelamin</strong></label>
      <select class="form-select" name="gender_driver">
        <optgroup label="Gender">
          @if (old('gender_driver') == "Laki-laki")
            <option value="Laki-laki"selected >Laki-laki</option>
            <option value="Perempuan" >Perempuan</option>
          @else
            <option value="Laki-laki" >Laki-laki</option>
            <option value="Perempuan" selected >Perempuan</option>
          @endif
        </optgroup>
      </select>
      <span class="text-danger">@error('gender_driver'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Phone Number</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_telp_driver" value="{{ old('no_telp_driver') }}" >
      <span class="text-danger">@error('no_telp_driver'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Email</strong></label>
      <input class="form-control" type="email" id="first_name" name="email" value="{{ old('email') }}" >
      <span class="text-danger">@error('email'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Password</strong></label>
      <input class="form-control" type="password" id="first_name" name="password">
      <span class="text-danger">@error('password'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Status Driver</strong></label>
      <select class="form-select" name="status_tersedia">
        <optgroup label="Status Driver">
          @if (old('status_tersedia') == "Tersedia")
            <option value="Tersedia"selected >Tersedia</option>
            <option value="Tidak Tersedia" >Tidak Tersedia</option>
          @else
            <option value="Tersedia" >Tersedia</option>
            <option value="Tidak Tersedia" selected >Tidak Tersedia</option>
          @endif
        </optgroup>
      </select>
      <span class="text-danger">@error('status_tersedia'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Bahasa</strong></label>
      <input class="form-control" type="text" id="first_name" name="bahasa" value="{{ old('bahasa') }}">
      <span class="text-danger">@error('bahasa'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Biaya Driver</strong></label>
      <input class="form-control" id="first_name" name="biaya_driver" value="{{ old('biaya_driver') }}" autocomplete="off">
      <span class="text-danger">@error('biaya_driver'){{ $message }}@enderror</span>
    </div>
        
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
      <a href="{{ route('driver.index') }} " type="button" class="btn btn-outline-primary">Cancel</a>
    </div>
  </form>

</div>
@endsection