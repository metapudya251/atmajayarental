@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
    <h3 class="text-dark mb-4">Profile - {{ Auth::guard('pegawai')->user()->role->nama_role }}</h3>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row mb-3">
      <div class="col-lg-4">
        <div class="card mb-3">
          <div class="card-body text-center shadow">
            @if (Auth::guard('pegawai')->user()->img == NULL)
              <img class="rounded-circle mb-3 mt-4" src="{{ url('assets/img/avatars/avatar6.jpeg') }}"  width="160" height="160" />
            @else
              <img class="rounded-circle mb-3 mt-4" src="{{ url('fotopgw/',Auth::guard('pegawai')->user()->img) }}"  width="160" height="160" />
            @endif
          </div>
        </div>
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="text-primary fw-bold m-0">Personal Info</h6>
          </div>
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label class="form-label" for="username"><strong>Birth Date</strong><br/></label>
                <input class="form-control" type="text" style="width: 179.531px" value="{{ old('nama_pegawai', Auth::guard('pegawai')->user()->tgl_lahir_pegawai) }}" disabled/>
              </div>
              <div class="mb-3">
                <label class="form-label" for="username"><strong>Gender</strong><br/></label>
                <input class="form-control" type="text"  style="width: 179.531px" id="first_name" name="gender_pegawai" value="{{ old('nama_pegawai', Auth::guard('pegawai')->user()->gender_pegawai) }}" disabled/>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="row">
          <div class="col">
            <div class="card shadow mb-3">
              <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">User Settings</p>
              </div>
              <div class="card-body">
                <form >
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="first_name"><strong>No Pegawai</strong></label>
                        <input class="form-control" type="text" id="first_name" placeholder="Nama" name="no_pegawai" value="{{ old('no_pegawai', Auth::guard('pegawai')->user()->no_pegawai) }}" disabled/>
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="first_name"><strong>Name</strong></label>
                        <input class="form-control" type="text" id="first_name" placeholder="Nama" name="nama_pegawai" value="{{ old('nama_pegawai', Auth::guard('pegawai')->user()->nama_pegawai) }}" disabled/>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="email"><strong>Email Address</strong></label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ old('email', Auth::guard('pegawai')->user()->email) }}" disabled/>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card shadow">
              <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Contact Settings</p>
              </div>
              <div class="card-body">
                <form>
                  <div class="mb-3">
                    <label class="form-label" for="address"><strong>Address</strong></label
                    ><input class="form-control" type="text" id="address" name="address" value="{{ old('email', Auth::guard('pegawai')->user()->alamat_pegawai) }}" disabled/>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="city"><strong>Phone Number</strong></label
                        ><input class="form-control" type="text" id="city" name="noTelp_pegawai" value="{{ old('email', Auth::guard('pegawai')->user()->noTelp_pegawai) }}" disabled />
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="d-grid gap-2">
      <a class="btn btn-primary btn-sm" href="{{ route('pegawai.edit', Auth::guard('pegawai')->user()->id) }}">EDIT PROFILE</a>
    </div>
  </div>
@endsection