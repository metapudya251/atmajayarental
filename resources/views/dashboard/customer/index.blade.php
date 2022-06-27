@extends('layouts.mainCust')
@section('customer-view')

<div class="container-fluid">
    <div class="mb-3">
        <h3 class="text-dark mb-0">Dashboard</h3>
    </div>
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
      <div class="carousel slide" data-bs-ride="carousel" id="carousel-1" style="height: 311.854px; width: 100%">
        <div class="carousel-inner">
          <div class="carousel-item active"><img class="w-100 d-block" src="{{ url('assets/img/carousel/pic1.png') }}" alt="Slide Image" style="height: 311.854px" /></div>
          <div class="carousel-item"><img class="w-100 d-block" src="{{ url('assets/img/carousel/pic2.png') }}" alt="Slide Image" style="height: 311.854px" /></div>
          <div class="carousel-item"><img class="w-100 d-block" src="{{ url('assets/img/carousel/pic3.png') }}" alt="Slide Image" style="height: 311.854px" /></div>
        </div>
        <div>
          <a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a
          ><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a>
        </div>
        <ol class="carousel-indicators">
          <li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
          <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
        </ol>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-6">
        <div class="text-md-end dataTables_filter" id="dataTable_filter">
            <form action="{{ route('customer.index') }}">
                @csrf			
                <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search" name="search" value="{{ request('search') }}" autocomplete="off">
            </form>
        </div>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
      @if (count($aset))
           @foreach($aset as $aset)
            @if ($aset->status_kontrak != '0 days remaining' || $aset->pemilik_id == NULL)
              <div class="col-md-auto">
                <div class="card h-100" style="width: 14rem;">
                    @if ($aset->img == NULL)
                        <img class="img-fluid square mb-3 card-img-top" src="{{ url('assets/img/avatars/avatar6.jpeg') }}"  style="width: 14rem; height: 14rem" >
                    @else
                        <img class="img-fluid square mb-3 card-img-top" src="{{ url('fotoaset/',$aset->img) }}"  style="width: 14rem; height: 14rem" >
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $aset->nama_mobil }}</h5> 
                        <p class="card-text">Harga Sewa Mobil : Rp.{{ $aset->biaya_sewa }}</p>
                        <p class="card-text">Jenis Transmisi {{ $aset->jenis_transmisi }}</p>
                        <p class="card-text">Kapasitas {{ $aset->kapasitas_mobil }}</p>
                    </div>
                    @if ($aset->status_tersedia == 'Tersedia')
                        <div class="card-footer ">
                          <a href="{{ route('transaksi.create',$aset->id) }} " type="button" class="btn btn-primary">Booking</a>
                        </div>
                    @else
                        <div class="card-footer bg-warning">
                            <small class="text-dark">{{ $aset->status_tersedia }}</small>
                        </div>
                    @endif
                </div>
              </div>
            @endif
           @endforeach
      {{-- @else
          <h5 class="card-title">Tidak ada</h5>  --}}
      @endif
  </div>
</div>

@endsection
