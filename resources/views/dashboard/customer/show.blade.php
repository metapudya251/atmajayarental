@extends('layouts.main')
@section('pegawai-view')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="height: 31.125px;">
            <h3 class="text-dark mb-4">Detail Customer</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-sm-end" style="padding: 9px;">
            <a class="btn btn-primary " role="button" href="{{ route('customer.read') }}">
                <span class="text-white text">Back</span>
            </a>
        </div>
    </div>
    <div class="row mb-3">
      <div class="col-lg-4">
        <div class="card mb-3">
          <div class="card-body text-center shadow">
            @if ($customer->img == NULL)
              <img class="rounded-circle mb-3 mt-4" src="{{ url('assets/img/avatars/avatar6.jpeg') }}"  width="160" height="160" />
            @else
              <img class="rounded-circle mb-3 mt-4" src="{{ url('fotocust/',$customer->img) }}"  width="160" height="160" />
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
                <label class="form-label" for="username"><strong>No {{  $customer->tanda_pengenal }}</strong><br/></label>
                <input class="form-control" type="text" style="width: 179.531px" value="{{ old('tanda_pengenal', $customer->no_pengenal) }}" disabled/>
              </div>
              <div class="mb-3">
                <label class="form-label" for="username"><strong>Birth Date</strong><br/></label>
                <input class="form-control" type="text" style="width: 179.531px" value="{{ old('tgl_lahir', $customer->tgl_lahir) }}" disabled/>
              </div>
              <div class="mb-3">
                <label class="form-label" for="username"><strong>Gender</strong><br/></label>
                <input class="form-control" type="text"  style="width: 179.531px" id="first_name" name="gender" value="{{ old('gender', $customer->gender) }}" disabled/>
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
                        <label class="form-label" for="first_name"><strong>No Customer</strong></label>
                        <input class="form-control" type="text" id="first_name" placeholder="no_" name="no_customer" value="{{ old('no_customer', $customer->no_customer) }}" disabled/>
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="first_name"><strong>Name</strong></label>
                        <input class="form-control" type="text" id="first_name" placeholder="Nama" name="nama" value="{{ old('nama', $customer->nama) }}" disabled/>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="email"><strong>Email Address</strong></label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $customer->email) }}" disabled/>
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
                    ><input class="form-control" type="text" id="address" name="address" value="{{ old('email',$customer->alamat) }}" disabled/>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label class="form-label" for="city"><strong>Phone Number</strong></label
                        ><input class="form-control" type="text" id="city" name="noTelp_pegawai" value="{{ old('email', $customer->no_telp) }}" disabled />
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