@extends('layout.main')

{{-- @section('nama-bengkel'){{ $bengkel_name }}@endsection --}}

@section('container')

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-11" role="alert" >
        {{ session('success') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
    @endif



    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Isi Nomor Seri Tanda Lulus</h1>
    </div>


    <div class="col-lg-7">
        <table class="table">
            <tbody>
                <tr>
                  <th>Nomor Polisi</th>
                    {{-- <td>{{ $kendaraan["nopol"] }}</td> --}}
    
                    <td>{{ $ujiemisi->kendaraan->nopol }}</td>
                </tr>
                <tr>
                  <th>Tanggal Uji</th>
                    <td>{{ $tanggal_uji }}</td>
                </tr>
                <tr>
                    <th>No Seri Tanda Lulus</th>
                      {{-- <td>{{ $kendaraan["tipe"] }}</td> --}}
                    <td>
                        <div class="row ms-1 px-0">
                            <form method="post" class="mx-0" action="/dashboard/ujiemisi/input-sertif/{{ $ujiemisi->id }}/input-nomor/submit-nomor">
                                @method('put')
                                @csrf
                                <div class="row">
                                    {{-- <input type="text" class="px-2 form-control custom-placeholder2" name="no_sertifikat" required placeholder="Contoh: AA123456" value="{{ old('no_sertifikat', $ujiemisi->no_sertifikat) }}">    --}}
                                    <input type="text" class="px-2 @error('no_sertifikat') is-invalid @enderror form-control custom-placeholder2" name="no_sertifikat" required placeholder="Contoh: AA123456" 
                                        value="{{ old('no_sertifikat', $ujiemisi->no_sertifikat) }}">
                                        @error('no_sertifikat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    <div class="col px-0 mt-2">
                                        <button type="submit" class="btn btn-success" name="print_type" value="dot_matrix">Cetak Dot Matrix<i class="fa fa-braille ms-2"></i></button>
                                    </div>
                                    <div class="col px-0 mt-2">
                                        <button type="submit" class="btn btn-warning" name="print_type" value="printer">Cetak Printer<i class="fa fa-print ms-2"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-block">
            <a href="/dashboard/ujiemisi/create" class="btn btn-primary"><i class="fa fa-long-arrow-left me-2"></i><span>Tambah Uji Lagi</span></a>
        </div>
        <div class="d-block mt-2"> <!-- mt-2 for adding some margin between buttons -->
            <a href="/dashboard/ujiemisi" class="btn btn-secondary"><i class="fa fa-long-arrow-left me-2"></i><span>Kembali ke Halaman Uji Emisi</span></a>
        </div>
    </div>

<script src="https://kit.fontawesome.com/467dee4ab4.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection
    