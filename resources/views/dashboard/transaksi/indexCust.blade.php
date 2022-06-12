@extends('layouts.mainCust')
@section('customer-view')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark">Data Transaksi</h3>
        </div>
    </div>
</div>
<div class="container-fluid mt-3">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    {{-- Disini tdi tempat isi jumlah jumlah gtu --}}
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Table Transaksi</p>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <div class="text-md-end dataTables_filter" id="dataTable_filter">
                    <form action="{{ route('transaksi.indexCust') }}">
                        @csrf			
                        <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search" name="search" value="{{ request('search') }}" autocomplete="off">
                    </form>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No. Tranaksi</th>
                            <th scope="col">Nama Customer</th>
                            <th scope="col">Nama Mobil</th>
                            <th scope="col">Jenis Peminjaman</th>
                            <th scope="col">Tanggal Mulai Sewa</th>
                            <th scope="col">Tanggal Selesai Sewa</th>
                            <th scope="col">Status Transaksi</th>
                            <th scope="col">Status Verifikasi</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if (count($transaksi))
                                @foreach($transaksi as $tr)
                                <tr>
                                    @if ($tr->customer_id == Auth::guard('customer')->user()->id)
                                            <td>{{ $tr->no_transaksi }}</td>
                                            <td>{{ $tr->customer->nama }}</td>
                                            <td>{{ $tr->aset->nama_mobil }}</td>
                                            <td>{{ $tr->jenis_transaksi }}</td>
                                            <td>{{ date('d M Y', strtotime($tr->tgl_waktu_mulai_sewa)) }}</td>
                                            <td>{{ date('d M Y', strtotime($tr->tgl_waktu_selesai_sewa)) }}</td>
                                            @if ($tr->status_transaksi == "Selesai")
                                            <td><span class="badge bg-success">{{ $tr->status_transaksi }}</span></td>
                                            @else
                                            <td><span class="badge bg-warning">{{ $tr->status_transaksi }}</span></td>
                                            @endif
                                            @if ($tr->status_verifikasi == "Verified")
                                            <td><span class="badge bg-success">{{ $tr->status_verifikasi }}</span></td>
                                            @else
                                            <td><span class="badge bg-warning">{{ $tr->status_verifikasi }}</span></td>
                                            @endif
                                            @if ($tr->status_pembayaran == "Lunas")
                                            <td><span class="badge bg-success">{{ $tr->status_pembayaran }}</span></td>
                                            @else
                                            <td><span class="badge bg-warning">{{ $tr->status_pembayaran }}</span></td>
                                            @endif
                                            <td class="text-center">
                                                <form action="{{ route('transaksi.destroy',$tr->id) }}">
                                                    @if ($tr->status_pembayaran != 'Lunas Menunggu Verifikasi' && $tr->status_pembayaran != 'Lunas')
                                                        <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('transaksi.edit', $tr->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    @endif
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('transaksi.showCust', $tr->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    <a class="btn btn-warning btn-circle ms-1" role="button" href="{{ url('filecust/',$tr->file) }}"><i class="fas fa fa-file text-white"></i></a>
                                                    @if ($tr->status_verifikasi == 'Not Verified')
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('transaksi.destroy',$tr->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                    @endif
                                                </form>
                                                
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td align="center" colspan="9">Data Tidak Ditemukan</td>
                                </tr>
                            @endif
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>No. Tranaksi</strong></td>
                            <td><strong>Nama Customer</strong></td>
                            <td><strong>Nama Mobil</strong></td>
                            <td><strong>Jenis Peminjaman</strong></td>
                            <td><strong>Tanggal Mulai Sewa</strong></td>
                            <td><strong>Tanggal Selesai Sewa</strong></td>
                            <td><strong>Status Transaksi</strong></td>
                            <td><strong>Status Pembayaran</strong></td>
                            <td><strong>Status Verifikasi</strong></td>
                            <td><strong>Action</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Pagination --}}
        </div>
    </div>
</div>

@endsection
