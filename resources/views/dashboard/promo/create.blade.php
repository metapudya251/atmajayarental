@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Tambah Data Promo</h3>

  <form action="{{ route('promo.store') }}" method="post">
    @csrf
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Kode Promo</strong></label>
      <input class="form-control" type="text" id="first_name" name="kode_promo" value="{{ old('kode_promo') }}">
      <span class="text-danger">@error('kode_promo'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Jenis Promo</strong></label>
      <input class="form-control" type="text" id="first_name" name="jenis_promo" value="{{ old('jenis_promo') }}">
      <span class="text-danger">@error('jenis_promo'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Diskon Promo</strong></label>
      <p class="small">Format penulisan diskon, contoh: 0.25 atau max : 1</p>
      <input class="form-control" type="text" id="first_name" name="diskon_promo" value="{{ old('diskon_promo') }}">
      <span class="text-danger">@error('diskon_promo'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Keterangan</strong></label>
      <input class="form-control" id="first_name" name="keterangan" value="{{ old('keterangan') }}">
      <span class="text-danger">@error('keterangan'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
        <label class="form-label" for="first_name"><strong>Status Promo</strong></label>
        <select class="form-select" name="status_promo">
          <optgroup label="Status Promo">
            @if (old('status_promo' ) == "Aktif")
              <option value="Aktif"selected >Aktif</option>
              <option value="Tidak Aktif" >Tidak Aktif</option>
            @else
              <option value="Aktif" >Aktif</option>
              <option value="Tidak Aktif" selected >Tidak Aktif</option>
            @endif
          </optgroup>
        </select>
        <span class="text-danger">@error('status_promo'){{ $message }}@enderror</span>
      </div>
        
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary" name="Tambah">Tambah</button>
      <a href="{{ route('promo.index') }} " type="button" class="btn btn-outline-primary">Cancel</a>
    </div>
  </form>

</div>
@endsection