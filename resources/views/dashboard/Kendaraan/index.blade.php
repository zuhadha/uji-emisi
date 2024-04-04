@extends('layout.main')
@section('nama-bengkel'){{ $bengkel }}@endsection
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List Kendaraan</h1>
    </div>
    
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-11" role="alert" >
        {{ session('success') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
    @endif

    
    <div class="row">
        <div class="col-lg-4">
            <a href="/dashboard/kendaraan/create" class="btn add-button mb-3">Tambah Kendaraan</a>
        </div>
        <div class="col-lg-4  d-flex justify-content-end">
        </div>
        <form class="col-lg-3 d-flex justify-content-end" method="GET" action="/dashboard/kendaraan">
            <div class="row">
                <div class="col-lg-10 px-0 my-0">
                    <input type="text" class="form-control custom-placeholder" name="keyword" placeholder="nopol/merk/tipe/tahun/bb" value="{{ $keyword }}">    
                </div>
                <div class="col-lg-1 px-0">
                    <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>






    <div class="col-lg-11">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center" scope="col">No</th>
                    <th scope="col">Nomor Polisi</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Bahan Bakar</th>
                    @can('admin')
                    <th scope="col">Penguji</th>
                    @endcan
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kendaraans as $k)
                    
                    <tr>
                        <td class="text-center">{{ ($kendaraans->currentPage() - 1) * $kendaraans->perPage() + $loop->iteration }}</td>
                        <td>{{ $k["nopol"] }}</td>
                        <td>{{ $k["merk"] }}</td>
                        <td>{{ $k["tipe"] }}</td>
                        <td>{{ $k["tahun"] }}</td>
                        <td>{{ $k["bahan_bakar"] }}</td>
                        @can('admin')
                        <td>{{ $k->user->bengkel_name }}</td>
                        @endcan
                        <td>
                            <a href="/dashboard/kendaraan/{{ $k->id }}" class="badge bg-secondary action-btn"><i class="fa fa-file-lines"></i></a>
                            <a href="/dashboard/kendaraan/{{ $k->id }}/edit" class="badge bg-primary action-btn"><i class="fa fa-pencil"></i></a>
                            <a href="/dashboard/ujiemisi/insert/create/{{ $k->id }}" class="badge bg-success action-btn"><i class="fa fa-wrench"></i></a>
                            <form action="/dashboard/kendaraan/{{ $k->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0 action-btn" onclick="return confirm('Hapus kendaraan dengan nomor polisi {!! $k['nopol'] !!} ?')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class=col-lg-11">
        <div class="row">
            <div class="col-lg-5">
                <p class="text-secondary ms-3"><strong><small>Total: </strong><span>{{ $totalRecords }}</span></small></p>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                {{ $kendaraans->links() }}
            </div>
        </div>
    </div>
@endsection