<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atma Jaya Rental</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}" />
    
    <script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js') }}"></script>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="row">
                <!-- BEGIN INVOICE -->
                <div class="col-xs-12">
                    <div class="grid invoice">
                        <div class="grid-body">
                            <div class="invoice-title">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 class="text-center"><strong>Atma Jaya Rental</strong><br></h2>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5><strong>Nomor Transaksi</strong><br>
                                        <span class="small">{{ $transaksi->no_transaksi }}</span></h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <h5 class="text-end"><strong>Tanggal Transaksi</strong><br>
                                        <span class="small">{{ $transaksi->tgl_transaksi }}</span></h5>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table">
                                        <tr>
                                            <th><strong>Nama Customer</strong></th>
                                            <td>{{ $transaksi->customer->nama }}</td>
                                        <tr>
                                        <tr>
                                            <th><strong>Customer Service</strong></th>
                                            <td>{{ $transaksi->pegawai->nama_pegawai }}</td>
                                        <tr>
                                        @if ($transaksi->driver_id != NULL)
                                            <tr>
                                                <th><strong>Driver</strong></th>
                                                <td>{{ $transaksi->driver->nama_driver }}</td>
                                            <tr>
                                        @else
                                            <tr>
                                                <th><strong>Driver</strong></th>
                                                <td>-</td>
                                            <tr>
                                        @endif
                                    </table>  
                                </div>
                                <div class="col-md-6 text-right">
                                    <table class="table">
                                        <tr>
                                            <th><strong>Promo</strong></th>
                                            @if ($transaksi->promo_id == NULL)
                                                <td> - </td>
                                            @else
                                                <td>{{ $transaksi->promo->kode_promo }}</td>
                                            @endif
                                        <tr>
                                    </table>  
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xs-12">
                                    <h4 class="text-center"><strong>Nota Transaksi</strong><br></h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table">
                                        <tr>
                                            <th><strong>Tanggal Mulai</strong></th>
                                            <td>{{ date('d M Y  H:i', strtotime($transaksi->tgl_waktu_mulai_sewa)) }}</td>
                                        <tr>
                                        <tr>
                                            <th><strong>Tanggal Selesai</strong></th>
                                            <td>{{ date('d M Y  H:i', strtotime($transaksi->tgl_waktu_selesai_sewa)) }}</td>
                                        <tr>
                                        <tr>
                                            <th><strong>Tanggal Pengembalian</strong></th>
                                            @if ($transaksi->tgl_pengembalian == NULL)
                                                <td>-</td>
                                            @else
                                                <td>{{ date('d M Y  H:i', strtotime($transaksi->tgl_pengembalian)) }}</td>
                                            @endif
                                        <tr>
                                    </table>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="line">
                                                <td class="text-center"><strong>ITEM</strong></td>
                                                <td class="text-center"><strong>SATUAN</strong></td>
                                                <td class="text-center"><strong>DURASI</strong></td>
                                                <td class="text-center"><strong>SUBTOTAL</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $transaksi->aset->nama_mobil }}</td>
                                                <td class="text-center">Rp.{{ $transaksi->aset->biaya_sewa }}</td>
                                                <td class="text-center">{{  $transaksi->selisihTgl }} hari</td>
                                                <td class="text-center">Rp.{{ $transaksi->subAset }}</td>
                                            </tr>
                                            @if ($transaksi->driver_id != NULL)
                                                <tr>
                                                    <td>{{ $transaksi->driver->nama_driver }}</td>
                                                    <td class="text-center">Rp.{{ $transaksi->driver->biaya_driver }}</td>
                                                    <td class="text-center">{{  $transaksi->selisihTgl }} hari</td>
                                                    <td class="text-center">Rp.{{ $transaksi->subDriver }}</td>
                                                </tr>
                                            @endif
                                            <tr class="table-bordered border-dark">
                                                <td colspan="3"></td>
                                                <td class="text-center"><strong>Rp.{{ $transaksi->subTot }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="text-center"><strong>Diskon Promo</strong></td>
                                                <td class="text-center">Rp.{{ $transaksi->disc }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="text-center"><strong>Denda Terlambat (Aset + Driver)</strong></td>
                                                <td class="text-center">Rp.{{ $transaksi->ekstensi_biaya }}</td>
                                            </tr>
                                            <tr class="table-warning">
                                                <td colspan="2">
                                                </td><td class="text-center"><strong>Total</strong></td>
                                                <td class="text-center"><strong>Rp.{{ $transaksi->total_biaya_sewa }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>									
                            </div>
                            <div class="row mt-4 text-center">
                                <div class="col-md-3">
                                    <h6><strong>Customer</strong></h6>
                                </div>
                                <div class="col-md-3">
                                    <h6><strong>Customer Service</strong></h6>
                                </div>
                            </div>
                            <br><br>
                            <div class="row mt-5 text-center">
                                <div class="col-md-3">
                                    <h6><strong>{{ $transaksi->customer->nama }}</strong></h6>
                                </div>
                                <div class="col-md-3">
                                    <h6><strong>{{ $transaksi->pegawai->nama_pegawai }}</strong></h6>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-12 text-center identity">
                                    <p>Designer identity<br><strong>Jeffrey Williams</strong></p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- END INVOICE -->        
            </div>
        </div>
    </div>
    <script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/theme.js') }}"></script>
</body>
</html>
