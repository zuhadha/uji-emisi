@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Tambah User</h1>
    </div>

    <div class="col-lg-11">
        <form method="post" action="/dashboard/user">
            @csrf
            <div class="row">
                <div class="col-md-6">
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
                        <label for="perusahaan_name" class="form-label">Nama Cabang<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('perusahaan_name') is-invalid @enderror" id="perusahaan_name" name="perusahaan_name" required value="{{ old('perusahaan_name') }}">
                        @error('perusahaan_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kepala_bengkel" class="form-label">Nama Kepala Bengkel<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kepala_bengkel') is-invalid @enderror" id="kepala_bengkel" name="kepala_bengkel" required value="{{ old('kepala_bengkel') }}">
                        @error('kepala_bengkel')
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
                </div>

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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                              <label for="alat_uji" class="form-label">Alat Uji</label>
                              <input type="text" class="form-control @error('alat_uji') is-invalid @enderror" id="alat_uji" name="alat_uji"  value="{{ old('alat_uji') }}">
                              @error('alat_uji')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                              <label for="tanggal_kalibrasi_alat" class="form-label">Tanggal Kalibrasi Alat</label>
                              <input type="date" class="form-control @error('tanggal_kalibrasi_alat') is-invalid @enderror" id="tanggal_kalibrasi_alat" name="tanggal_kalibrasi_alat"  value="{{ old('tanggal_kalibrasi_alat') }}">
                              @error('tanggal_kalibrasi_alat')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2 ml-4" id="tambahUserBtn">Tambah User</button>
                
        </form>
    </div>
@endsection