@extends('layout.main')
@section('nama-bengkel'){{ $bengkel_name }}@endsection
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Edit Kendaraan</h1>
    </div>

    <div class="col-lg-11">
        <form method="post" action="/dashboard/kendaraan/{{ $kendaraan->id }}">
            @method('put')
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nopol" class="form-label" focus>No Polisi<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nopol') is-invalid @enderror" id="nopol" name="nopol" required value="{{ old('nopol', $kendaraan->nopol) }}">
                        @error('nopol')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk" name="merk" required value="{{ old('merk', $kendaraan->merk) }}">
                        @error('merk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="tipe" class="form-label">Tipe<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required value="{{ old('tipe', $kendaraan->tipe) }}">
                      @error('tipe')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun<span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" required value="{{ old('tahun', $kendaraan->tahun) }}">
                                @error('tahun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                              <label for="cc" class="form-label">CC<span class="text-danger">*</span></label>
                              <input type="number" class="form-control @error('cc') is-invalid @enderror" id="cc" name="cc" required value="{{ old('cc', $kendaraan->cc) }}">
                              @error('cc')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                      <label for="no_rangka" class="form-label">No. Rangka</label>
                      <input type="text" class="form-control @error('no_rangka') is-invalid @enderror" id="no_rangka" name="no_rangka" value="{{ old('no_rangka', $kendaraan->no_rangka) }}">
                      @error('no_rangka')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_mesin" class="form-label">No. Mesin</label>
                        <input type="text" class="form-control @error('no_mesin') is-invalid @enderror" id="no_mesin" name="no_mesin" value="{{ old('no_mesin', $kendaraan->no_mesin) }}">
                        @error('no_mesin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">

                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select class="form-select" name="kendaraan_kategori">
                            @foreach(['Angkutan Orang', 'Angkutan Barang', 'Angkutan Gandengan', 'Sepeda Motor 2 Tak', 'Sepeda Motor 4 Tak'] as $index => $kategori)
                                @php
                                    $selected = (old('kendaraan_kategori') == $index+1 || (isset($kendaraan) && $kendaraan->kendaraan_kategori == $index+1));
                                @endphp
                                <option value="{{ $index+1 }}" {{ $selected ? 'selected' : '' }}>{{ $kategori }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Bahan Bakar<span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-12 mt-1">
                            @foreach(['Bensin', 'Solar', 'Gas'] as $bahan_bakar)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('bahan_bakar') is-invalid @enderror" type="radio" name="bahan_bakar" id="{{ $bahan_bakar }}" value="{{ $bahan_bakar }}" {{ old('bahan_bakar', $kendaraan->bahan_bakar ?? '') == $bahan_bakar ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $bahan_bakar }}">{{ $bahan_bakar }}</label>
                            </div>
                            @endforeach
                        </div>
                        @error('bahan_bakar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Edit Kendaraan</button>
        </form>
    </div>

    
@endsection