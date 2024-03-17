@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Tambah User</h1>
    </div>

    <div class="col-lg-11">
        <form method="post" action="/dashboard/user">
            @csrf
            <div class="mb-3">
                <label for="bengkel_name" class="form-label">Nama Bengkel<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('bengkel_name') is-invalid @enderror" id="bengkel_name" name="bengkel_name" required value="{{ old('bengkel_name') }}">
                @error('bengkel_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label" focus>Username<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required value="{{ old('username') }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" focus>Password<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required value="{{ old('password') }}">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                      <label for="jalan" class="form-label">Jalan</label>
                      <input type="text" class="form-control @error('jalan') is-invalid @enderror" id="jalan" name="jalan" value="{{ old('jalan') }}">
                      @error('jalan')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="kab_kota" class="form-label">Kota/Kabupaten</label>
                      <input type="text" class="form-control @error('kab_kota') is-invalid @enderror" id="kab_kota" name="kab_kota" value="{{ old('kab_kota') }}">
                      @error('kab_kota')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                    
                </div>
                <div class="col-md-6">
                    
                    <div class="mb-3">
                      <label for="kecamatan" class="form-label">Kecamatan</label>
                      <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan"  value="{{ old('kecamatan') }}">
                      @error('kecamatan')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="kelurahan" class="form-label">Kelurahan</label>
                      <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan"  value="{{ old('kelurahan') }}">
                      @error('kelurahan')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2 ml-3" id="tambahUserBtn">Tambah User</button>



        </form>
    </div>
@endsection