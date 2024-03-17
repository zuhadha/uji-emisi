@extends('layout.main')
@section('nama-bengkel'){{ $bengkel_name }}@endsection
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Tambah Kendaraan</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/kendaraan">
            @csrf
            <div class="mb-3">
                <label for="nopol" class="form-label" focus>No Polisi<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nopol') is-invalid @enderror" id="nopol" name="nopol" required value="{{ old('nopol') }}">
                @error('nopol')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="merk" class="form-label">Merk<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk" name="merk" required value="{{ old('merk') }}">
                @error('merk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
              <label for="tipe" class="form-label">Tipe<span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required value="{{ old('tipe') }}">
              @error('tipe')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="cc" class="form-label">CC<span class="text-danger">*</span></label>
              <input type="number" class="form-control @error('cc') is-invalid @enderror" id="cc" name="cc" required value="{{ old('cc') }}">
              @error('cc')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="tahun" class="form-label">Tahun<span class="text-danger">*</span></label>
              <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" required value="{{ old('tahun') }}">
              @error('tahun')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3 row">
                <div class="col-sm-4">
                    <label for="bahan_bakar" class="form-label">Bahan Bakar<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bahan_bakar" id="bensin" value="bensin" checked>
                        <label class="form-check-label" for="bensin">Bensin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bahan_bakar" id="solar" value="solar">
                        <label class="form-check-label" for="solar">Solar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bahan_bakar" id="gas" value="gas">
                        <label class="form-check-label" for="gas">Gas</label>
                    </div>
                </div>
                @error('bahan_bakar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah Kendaraan</button>
        </form>
    </div>
@endsection