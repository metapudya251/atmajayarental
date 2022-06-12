@extends('layouts.main')
@section('pegawai-view')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark mb-4">Detail Pegawai</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-sm-end" style="padding: 9px;">
            <a class="btn btn-primary " role="button" href="{{ route('jadwal.index') }}">
                <span class="text-white text">Back</span>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card  mb-3 text-dark">
        <div class="card-header bg-light py-3">
            <div class="col-10">
                <p class="text-primary m-0 fw-bold">Info Pegawai</p>
            </div>
        </div>  
        <div class="card-body">
            <div class="row">
                <div class="col ms-5">
                    @if ($detail->img == NULL)
                        <img class="square mb-3 mt-4" src="{{ url('assets/img/avatars/avatar6.jpeg') }}"  width="160" height="160" />
                    @else
                        <img class="square mb-3 mt-4" src="{{ url('fotopegawai/',$detail->img) }}"  width="160" height="160" />
                    @endif
                </div>
                <div class="col-9">
                    <table class="table">
                        <tr>
                            <th>Nama Pegawai</th>
                            <td>{{ $detail->pegawai->nama_pegawai }}</td>
                        <tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $detail->pegawai->role->nama_role }}</td>
                        <tr>
                        <tr>
                            <th>Hari</th>
                            <td>{{ $detail->hari_shift}}</td>
                        <tr>
                        <tr>
                            <th>Waktu Shift</th>
                            <td>{{ $detail->jadwal->waktu_shift_mulai}} - {{ $detail->jadwal->waktu_shift_selesai}}</td>
                        <tr>
                    </table>  
                </div>
            </div>
        </div>
    </div> 
</div>

@endsection
