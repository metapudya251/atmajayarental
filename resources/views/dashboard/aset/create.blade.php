@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Tambah Data Aset</h3>

  <form action="{{ route('aset.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Foto Mobil</strong></label>
      <input class="form-control" type="file" name="img" value="{{ old('img') }}">
      <span class="text-danger">@error('img'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Nama Mobil</strong></label>
      <input class="form-control" type="text" id="first_name" name="nama_mobil" value="{{ old('nama_mobil') }}">
      <span class="text-danger">@error('nama_mobil'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tipe Mobil</strong></label>
      <input class="form-control" type="text" id="first_name" name="tipe_mobil" value="{{ old('tipe_mobil') }}">
      <span class="text-danger">@error('tipe_mobil'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Jenis Transmisi</strong></label>
      <input class="form-control" type="text" id="first_name" name="jenis_transmisi" value="{{ old('jenis_transmisi') }}">
      <span class="text-danger">@error('jenis_transmisi'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Jenis Bahan Bakar</strong></label>
      <input class="form-control" id="first_name" name="jenis_bahan_bakar" value="{{ old('jenis_bahan_bakar') }}">
      <span class="text-danger">@error('jenis_bahan_bakar'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Volume Bahan Bakar</strong></label>
      <input class="form-control" id="first_name" name="volume_bahan_bakar" value="{{ old('volume_bahan_bakar') }}">
      <span class="text-danger">@error('volume_bahan_bakar'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Warna Mobil</strong></label>
      <input class="form-control" id="first_name" name="warna_mobil" value="{{ old('warna_mobil') }}">
      <span class="text-danger">@error('warna_mobil'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Kapasitas Mobil</strong></label>
      <select class="form-select" name="kapasitas_mobil">
        <optgroup label="kapasitas_mobil">
          @if (old('kapasitas_mobil') == "4")
            <option value= 4 selected >4</option>
            <option value=6 >6</option>
            <option value=8 >8</option>
          @endif
          @if (old('kapasitas_mobil' ) == "6")
            <option value=4 >4</option>
            <option value=6 selected  >6</option>
            <option value=8 >8</option>
          @endif
          @if (old('kapasitas_mobil' ) == "8")
            <option value=4 >4</option>
            <option value=6 >6</option>
            <option value=8 selected  >8</option>
          @endif
          @if (old('kapasitas_mobil' ) != "8" && old('kapasitas_mobil') != "6" && old('kapasitas_mobil' ) != "4" )
            <option value=4 >4</option>
            <option value=6 >6</option>
            <option value=8 >8</option>
          @endif
        </optgroup>
      </select>
      <span class="text-danger">@error('kapasitas_mobil'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Fasilitas Mobil</strong></label>
      <input class="form-control" id="first_name" name="fasilitas_mobil" value="{{ old('fasilitas_mobil') }}">
      <span class="text-danger">@error('fasilitas_mobil'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Plat Nomor</strong></label>
      <input class="form-control" id="first_name" name="plat_nomor" value="{{ old('plat_nomor') }}">
      <span class="text-danger">@error('plat_nomor'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>No STNK</strong></label>
      <input class="form-control" id="first_name" name="no_stnk" value="{{ old('no_stnk') }}">
      <span class="text-danger">@error('no_stnk'){{ $message }}@enderror</span>
    </div>

    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanggal Service Akhir</strong></label>
      <input class="form-control" id="first_name"  type="date" name="tanggal_service_akhir" value="{{ old('tanggal_service_akhir') }}" autocomplete="off">
      <span class="text-danger">@error('tanggal_service_akhir'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Status Mobil</strong></label>
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
      <label class="form-label" for="first_name"><strong>Biaya Sewa</strong></label>
      <input class="form-control" id="first_name" name="biaya_sewa" value="{{ old('biaya_sewa') }}" autocomplete="off">
      <span class="text-danger">@error('biaya_sewa'){{ $message }}@enderror</span>
    </div>		

    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Apakah mobil memiliki pemilik ?</strong></label>
      <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button type="button" class="btn2 btn btn-warning">YES</button>
        {{-- <button type="button" class="btn1 btn btn-danger"> <a href="{{ route('aset.changeKategori') }}"></a> NO</button> --}}
      </div>
    </div>

    <hr>
    <div id="myDIV" style="display: none">
      <div class="mb-3">
        <label class="form-label" for="pemilik"><strong>Pemilik</strong></label>
        <select class="form-select" name="pemilik_id">
          <optgroup label="Pemilik">
            <option value= 0 selected ></option>
            @foreach ($pemilik as $pemilik)
              @if (old('pemilik_id') == $pemilik->id)
                <option value="{{ $pemilik->id }}">{{ $pemilik->nama_pemilik }}</option>
              @else
                <option value="{{ $pemilik->id }}">{{ $pemilik->nama_pemilik }}</option>
              @endif
            @endforeach
          </optgroup>
        </select>
        <a href="{{ route('pemilik.add') }}"><p class="text-end">Create New...</p></a>
      </div>

      <div class="mb-3">
        <label class="form-label" for="first_name"><strong>Periode Kontrak Mulai</strong></label>
        <input class="form-control" id="first_name"  type="date" name="periode_mulai_kontrak" value="{{ old('periode_mulai_kontrak') }}" autocomplete="off">
        <span class="text-danger">@error('periode_mulai_kontrak'){{ $message }}@enderror</span>
      </div>

      <div class="mb-3">
        <label class="form-label" for="first_name"><strong>Periode Kontrak Selesai</strong></label>
        <input class="form-control" id="first_name"  type="date" name="periode_selesai_kontrak" value="{{ old('periode_selesai_kontrak') }}" autocomplete="off">
        <span class="text-danger">@error('periode_mulai_kontrak'){{ $message }}@enderror</span>
      </div>
    </div>

    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary" name="Tambah">Tambah</button>
      <a href="{{ route('aset.index') }} " type="button" class="btn btn-outline-primary">Cancel</a>
    </div>
  </form>
</div>

<script>
  $(document).ready(function(){
    $(".btn1").click(function(){
      $("#myDIV").hide();
    });
    $(".btn2").click(function(){
      $("#myDIV").show();
    });
  });
</script>
@endsection