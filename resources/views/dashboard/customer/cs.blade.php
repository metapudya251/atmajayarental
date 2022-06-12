@extends('layouts.main')
@section('pegawai-view')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark">Data Customer</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-sm-end" style="padding: 9px;">
            <a class="btn btn-success btn-icon-split" role="button" href="{{ route('customer.create') }}">
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
    {{-- Disini tdi tempat isi jumlah jumlah gtu --}}
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Info Customer</p>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <div class="text-md-end dataTables_filter" id="dataTable_filter">
                    <form action="{{ route('customer.read') }}">
                        @csrf			
                        <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search" name="search" value="{{ request('search') }}" autocomplete="off">
                    </form>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No Customer</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if (count($customer))
                                @foreach($customer as $cus)
                                    <tr>
                                        <td>{{ $cus->no_customer}}</td>
                                        @if ($cus->img == NULL)
                                            <td><img class="rounded-circle me-2" width="30" height="30" src="{{ url('assets/img/avatars/avatar6.jpeg') }}">{{ $cus->nama }}</td>
                                        @else
                                            <td><img class="rounded-circle me-2" width="30" height="30" src="{{ url('fotocust/',$cus->img) }}">{{ $cus->nama }}</td>
                                        @endif
                                        <td>{{ $cus->gender}}</td>
                                        <td>{{ $cus->email }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('customer.destroy',$cus->id) }}">
                                                <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('customer.show', $cus->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('customer.destroy',$cus->id)}}"><i class="fas fa-trash text-white"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td align="center" colspan="4">Data Masih Kosong</td>
                                </tr>
                            @endif
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>No Customer</strong></td>
                            <td><strong>Nama</strong></td>
                            <td><strong>Gender</strong></td>
                            <td><strong>Email</strong></td>
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
