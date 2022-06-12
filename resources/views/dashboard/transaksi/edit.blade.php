@extends('layouts.mainCust')
@section('customer-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Tambah Data Transaksi</h3>
  
  <form action="{{ route('transaksi.update',$transaksi->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Jenis Transaksi</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_ktp" value="{{ old('no_ktp',$transaksi->jenis_transaksi) }}" disabled>
      <span class="text-danger">@error('no_ktp'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Nama Customer</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_sim" value="{{ old('no_sim',Auth::guard('customer')->user()->nama) }}" disabled>
      <span class="text-danger">@error('no_sim'){{ $message }}@enderror</span>
    </div>
    @if ($transaksi->no_sim != NULL)
      <div class="mb-3">
        <label class="form-label" for="first_name"><strong>No. SIM</strong></label>
        <input class="form-control" type="text" id="first_name" name="no_sim" value="{{ old('no_sim',$transaksi->no_sim) }}" disabled>
        <span class="text-danger">@error('no_sim'){{ $message }}@enderror</span>
      </div>
    @endif
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>No. Tanda Pengenal</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_ktp" value="{{ old('no_ktp',Auth::guard('customer')->user()->no_pengenal) }}" disabled>
      <span class="text-danger">@error('no_ktp'){{ $message }}@enderror</span>
    </div>
    @if ($transaksi->driver_id != NULL)
      <div class="mb-3">
        <label class="form-label" for="first_name"><strong>Driver</strong></label>
        <input class="form-control" type="text" id="first_name" name="no_ktp" value="{{ old('driver_id',$transaksi->driver->nama_driver) }}" disabled>
        <span class="text-danger">@error('no_ktp'){{ $message }}@enderror</span>
      </div>
    @endif
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Aset</strong></label>
      <input class="form-control" type="text" id="first_name" name="no_ktp" value="{{ old('no_ktp',$transaksi->aset->nama_mobil) }}" disabled>
      <span class="text-danger">@error('no_ktp'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanggal Transaksi</strong></label>  
      <input class="form-control" id="time" type="text" name="tgl_waktu_mulai_sewa" value="{{ old('tgl_waktu_mulai_sewa', $transaksi->tgl_transaksi) }}" disabled>
      <span class="text-danger">@error('tgl_waktu_mulai_sewa'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanggal Mulai Sewa</strong></label>  
      <input class="form-control" id="time" type="text" name="tgl_waktu_mulai_sewa" value="{{ old('tgl_waktu_mulai_sewa', $transaksi->tgl_waktu_mulai_sewa) }}" disabled>
      <span class="text-danger">@error('tgl_waktu_mulai_sewa'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Tanggal Akhir Sewa</strong></label>  
      <input class="form-control" id="time" type="text" name="tgl_waktu_selesai_sewa" value="{{ old('tgl_waktu_selesai_sewa',$transaksi->tgl_waktu_selesai_sewa) }}" disabled>
      <span class="text-danger">@error('tgl_waktu_selesai_sewa'){{ $message }}@enderror</span>
    </div>
    @if ($transaksi->promo_id != NULL)
      <div class="mb-3">
        <label class="form-label" for="pemilik"><strong>Promo</strong></label>
        <select class="form-select" name="promo_id">
          <optgroup label="Promo">
            <option value= "" selected ></option>
            @foreach ($promo as $p)
              @if (old('promo_id',$transaksi->promo->id) == $p->id)
                <option value="{{ $p->id }}"selected>{{ $p->kode_promo }} - {{ $p->jenis_promo }}</option>
              @else
                <option value="{{ $p->id }}">{{ $p->kode_promo }} - {{ $p->jenis_promo }}</option>
              @endif
            @endforeach
          </optgroup>
        </select>
        <span class="text-danger">@error('aset_id'){{ $message }}@enderror</span>
      </div>
    @else
      <div class="mb-3">
        <label class="form-label" for="pemilik"><strong>Promo</strong></label>
        <select class="form-select" name="promo_id">
          <optgroup label="Promo">
            <option value= "" selected ></option>
            @foreach ($promo as $p)
              @if (old('promo_id') == $p->id)
                <option value="{{ $p->id }}"selected>{{ $p->kode_promo }} - {{ $p->jenis_promo }}</option>
              @else
                <option value="{{ $p->id }}">{{ $p->kode_promo }} - {{ $p->jenis_promo }}</option>
              @endif
            @endforeach
          </optgroup>
        </select>
        <span class="text-danger">@error('aset_id'){{ $message }}@enderror</span>
      </div>
    @endif
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Metode Pembayaran</strong></label>
      <select class="form-select" name="metode_pembayaran">
        <optgroup label="Metode">
          @if (old('metode_pembayaran',$transaksi->metode_pembayaran ) == "Cash")
            <option value="Cash"selected >Cash</option>
            <option value="Transfer">Transfer</option>
          @else
            <option value="Cash" >Cash</option>
            <option value="Transfer" selected>Transfer</option>
          @endif
        </optgroup>
      </select>
      <span class="text-danger">@error('metode_pembayaran'){{ $message }}@enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label" for="first_name"><strong>Upload SIM dan Kartu Pengenal</strong></label>
      <input class="form-control" type="file" name="file" value="{{ old('file') }}">
      <span class="text-danger">@error('file'){{ $message }}@enderror</span>
    </div>
    
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary" name="edit">Edit</button>
      <a href="{{ route('transaksi.indexCust') }} " type="button" class="btn btn-outline-primary">Cancel</a>
    </div>
  </form>

</div>
@endsection