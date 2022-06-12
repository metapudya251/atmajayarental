@extends('layouts.main')
@section('pegawai-view')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark mb-4">Detail Promo</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-sm-end" style="padding: 9px;">
            <a class="btn btn-primary " role="button" href="{{ route('aset.index') }}">
                <span class="text-white text">Back</span>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card  mb-3 text-dark">
        <div class="card-header bg-light py-3">
            <div class="row justify-content-between">
                <div class="col-10">
                    <h5 class="m-0 fw-bold">{{ $aset->nama_mobil}}</h5>
                </div>
                <div class="col">
                    <span class=" icon small"><i class="fas fa-circle text-primary"></i></span>
                    <span class="fw-bold text">{{ $aset->status_tersedia}}</span>
                </div>
            </div>
        </div>  
        <div class="card-body">
            <div class="row">
                <div class="col ms-5">
                    @if ($aset->img == NULL)
                        <img class="square mb-3 mt-4" src="{{ url('assets/img/avatars/avatar6.jpeg') }}"  width="160" height="160" />
                    @else
                        <img class="square mb-3 mt-4" src="{{ url('fotoaset/',$aset->img) }}"  width="160" height="160" />
                    @endif
                </div>
                <div class="col-9">
                    <table class="table">
                        <tr>
                            <th>Tipe</th>
                            <td>{{ $aset->tipe_mobil }}</td>
                        <tr>
                        <tr>
                            <th>Jenis Transmisi</th>
                            <td>{{ $aset->jenis_transmisi }}</td>
                        <tr>
                        <tr>
                            <th>Jenis Bahan Bakar</th>
                            <td>{{ $aset->jenis_bahan_bakar }}</td>
                        <tr>
                        <tr>
                            <th>Volume Bahan Bakar</th>
                            <td>{{ $aset->volume_bahan_bakar }}</td>
                        <tr>
                        <tr>
                            <th>Warna Mobil</th>
                            <td>{{ $aset->warna_mobil }}</td>
                        <tr>
                        <tr>
                            <th>Kapasitas Mobil</th>
                            <td>{{ $aset->kapasitas_mobil }}</td>
                        <tr>
                        <tr>
                            <th>Fasilitas Mobil</th>
                            <td>{{ $aset->fasilitas_mobil }}</td>
                        <tr>
                        <tr>
                            <th>Plat Nomor</th>
                            <td>{{ $aset->plat_nomor }}</td>
                        <tr>
                        <tr>
                            <th>No. STNK</th>
                            <td>{{ $aset->no_stnk }}</td>
                        <tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $aset->kategori_aset }}</td>
                        <tr>
                        <tr>
                            <th>Tanggal Sevice</th>
                            <td>{{ $aset->tanggal_service_akhir }}</td>
                        <tr>
                        <tr>
                            <th>Biaya Sewa</th>
                            <td>Rp.{{ $aset->biaya_sewa }}</td>
                        <tr>
                        @if ($aset->pemilik_id != NULL)
                            <tr>
                                <th>Nama Pemilik</th>
                                <td>{{ $aset->pemilik->nama_pemilik }}</td>
                            <tr>
                            <tr>
                                <th>Periode Mulai </th>
                                <td>{{ $aset->periode_mulai_kontrak }}</td>
                            <tr>
                            <tr>
                                <th>Periode Selesai</th>
                                <td>{{ $aset->periode_selesai_kontrak}}</td>
                            <tr>
                            
                        @endif
                        
                </table>  
                </div>
            </div>
        </div>
    </div> 
</div>

@endsection

