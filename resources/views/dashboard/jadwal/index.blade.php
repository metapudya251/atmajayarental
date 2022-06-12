@extends('layouts.main')
@section('pegawai-view')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark">Jadwal Shift Pegawai</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-sm-end" style="padding: 9px;">
            <a class="btn btn-success btn-icon-split" role="button" href="{{ route('jadwal.create') }}">
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
            <p class="text-primary m-0 fw-bold">Info Jadwal</p>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <div class="text-md-end dataTables_filter" id="dataTable_filter">
                    <div class="row">
                        <div class="col-6">
                            <form action="{{ route('jadwal.index') }}">
                                @csrf			
                                <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search" name="search" value="{{ request('search') }}" autocomplete="off">
                            </form>
                        </div>
                        <div class="col-3">
                            <span class=" icon small"><i class="fas fa-square" style="color: lightblue"></i></span>
                            <span class="text-dark fw-bold text">Shift 1</span>
                        </div>
                        <div class="col-3">
                            <span class=" icon small"><i class="fas fa-square" style="color: burlywood"></i></span>
                            <span class="text-dark fw-bold text">Shift 2</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-sm-6">
                    <div class="card ms-0 mt-3 md-3 border-secondary">
                        <div class="card-header"><strong>SENIN</strong></div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item mx-auto"><strong>LIBUR</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card ms-0 mt-3 md-3 border-secondary">
                        <div class="card-header"><strong>SELASA</strong></div>
                        <ul class="list-group list-group-flush">
                            @foreach($detail as $detail)
                                @if ($detail->hari_shift == 'Selasa')
                                    @if ($detail->jadwal->id == 1)
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:lightblue">{{ $detail->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$detail->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $detail->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $detail->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$detail->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div>    
                                    @else
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:burlywood">{{ $detail->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$detail->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $detail->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $detail->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$detail->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div> 
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card ms-0 mt-3 md-3 border-secondary">
                        <div class="card-header"><strong>RABU</strong></div>
                        <ul class="list-group list-group-flush">
                            @foreach($details as $dtl)
                                @if ($dtl->hari_shift == 'Rabu')
                                    @if ($dtl->jadwal->id == 1)
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:lightblue">{{ $dtl->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$dtl->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $dtl->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $dtl->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$dtl->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div>    
                                    @else
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:burlywood">{{ $dtl->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$dtl->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $dtl->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $dtl->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$dtl->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div> 
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card ms-0 mt-3 md-3 border-secondary">
                        <div class="card-header"><strong>KAMIS</strong></div>
                        <ul class="list-group list-group-flush">
                            @foreach($jadwal as $dtl)
                                @if ($dtl->hari_shift == 'Kamis')
                                    @if ($dtl->jadwal->id == 1)
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:lightblue">{{ $dtl->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$dtl->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $dtl->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $dtl->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$dtl->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div>    
                                    @else
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:burlywood">{{ $dtl->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$dtl->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $dtl->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $dtl->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$dtl->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div> 
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card ms-0 mt-3 md-3 border-secondary">
                        <div class="card-header"><strong>JUMAT</strong></div>
                        <ul class="list-group list-group-flush">
                            @foreach($jadwals as $dtl)
                                @if ($dtl->hari_shift == 'Jumat')
                                    @if ($dtl->jadwal->id == 1)
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:lightblue">{{ $dtl->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$dtl->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $dtl->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $dtl->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$dtl->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div>    
                                    @else
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:burlywood">{{ $dtl->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$dtl->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $dtl->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $dtl->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$dtl->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div> 
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card ms-0 mt-3 md-3 border-secondary">
                        <div class="card-header"><strong>SABTU</strong></div>
                        <ul class="list-group list-group-flush" >
                            @foreach($shift as $dtl)
                                @if ($dtl->hari_shift == 'Sabtu')
                                    @if ($dtl->jadwal->id == 1)
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:lightblue">{{ $dtl->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$dtl->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $dtl->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $dtl->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$dtl->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div>    
                                    @else
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:burlywood">{{ $dtl->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$dtl->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $dtl->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $dtl->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$dtl->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div> 
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card ms-0 mt-3 md-3 border-secondary">
                        <div class="card-header"><strong>MINGGU</strong></div>
                        <ul class="list-group list-group-flush">
                            @foreach($shifts as $dtl)
                                @if ($dtl->hari_shift == 'Minggu')
                                    @if ($dtl->jadwal->id == 1)
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:lightblue">{{ $dtl->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$dtl->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $dtl->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $dtl->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$dtl->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div>    
                                    @else
                                        <div class="row">
                                            <div class="col-5">
                                                <li class="list-group-item" style="background-color:burlywood">{{ $dtl->nama_pegawai }}</li>
                                            </div>
                                            <div class="col-7">
                                                <form action="{{ route('jadwal.destroy',$dtl->id) }}">
                                                    <a class="btn btn-info btn-circle ms-1" role="button" href="{{ route('jadwal.edit', $dtl->id) }}"><i class="fas fa-pen text-white"></i></a>
                                                    <a class="btn btn-success btn-circle ms-1" role="button" href="{{ route('jadwal.show', $dtl->id) }}"><i class="fas fa-info-circle text-white"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-danger btn-circle ms-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" role="button" href="{{ route('jadwal.destroy',$dtl->id)}}"><i class="fas fa-trash text-white"></i></a>
                                                </form>
                                            </div>
                                        </div> 
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            {{-- Pagination --}}
            
        </div>
    </div>
</div>

@endsection