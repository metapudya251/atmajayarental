@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Tambah Jadwal Shift Pegawai</h3>
  @if ($message = Session::get('failed'))
    <div class="alert alert-danger">
      <p>{{ $message }}</p>
    </div>
  @endif
  @if ($message = Session::get('fail'))
    <div class="alert alert-danger">
      <p>{{ $message }}</p>
    </div>
  @endif
  <form action="{{ route('jadwal.store') }}" method="post">
    @csrf
    <div class="mb-3">
      <label class="form-label" for="pegawai"><strong>Pegawai</strong></label>
      <select class="form-select" name="pegawai_id">
        <optgroup label="Pegawai">
          <option value="" selected></option>
          @foreach ($pegawai as $pgw)
            @if (old('pegawai_id')==$pgw->id)
              @if ($pgw->role->nama_role != 'Manager')
                <option value="{{ $pgw->id }}"selected>{{ $pgw->nama_pegawai }} - {{ $pgw->role->nama_role }}</option>
              @endif
            @else
              @if ($pgw->role->nama_role != 'Manager')
                <option value="{{ $pgw->id }}">{{ $pgw->nama_pegawai }} - {{ $pgw->role->nama_role }}</option>
              @endif
            @endif
          @endforeach
        </optgroup>
      </select>
      <span class="text-danger">@error('pegawai_id'){{ $message }}@enderror</span>
    </div>

    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Hari Shift</strong></label>
      <select class="form-select" name="hari_shift" aria-placeholder="Hari shift ...">
        <optgroup label="Hari Shift">
          @if (old('hari_shift') == "Selasa")
            <option value="Selasa"selected >Selasa</option>
            <option value="Rabu" >Rabu</option>
            <option value="Kamis" >Kamis</option>
            <option value="Jumat" >Jumat</option>
            <option value="Sabtu" >Sabtu</option>
            <option value="Minggu" >Minggu</option>
          @endif
          @if (old('hari_shift') == "Rabu")
            <option value="Selasa">Selasa</option>
            <option value="Rabu" selected >Rabu</option>
            <option value="Kamis" >Kamis</option>
            <option value="Jumat" >Jumat</option>
            <option value="Sabtu" >Sabtu</option>
            <option value="Minggu" >Minggu</option>
          @endif
          @if (old('hari_shift') == "Kamis")
            <option value="Selasa">Selasa</option>
            <option value="Rabu" >Rabu</option>
            <option value="Kamis" selected >Kamis</option>
            <option value="Jumat" >Jumat</option>
            <option value="Sabtu" >Sabtu</option>
            <option value="Minggu" >Minggu</option>
          @endif
          @if (old('hari_shift') == "Jumat")
            <option value="Selasa">Selasa</option>
            <option value="Rabu" >Rabu</option>
            <option value="Kamis" >Kamis</option>
            <option value="Jumat" selected>Jumat</option>
            <option value="Sabtu" >Sabtu</option>
            <option value="Minggu" >Minggu</option>
          @endif
          @if (old('hari_shift') == "Sabtu")
            <option value="Selasa">Selasa</option>
            <option value="Rabu" >Rabu</option>
            <option value="Kamis" >Kamis</option>
            <option value="Jumat" >Jumat</option>
            <option value="Sabtu" selected >Sabtu</option>
            <option value="Minggu" >Minggu</option>
          @endif
          @if(old('hhari_shift') == "Minggu")
            <option value="Selasa">Selasa</option>
            <option value="Rabu" >Rabu</option>
            <option value="Kamis" >Kamis</option>
            <option value="Jumat" >Jumat</option>
            <option value="Sabtu" >Sabtu</option>
            <option value="Minggu"selected>Minggu</option>
          @endif
          @if ((old('hari_shift') != "Minggu") && (old('hari_shift') != "Sabtu") && (old('hari_shift') != "Jumat") && (old('hari_shift') != "Kamis") &&  (old('hari_shift') != "Rabu") && (old('hari_shift') != "Selasa"))
            <option value="" selected></option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu" >Rabu</option>
            <option value="Kamis" >Kamis</option>
            <option value="Jumat" >Jumat</option>
            <option value="Sabtu" >Sabtu</option>
            <option value="Minggu">Minggu</option>
          @endif
        </optgroup>
      </select>
      <span class="text-danger">@error('hari_shift'){{ $message }}@enderror</span>
    </div>

    <div class="mb-3">
      <label class="form-label" for="jadwal"><strong>Waktu Shift</strong></label>
      <select class="form-select" name="jadwal_id">
        <optgroup label="Waktu Shift">
          <option value="" selected></option>
          @foreach ($jadwal as $jadwal)
            @if (old('jadwal_id')==$jadwal->id)
              <option value="{{ $jadwal->id }}" selected>{{ $jadwal->waktu_shift_mulai }} - {{ $jadwal->waktu_shift_selesai }}</option>
            @else
              <option value="{{ $jadwal->id }}">{{ $jadwal->waktu_shift_mulai }} - {{ $jadwal->waktu_shift_selesai }}</option>
            @endif
          @endforeach
        </optgroup>
      </select>
      <span class="text-danger">@error('jadwal_id'){{ $message }}@enderror</span>
    </div>
        
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary" name="Tambah">Tambah</button>
      <a href="{{ route('jadwal.index') }} " type="button" class="btn btn-outline-primary">Cancel</a>
    </div>
  </form>

</div>
@endsection