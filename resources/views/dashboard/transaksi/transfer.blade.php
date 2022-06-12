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
    <div class="row">
        <div class="col">
            <img class="square mb-3 mt-4" src="{{ url('assets/img/avatars/bca.png') }}"  height="160" />
            <h5><strong>No. Rekening : </strong>8111119755</h5><br>
        </div>
        <div class="col">
            <img class="square mb-3 mt-4" src="{{ url('assets/img/avatars/gopay.png') }}"   height="160" />
            <h5><strong>No. Handphone : </strong>0811219755</h5><br>
        </div>
        <div class="col">
            <img class="square mb-3 mt-4" src="{{ url('assets/img/avatars/mandiri.png') }}"  height="160" />
            <h5><strong>No. Rekening : </strong>537439755</h5><br>
        </div>
    </div>

    <form action="{{ route('transaksi.updateBukti',$transaksi->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
          <label class="form-label" for="first_name"><strong>Upload Bukti Pembayaran</strong></label>
          <input class="form-control" type="file" name="buktiBayar" value="{{ old('buktiBayar') }}">
          <span class="text-danger">@error('file'){{ $message }}@enderror</span>
        </div>
        
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary" name="edit">Edit</button>
          <a href="{{ route('transaksi.indexCust') }} " type="button" class="btn btn-outline-primary">Cancel</a>
        </div>
      </form>
</div>

@endsection
