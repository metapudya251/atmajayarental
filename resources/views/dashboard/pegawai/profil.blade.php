@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Edit Profile</h3>

  <form action="{{ route('pegawai.update',$pegawai->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label" for="role"><strong>Role</strong></label>
      <select class="form-select" name="role_id" disabled>
        <optgroup label="Role">
          {{-- <option value="1"></option> --}}
          @foreach ($role as $role)
            @if (old('role_id', $pegawai->role_id ) == $role->id)
              <option value="{{ $role->id }}" selected>{{ $role->nama_role }}</option>
            @else
              <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
            @endif
          @endforeach
        </optgroup>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Foto Pegawai</strong></label>
      <input class="form-control" type="file" name="img" autocomplete="off">
      <span class="text-danger">@error('img'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Nama Pegawai</strong></label>
      <input class="form-control" type="text" id="first_name" name="nama_pegawai" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" autocomplete="off">
      <span class="text-danger">@error('nama_pegawai'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Alamat Pegawai</strong></label>
      <input class="form-control" type="text" id="first_name" name="alamat_pegawai" value="{{ old('alamat_pegawai', $pegawai->alamat_pegawai) }}" autocomplete="off">
      <span class="text-danger">@error('alamat_pegawai'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanggal Lahir</strong></label>
      <input class="form-control" type="date" id="first_name" name="tgl_lahir_pegawai" value="{{ old('tgl_lahir_pegawai', $pegawai->tgl_lahir_pegawai) }}" autocomplete="off">
      <span class="text-danger">@error('tgl_lahir_pegawai'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Jenis Kelamin</strong></label>
      <select class="form-select" name="gender_pegawai">
        <optgroup label="Gender">
          @if (old('gender_pegawai',$pegawai->gender_pegawai ) == "Laki-laki")
            <option value="{{ $pegawai->gender_pegawai }}"selected >Laki-laki</option>
            <option value="Perempuan" >Perempuan</option>
          @else
            <option value="Laki-laki" >Laki-laki</option>
            <option value="{{ $pegawai->gender_pegawai }}" selected >Perempuan</option>
          @endif
        </optgroup>
      </select>
      <span class="text-danger">@error('gender_pegawai'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Nomor Telepon Pegawai</strong></label>
      <input class="form-control" type="text" id="first_name" name="noTelp_pegawai" value="{{ old('noTelp_pegawai', $pegawai->noTelp_pegawai) }}" autocomplete="off">
      <span class="text-danger">@error('noTelp_pegawai'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Email</strong></label>
      <input class="form-control" type="email" id="first_name" name="email" value="{{ old('email', $pegawai->email) }}" autocomplete="off">
      <span class="text-danger">@error('email'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Password</strong></label>
      <input class="form-control" type="password" id="first_name" name="password" value="{{ old('password', $pegawai->password) }}" autocomplete="off">
    </div>
        
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary" name="edit">Edit</button>
      <a href="{{ route('pegawai.index') }} " type="button" class="btn btn-outline-primary">Cancel</a>
    </div>
  </form>

</div>
@endsection