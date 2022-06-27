@extends('layouts.main')
@section('pegawai-view')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark">Data Aset</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-sm-end" style="padding: 9px;">
            <a class="btn btn-success btn-icon-split" role="button" href="{{ route('aset.create') }}">
                <span class="text-white-50 icon"><i class="fas fa-check"></i></span>
                <span class="text-white text">Tambah Data</span>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('failed'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Info Aset</p>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <div class="text-md-end dataTables_filter" id="dataTable_filter">
                    <form action="{{ route('aset.index') }}">
                        @csrf			
                        <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search" name="search" value="{{ request('search') }}" autocomplete="off">
                    </form>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">Nama Mobil</th>
                            <th scope="col">Jenis Transmisi</th>
                            <th scope="col">Kategori Aset</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Status Tersedia</th>
                            <th scope="col">Status Kontrak</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if (count($aset))
                                @foreach($aset as $aset)
                                <tr>
                                    <td>{{ $aset->nama_mobil}}</td>
                                    <td>{{ $aset->jenis_transmisi}}</td>
                                    <td>{{ $aset->kategori_aset}}</td>
                                    <td>{{ $aset->biaya_sewa}}</td>
                                    @if ($aset->status_tersedia == "Tersedia")
                                        <td><span class="badge bg-success">{{ $aset->status_tersedia}}</span></td>
                                    @else
                                        <td><span class="badge bg-danger">{{ $aset->status_tersedia}}</span></td>
                                    @endif
                                    @if ($aset->kategori_aset == 'Pribadi')
                                        @if ($aset->status_kontrak == 'On going')
                                            <td><span class="badge bg-success">{{ $aset->status_kontrak}}</span></td>
                                        @else
                                            <td><span class="badge bg-warning">{{ $aset->status_kontrak}}</span></td>
                                        @endif
                                    @else
                                        <td>{{ $aset->status_kontrak}}</td>
                                    @endif
                                    <td class="text-center">
                                        <form action="{{ route('aset.destroy',$aset->id) }}">
                                            <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('aset.edit', $aset->id) }}"><i class="fas fa-pen text-white"></i></a>
                                            <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('aset.show', $aset->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('aset.destroy',$aset->id)}}"><i class="fas fa-trash text-white"></i></a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td align="center" colspan="4">Data Tidak Ditemukan</td>
                                </tr>
                            @endif
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Nama Mobil</strong></td>
                            <td><strong>Jenis Transmisi</strong></td>
                            <td><strong>Kategori Aset</strong></td>
                            <td><strong>Harga</strong></td>
                            <td><strong>Status</strong></td>
                            <td><strong>Status</strong></td>
                            <td><strong>Action</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Pagination --}}
            {{-- <div class="col">
                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                    </ul>
                </nav>
            </div> --}}
        </div>
    </div>
</div>

@endsection
