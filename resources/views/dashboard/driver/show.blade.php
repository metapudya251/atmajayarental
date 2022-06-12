@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark mb-4">Detail Driver</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-sm-end" style="padding: 9px;">
            <a class="btn btn-primary " role="button" href="{{ route('driver.index') }}">
                <span class="text-white text">Back</span>
            </a>
        </div>
    </div>
    <div class="row mb-3">
      <div class="col-lg-4">
        <div class="card mb-3">
          <div class="card-body text-center shadow">
            @if ($driver->img == NULL)
              <img class="rounded-circle mb-3 mt-4" src="{{ url('assets/img/avatars/avatar6.jpeg') }}"  width="160" height="160" />
            @else
              <img class="rounded-circle mb-3 mt-4" src="{{ url('fotodriver/',$driver->img) }}"  width="160" height="160" />
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
                <input class="form-control" type="text" style="width: 179.531px" value="{{ old('tgl_lahir_driver', $driver->tgl_lahir_driver) }}" disabled/>
              </div>
              <div class="mb-3">
                <label class="form-label" for="username"><strong>Gender</strong><br/></label>
                <input class="form-control" type="text"  style="width: 179.531px" id="first_name" name="gender_driver" value="{{ old('gender_driver', $driver->gender_driver) }}" disabled/>
              </div>
              <div class="mb-3">
                <label class="form-label" for="username"><strong>Biaya Driver</strong><br/></label>
                <input class="form-control" type="text"  style="width: 179.531px" id="first_name" name="gender_driver" value="Rp. {{ old('biaya_driver', $driver->biaya_driver) }}" disabled/>
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
                <div class="row">
                    @if ($driver->status_tersedia == "Tersedia")
                        <div class="col-10">
                            <p class="text-primary m-0 fw-bold">Driver Info</p>
                        </div>
                        <div class="col-2">
                            <span class=" icon small"><i class="fas fa-circle text-success"></i></span>
                            <span class="text-dark fw-bold text">{{ $driver->status_tersedia }}</span>
                        </div>
                    @else
                        <div class="col-9">
                            <p class="text-primary m-0 fw-bold">Driver Info</p>
                        </div>
                        <div class="col-3">
                            <span class=" icon small"><i class="fas fa-circle text-danger"></i></span>
                            <span class="text-dark fw-bold text">{{ $driver->status_tersedia }}</span>
                        </div>
                    @endif
                </div>
              </div>
              <div class="card-body">
                <form >
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="username"><strong>Nomor Driver</strong><br/></label>
                        <input class="form-control" type="text" value="{{ old('no_driver', $driver->no_driver) }}" disabled/>
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="first_name"><strong>Name</strong></label>
                        <input class="form-control" type="text" id="first_name" placeholder="Nama" name="nama_driver" value="{{ old('nama_driver', $driver->nama_driver) }}" disabled/>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="email"><strong>Email Address</strong></label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $driver->email) }}" disabled/>
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
                    ><input class="form-control" type="text" id="address" name="alamat_driver" value="{{ old('alamat_driver', $driver->alamat_driver) }}" disabled/>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="city"><strong>Phone Number</strong></label
                        ><input class="form-control" type="text" id="city" name="no_telp_driver" value="{{ old('no_telp_driver', $driver->no_telp_driver) }}" disabled />
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
  </div>
@endsection