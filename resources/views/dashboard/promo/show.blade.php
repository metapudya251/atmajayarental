@extends('layouts.main')
@section('pegawai-view')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark mb-4">Detail Promo</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-sm-end" style="padding: 9px;">
            <a class="btn btn-primary " role="button" href="{{ route('promo.index') }}">
                <span class="text-white text">Back</span>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    @if ($promo->status_promo == "Aktif")
        <div class="card border-success mb-3 text-dark">
            <div class="card-header bg-light py-3">
                <div class="row justify-content-between">
                    <div class="col-10">
                        <h5 class="m-0 fw-bold">{{ $promo->kode_promo }}</h5>
                    </div>
                    <div class="col-2">
                        <span class=" icon small"><i class="fas fa-circle text-success"></i></span>
                        <span class="fw-bold text">{{ $promo->status_promo }}</span>
                    </div>
                </div>
            </div>  
            <div class="card-body">
                <h5 class="card-title text-success fw-bold">{{ $promo->jenis_promo }}</h5>
                <p class="card-text">{{ $promo->keterangan }}, serta mendapatkan diskon sebesar <strong>{{ $promo->diskon_promo*100 }}%</strong></p>
                <hr>
                <p class="card-text small">*Promo dapat berubah sewaktu-waktu</p>
            </div>
        </div> 
    @else
        <div class="card border-danger mb-3 text-dark">
            <div class="card-header bg-light py-3">
                <div class="row justify-content-between">
                    <div class="col-10">
                        <h5 class="text-dark m-0 fw-bold">{{ $promo->kode_promo }}</h5>
                    </div>
                    <div class="col-2 ">
                        <span class=" icon small"><i class="fas fa-circle text-danger"></i></span>
                        <span class="text-dark fw-bold text">{{ $promo->status_promo }}</span>
                    </div>
                </div>
            </div>  
            <div class="card-body">
                <h5 class="card-title text-danger fw-bold">{{ $promo->jenis_promo }}</h5>
                <p class="card-text">{{ $promo->keterangan }}, serta mendapatkan diskon sebesar <strong>{{ $promo->diskon_promo*100 }}%</strong></p>
                <hr>
                <p class="card-text small">*Promo dapat berubah sewaktu-waktu</p>
            </div>
        </div> 
    @endif
</div>

@endsection
