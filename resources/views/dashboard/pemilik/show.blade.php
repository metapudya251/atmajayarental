@extends('layouts.main')
@section('pegawai-view')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark mb-4">Detail Pemilik</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-sm-end" style="padding: 9px;">
            <a class="btn btn-primary " role="button" href="{{ route('pemilik.index') }}">
                <span class="text-white text">Back</span>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card-body">
        <div class="row">
            <div class="col-9">
                <table class="table">
                    <tr>
                        <th>ID Pemilik</th>
                        <td>{{ $pemilik->id }}</td>
                    <tr>
                    <tr>
                        <th>No. KTP Pemilik</th>
                        <td>{{ $pemilik->no_ktp }}</td>
                    <tr>
                    <tr>
                        <th>Nama Pemilik</th>
                        <td>{{ $pemilik->nama_pemilik }}</td>
                    <tr>
                    <tr>
                        <th>Alamat Pemilik</th>
                        <td>{{ $pemilik->alamat_pemilik }}</td>
                    <tr>
                    <tr>
                        <th>No Telpon Pemilik</th>
                        <td>{{ $pemilik->noTelp_pemilik }}</td>
                    <tr>
                </table>  
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @if (count($aset))
                 @foreach($aset as $aset)
                 <div class="col">
                    <div class="card h-100" style="width: 14rem;">
                        @if ($aset->img == NULL)
                            <img class="img-fluid square mb-3 card-img-top" src="{{ url('assets/img/avatars/avatar6.jpeg') }}"  style="width: 14rem; height: 14rem" >
                        @else
                            <img class="img-fluid square mb-3 card-img-top" src="{{ url('fotoaset/',$aset->img) }}"  style="width: 14rem; height: 14rem" >
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $aset->nama_mobil }}</h5> 
                            <p class="card-text">Harga Sewa Mobil : Rp.{{ $aset->biaya_sewa }}</p>
                            <p class="card-text">Periode mulai kontrak   : {{ $aset->periode_mulai_kontrak }}</p>
                            <p class="card-text">Periode selesai kontrak : {{ $aset->periode_selesai_kontrak }}</p>
                        </div>
                        @if ($aset->status_kontrak == "On going")
                            <div class="card-footer bg-success">
                                <small class="text-dark">{{ $aset->status_kontrak }}</small>
                            </div>
                        @else
                            <div class="card-footer bg-warning">
                                <small class="text-dark">{{ $aset->status_kontrak }}</small>
                            </div>
                        @endif
                    </div>
                </div>
                 @endforeach
            {{-- @else
                <h5 class="card-title">Tidak ada</h5>  --}}
            @endif
        </div>
    </div>
</div>

@endsection
