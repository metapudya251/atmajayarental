@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Tambah Data Pemilik</h3>

  <form action="{{ route('pemilik.store') }}" method="post">
    @csrf
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Nama Pemilik</strong></label>
      <input class="form-control" type="text" id="first_name" name="nama_pemilik" value="{{ old('nama_pemilik') }}">
      <span class="text-danger">@error('nama_pemilik'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Nomor KTP</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_ktp" value="{{ old('no_ktp') }}">
      <span class="text-danger">@error('no_ktp'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Alamat Pemilik</strong></label>
      <input class="form-control" id="first_name" name="alamat_pemilik" value="{{ old('alamat_pemilik') }}">
      <span class="text-danger">@error('alamat_pemilik'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>No Telepon Pemilik</strong></label>
      <input class="form-control" id="first_name" name="noTelp_pemilik" value="{{ old('noTelp_pemilik') }}">
      <span class="text-danger">@error('noTelp_pemilik'){{ $message }}@enderror</span>
    </div>
        
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary" name="Tambah">Tambah</button>
      <a href="{{ route('pemilik.index') }}" type="button" class="btn btn-outline-primary">Cancel</a>
    </div>
  </form>

</div>
@endsection