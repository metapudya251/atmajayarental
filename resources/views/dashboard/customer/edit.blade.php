@extends('layouts.mainCust')
@section('customer-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Edit Driver</h3>

  <form action="{{ route('customer.update',$customer->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>No Customer</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_driver" value="{{ old('no_customer', $customer->no_customer) }}" autocomplete="off" disabled>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanda Pengenal</strong></label>
      <select class="form-select" name="tanda_pengenal">
        <optgroup label="Tanda Pengena;">
          @if (old('tanda_pengenal',$customer->tanda_pengenal ) == "KTP")
            <option value="{{ $customer->tanda_pengenal }}"selected >KTP</option>
            <option value="Kartu Pelajar">Kartu Pelajar</option>
          @else
            <option value="KTP" >KTP</option>
            <option value="{{ $customer->tanda_pengenal }}" selected >Kartu Pelajar</option>
          @endif
        </optgroup>
      </select>
      <span class="text-danger">@error('tanda_pengenal'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>No pengenal</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_pengenal" value="{{ old('no_pengenal', $customer->no_pengenal) }}" autocomplete="off">
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Foto Customer</strong></label>
      <input class="form-control" type="file" name="img"  autocomplete="off">
      <span class="text-danger">@error('img'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Nama</strong></label>
      <input class="form-control" type="text" id="first_name" name="nama" value="{{ old('nama', $customer->nama) }}" autocomplete="off">
      <span class="text-danger">@error('nama'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Alamat</strong></label>
      <input class="form-control" type="text" id="first_name" name="alamat" value="{{ old('alamat', $customer->alamat) }}" autocomplete="off">
      <span class="text-danger">@error('alamat'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanggal Lahir</strong></label>
      <input class="form-control" type="date" id="first_name" name="tgl_lahir" value="{{ old('tgl_lahir', $customer->tgl_lahir) }}" autocomplete="off">
      <span class="text-danger">@error('tgl_lahir'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Jenis Kelamin</strong></label>
      <select class="form-select" name="gender">
        <optgroup label="Gender">
          @if (old('gender',$customer->gender ) == "Laki-laki")
            <option value="{{ $customer->gender }}"selected >Laki-laki</option>
            <option value="Perempuan" >Perempuan</option>
          @else
            <option value="Laki-laki" >Laki-laki</option>
            <option value="{{ $customer->gender }}" selected >Perempuan</option>
          @endif
        </optgroup>
      </select>
      <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Phone Number</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_telp" value="{{ old('no_telp', $customer->no_telp) }}" autocomplete="off">
      <span class="text-danger">@error('no_telp'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Email</strong></label>
      <input class="form-control" type="email" id="first_name" name="email" value="{{ old('email', $customer->email) }}" autocomplete="off">
      <span class="text-danger">@error('email'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Password</strong></label>
      <input class="form-control" type="password" id="first_name" name="password"  value="{{ old('password', $customer->password) }}" autocomplete="off">
      <span class="text-danger">@error('password'){{ $message }}@enderror</span>
    </div>
        
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary" name="edit">Edit</button>
      <a href="{{ route('customer.profil') }} " type="button" class="btn btn-outline-primary">Cancel</a>
    </div>
  </form>

</div>
@endsection