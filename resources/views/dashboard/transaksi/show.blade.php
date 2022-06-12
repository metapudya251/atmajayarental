@extends('layouts.main')
@section('pegawai-view')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark mb-4">Detail Pegawai</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-sm-end" style="padding: 9px;">
            <a class="btn btn-primary " role="button" href="{{ route('transaksi.indexTransaksi') }}">
                <span class="text-white text">Back</span>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card  mb-3 text-dark">
        <div class="card-header bg-light py-3">
            <div class="col-10">
                <p class="text-primary m-0 fw-bold">Info Transaksi</p>
            </div>
        </div>  
        <div class="card-body">
            <div class="row">
                <div class="col ms-5">
                    @if ($transaksi->customer->img == NULL)
                        <img class="square mb-3 mt-4" src="{{ url('assets/img/avatars/avatar6.jpeg') }}"  width="160" height="160" />
                    @else
                        <img class="square mb-3 mt-4" src="{{ url('fotocust/',$transaksi->customer->img) }}"  width="160" height="160" />
                    @endif
                </div>
                <div class="col-9">
                    <table class="table">
                        <tr>
                            <th>Nama Customer</th>
                            <td>{{ $transaksi->customer->nama }}</td>
                        <tr>
                        <tr>
                            <th>No. Tanda Pengenal</th>
                            <td>{{$transaksi->customer->no_pengenal }}</td>
                        <tr>
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <td>{{ date('d M Y  H:i', strtotime($transaksi->tgl_transaksi)) }}</td>
                        <tr>
                        <tr>
                            <th>Tanggal Mulai Sewa</th>
                            <td>{{ date('d M Y  H:i', strtotime($transaksi->tgl_waktu_mulai_sewa)) }}</td>
                        <tr>
                        <tr>
                            <th>Tanggal Selesai Sewa</th>
                            <td>{{ date('d M Y  H:i', strtotime($transaksi->tgl_waktu_selesai_sewa)) }}</td>
                        <tr>
                        <tr>
                            <th>Jenis Transaksi</th>
                            <td>{{ $transaksi->jenis_transaksi }}</td>
                        <tr>
                        <tr>
                            <th>Mobil</th>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        @if ($transaksi->aset->img == NULL)
                                            <img class="rounded-circle me-2" src="{{ url('assets/img/avatars/avatar6.jpeg') }}"  width="160" height="160" />
                                        @else
                                            <img class="rounded-circle me-2" src="{{ url('fotoaset/',$transaksi->aset->img) }}"  width="160" height="160" />
                                        @endif
                                    </div>
                                    <div class="col">
                                        <p>{{ $transaksi->aset->nama_mobil }} <br>
                                            {{ $transaksi->aset->plat_nomor }} <br>
                                            {{ $transaksi->aset->jenis_transmisi}}
                                    </div>
                                </div>
                            </td>
                        <tr>
                        @if ($transaksi->status_pembayaran == 'Lunas')
                            <tr>
                                <th>Status Pembayaran</th>
                                <td><span class="badge bg-success">{{ $transaksi->status_pembayaran }}</span></td>
                            <tr>
                        @else
                        <tr>
                            <th>Status Pembayaran</th>
                            <td><span class="badge bg-warning">{{ $transaksi->status_pembayaran }}</span></td>
                        <tr>
                        @endif
                        <tr>
                            <th>Status Verifikasi</th>
                            <td><span class="badge bg-success">{{ $transaksi->status_verifikasi }} </span></td>
                        <tr>
                        @if ($transaksi->status_transaksi == 'Selesai')
                        <tr>
                            <th>Status Transaksi</th>
                            <td><span class="badge bg-success">{{ $transaksi->status_transaksi }}</span></td>
                        <tr>
                        @else
                        <tr>
                            <th>Status Transaksi</th>
                            <td><span class="badge bg-warning">{{ $transaksi->status_transaksi }}</span></td>
                        <tr>  
                        @endif
                        <tr>
                            <th>Total</th>
                            <td>Rp.{{ $transaksi->total_biaya_sewa }}</td>
                        <tr>
                        <tr>
                            <th>File Dokumen SIM dan Kartu Pelajar/KTP</th>
                            <td><a class="btn btn-info" role="button" href="{{ url('filecust/',$transaksi->file) }}">LIHAT DISINI</a></td>
                        <tr>
                        <tr>
                            <th>Bukti Pembayaran</th>
                            <td><a class="btn btn-info" role="button" href="{{ url('bukti/',$transaksi->buktiBayar) }}">LIHAT DISINI</a></td>
                        <tr>
                    </table>  
                </div>
            </div>
            <div class="d-grid gap-2">
                <a class="btn btn-success" role="button" href="{{ route('transaksi.updateBayar',$transaksi->id) }}">VERIFIKASI PEMBAYARAN</a>
            </div>
        </div>
    </div> 
</div>

@endsection
