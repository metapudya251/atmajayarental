@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Tambah Pegawai</h3>

  <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanda Pengenal</strong></label>
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
      <label class="form-label" for="first_name"><strong>No pengenal</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_pengenal" value="{{ old('no_pengenal') }}" ">
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Nama</strong></label>
      <input class="form-control" type="text" id="first_name" name="nama" value="{{ old('nama') }}" >
      <span class="text-danger">@error('nama'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Alamat</strong></label>
      <input class="form-control" type="text" id="first_name" name="alamat" value="{{ old('alamat') }}" >
      <span class="text-danger">@error('alamat'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanggal Lahir</strong></label>
      <input class="form-control" type="date" id="first_name" name="tgl_lahir" value="{{ old('tgl_lahir') }}" >
      <span class="text-danger">@error('tgl_lahir'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Jenis Kelamin</strong></label>
      <select class="form-select" name="gender">
        <optgroup label="Gender">
          @if (old('gender') == "Laki-laki")
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
      <label class="form-label" for="first_name"><strong>Phone Number</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_telp" value="{{ old('no_telp') }}" >
      <span class="text-danger">@error('no_telp'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Email</strong></label>
      <input class="form-control" type="email" id="first_name" name="email" value="{{ old('email') }}" >
      <span class="text-danger">@error('email'){{ $message }}@enderror</span>
    </div>
        
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
      <a href="{{ route('customer.read') }} " type="button" class="btn btn-outline-primary">Cancel</a>
    </div>
  </form>

</div>
@endsection