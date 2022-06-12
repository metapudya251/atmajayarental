<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Atma Jaya Rental</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css" />
    <link rel="stylesheet" href="/assets/fonts/fontawesome5-overrides.min.css" />
    <link rel="stylesheet" href="/css/app.css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- BEGIN INVOICE -->
            <div class="col-xs-12">
                <div class="grid invoice">
                    <div class="grid-body">
                        <div class="invoice-title">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2 class="text-center" align="center" ><strong >Atma Jaya Rental</strong><br></h2>
                                </div>
                            </div>
                            <br>
                            <div class="grid">
                                <div class="g-col-4">
                                    <h5><strong>Nomor Transaksi</strong><br>
                                    <span class="small">{{ $transaksi->no_transaksi }}</span></h5>
                                    <h5 class="text-end"><strong>Tanggal Transaksi</strong><br>
                                    <span class="small">{{ $transaksi->tgl_transaksi }}</span></h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-auto">
                                <strong>Nama Customer : </strong>{{ $transaksi->customer->nama }}
                            </div>
                            <div class="col-xs-auto">
                                <strong>Customer Service :  </strong>{{ $transaksi->pegawai->nama_pegawai }}
                            </div>
                            <div class="col-xs-auto">
                                @if ($transaksi->driver_id != NULL)
                                    <strong>Driver :  </strong>{{ $transaksi->driver->nama_driver }}
                                @else
                                    <strong>Driver : </strong>-
                                @endif
                            </div>
                            <div class="col-xs-auto">
                                @if ($transaksi->promo_id == NULL)
                                    <strong>Promo :  </strong>-
                                @else
                                    <strong>Promo :  </strong>{{ $transaksi->promo->kode_promo }}</h4>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                    <strong>Tanggal Mulai : </strong>
                                    {{ date('d M Y  H:i', strtotime($transaksi->tgl_waktu_mulai_sewa)) }}<br>
                                {{-- </address> --}}
                            </div>
                            <div class="col-xs-6 text-right">
                                <strong>Tanggal Selesai : </strong>
                                {{ date('d M Y  H:i', strtotime($transaksi->tgl_waktu_selesai_sewa)) }}
                            </div>
                            <div class="col-xs-6 text-right">
                                <strong>Tanggal Pengembalian : </strong>
                                @if ($transaksi->tgl_pengembalian == NULL)
                                    -
                                @else
                                    {{ date('d M Y  H:i', strtotime($transaksi->tgl_pengembalian)) }}
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="text-center" align="center" ><strong >Nota Transaksi</strong><br></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="line">
                                            <td class="text-center"><strong>Item</strong></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><strong>Satuan</strong></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><strong>Durasi</strong></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><strong>Subtotal</strong></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $transaksi->aset->nama_mobil }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">Rp.{{ $transaksi->aset->biaya_sewa }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{  $transaksi->selisihTgl }} hari</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">Rp.{{ $transaksi->subAset }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                        @if ($transaksi->driver_id != NULL)
                                            <tr>
                                                <td>{{ $transaksi->driver->nama_driver }}</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center">Rp.{{ $transaksi->driver->biaya_driver }}</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center">{{  $transaksi->selisihTgl }} hari</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center">Rp.{{ $transaksi->subDriver }}</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td colspan="7"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><strong>Rp.{{ $transaksi->subTot }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td class="text-center"><strong>Diskon Promo</strong></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">Rp.{{ $transaksi->disc }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td class="text-center"><strong>Denda Terlambat (Aset + Driver)</strong></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">Rp.{{ $transaksi->ekstensi_biaya }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td class="text-center"><strong>Total</strong></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><strong>Rp.{{ $transaksi->total_biaya_sewa }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>									
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
            <!-- END INVOICE -->
        </div>
        </div>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
</body>
</html>