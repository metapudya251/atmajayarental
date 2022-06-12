@extends('layouts.mainCust')
@section('customer-view')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Tambah Data Transaksi</h3>
  <p>
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Pemesanan dengan Driver</a>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Pemesanan tanpa Driver</button>
  </p>
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample1">
      <div class="card card-body">
        <form action="{{ route('transaksi.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label" for="pemilik"><strong>Nama Customer</strong></label>
            <input class="form-control" id="time" type="hidden" name="customer_id" value="{{ Auth::guard('customer')->user()->id }}">
            <select class="form-select" name="customer_id" disabled>
              <optgroup label="Customer">
                @foreach ($customer as $cust)
                  @if (old('customer_id',Auth::guard('customer')->user()->id) == $cust->id)
                    <option value="{{ $cust->id }}"selected>{{ $cust->nama }}</option>
                  @else
                    <option value="{{ $cust->id }}">{{ $cust->nama }}</option>
                  @endif
                @endforeach
              </optgroup>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>No. Tanda Pengenal</strong></label>
            <input class="form-control" type="text" id="first_name" name="no_ktp" value="{{ Auth::guard('customer')->user()->no_pengenal }}" disabled>
            <span class="text-danger">@error('no_ktp'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="pemilik"><strong>Aset</strong></label>
            <input class="form-control" id="time" type="hidden" name="aset_id" value="{{ $mobil->id }}">
            <input class="form-control" id="time" type="text" name="aset_id" value="{{ $mobil->nama_mobil }}" disabled>
            <span class="text-danger">@error('aset_id'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="pemilik"><strong>Nama Driver</strong></label>
            <select class="form-select" name="driver_id">
              <optgroup label="Driver">
                @foreach ($driver as $d)
                  @if (old('customer_id',Auth::guard('customer')->user()->id) == $cust->id)
                    <option value="{{ $d->id }}"selected>
                      @if ($d->img == NULL)
                        <img class="rounded-circle me-2" width="10" height="10" src="{{ url('assets/img/avatars/avatar6.jpeg') }}">{{ $d->nama_driver }}
                      @else
                        <img class="rounded-circle me-2" width="10" height="10" src="{{ url('fotodriver/',$d->img) }}">{{ $d->nama_driver}}
                      @endif
                    </option>
                  @else
                    <option value="{{ $d->id }}">
                      @if ($d->img == NULL)
                        <img class="rounded-circle me-2" width="10" height="10" src="{{ url('assets/img/avatars/avatar6.jpeg') }}">{{ $d->nama_driver }}
                      @else
                        <img class="rounded-circle me-2" width="10" height="10" src="{{ url('fotodriver/',$d->img) }}">{{ $d->nama_driver}}
                      @endif
                    </option>
                  @endif
                @endforeach
              </optgroup>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>Tanggal Transaksi</strong></label>  {{-- notsupportininternetexplorerorsafari --}}
            <input class="form-control" id="time" type="datetime-local" name="tgl_transaksi" value="{{ Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i') }}">
            <span class="text-danger">@error('tgl_transaksi'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>Tanggal Mulai Sewa</strong></label>  {{-- notsupportininternetexplorerorsafari --}}
            <input class="form-control" id="time" type="datetime-local" name="tgl_waktu_mulai_sewa" value="{{ old('tgl_waktu_mulai_sewa') }}">
            <span class="text-danger">@error('tgl_waktu_mulai_sewa'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>Tanggal Akhir Sewa</strong></label>  {{-- notsupportininternetexplorerorsafari --}}
            <input class="form-control" id="time" type="datetime-local" name="tgl_waktu_selesai_sewa" value="{{ old('tgl_waktu_selesai_sewa') }}">
            <span class="text-danger">@error('tgl_waktu_selesai_sewa'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>Metode Pembayaran</strong></label>
            <select class="form-select" name="metode_pembayaran">
              <optgroup label="Metode">
                @if (old('metode_pembayaran' ) == "Cash")
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
            <label class="form-label" for="first_name"><strong>Jenis Transaksi</strong></label>
            <input class="form-control" type="hidden" name="jenis_transaksi" value="Penyewaan Mobil + Driver">
            <select class="form-select" name="jenis_transaksi">
              <optgroup label="Jenis">
                  <option value="Penyewaan Mobil + Driver" selected >Penyewaan Mobil + Driver</option>
                  <option value="Penyewaan Mobil">Penyewaan Mobil</option>
              </optgroup>
            </select>
            <span class="text-danger">@error('jenis_transaksi'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="pemilik"><strong>Promo</strong></label>
            <select class="form-select" name="promo_id">
              <optgroup label="Promo">
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
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>Upload SIM dan Kartu Pengenal</strong></label>
            <input class="form-control" type="file" name="file" value="{{ old('file') }}">
            <span class="text-danger">@error('file'){{ $message }}@enderror</span>
          </div>
              
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" name="Tambah">Tambah</button>
            <a href="{{ route('customer.index') }} " type="button" class="btn btn-outline-primary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample2">
      <div class="card card-body">
        <form action="{{ route('transaksi.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label" for="pemilik"><strong>Nama Customer</strong></label>
            <input class="form-control" id="time" type="hidden" name="customer_id" value="{{ Auth::guard('customer')->user()->id }}">
            <select class="form-select" name="customer_id" disabled>
              <optgroup label="Customer">
                @foreach ($customer as $cust)
                  @if (old('customer_id',Auth::guard('customer')->user()->id) == $cust->id)
                    <option value="{{ $cust->id }}"selected>{{ $cust->nama }}</option>
                  @else
                    <option value="{{ $cust->id }}">{{ $cust->nama }}</option>
                  @endif
                @endforeach
              </optgroup>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>No. Tanda Pengenal</strong></label>
            <input class="form-control" type="text" id="first_name" name="no_ktp" value="{{ old('no_ktp',Auth::guard('customer')->user()->no_pengenal) }}" disabled>
            <span class="text-danger">@error('no_ktp'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>No. SIM</strong></label>
            <input class="form-control" type="text" id="first_name" name="no_sim" value="{{ old('no_sim') }}">
            <span class="text-danger">@error('no_sim'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="pemilik"><strong>Aset</strong></label>
            <input class="form-control" id="time" type="hidden" name="aset_id" value="{{ $mobil->id }}">
            <input class="form-control" id="time" type="text" name="aset_id" value="{{ $mobil->nama_mobil }}" disabled>
            <span class="text-danger">@error('aset_id'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>Tanggal Transaksi</strong></label>  {{-- notsupportininternetexplorerorsafari --}}
            <input class="form-control" id="time" type="datetime-local" name="tgl_transaksi" value="{{ Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i') }}">
            <span class="text-danger">@error('tgl_transaksi'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>Tanggal Mulai Sewa</strong></label>  {{-- notsupportininternetexplorerorsafari --}}
            <input class="form-control" id="time" type="datetime-local" name="tgl_waktu_mulai_sewa" value="{{ old('tgl_waktu_mulai_sewa') }}">
            <span class="text-danger">@error('tgl_waktu_mulai_sewa'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>Tanggal Akhir Sewa</strong></label>  {{-- notsupportininternetexplorerorsafari --}}
            <input class="form-control" id="time" type="datetime-local" name="tgl_waktu_selesai_sewa" value="{{ old('tgl_waktu_selesai_sewa') }}">
            <span class="text-danger">@error('tgl_waktu_selesai_sewa'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>Metode Pembayaran</strong></label>
            <select class="form-select" name="metode_pembayaran">
              <optgroup label="Metode">
                @if (old('metode_pembayaran' ) == "Cash")
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
            <label class="form-label" for="first_name"><strong>Jenis Transaksi</strong></label>
            <input class="form-control" type="hidden" name="jenis_transaksi" value="Penyewaan Mobil + Driver">
            <select class="form-select" name="jenis_transaksi" >
              <optgroup label="Jenis">
                  <option value="Penyewaan Mobil + Driver"  >Penyewaan Mobil + Driver</option>
                  <option value="Penyewaan Mobil"selected>Penyewaan Mobil</option>
              </optgroup>
            </select>
            <span class="text-danger">@error('jenis_transaksi'){{ $message }}@enderror</span>
          </div>
          <div class="mb-3">
            <label class="form-label" for="pemilik"><strong>Promo</strong></label>
            <select class="form-select" name="promo_id">
              <optgroup label="Promo">
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
          <div class="mb-3">
            <label class="form-label" for="first_name"><strong>Upload SIM dan Kartu Pengenal</strong></label>
            <input class="form-control" type="file" name="file" value="{{ old('file') }}">
            <span class="text-danger">@error('file'){{ $message }}@enderror</span>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" name="Tambah">Tambah</button>
            <a href="{{ route('customer.index') }} " type="button" class="btn btn-outline-primary">Cancel</a>
          </div>
        </form>     
      </div>
    </div>
  </div>
</div>
@endsection