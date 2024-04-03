@extends('layout.main')

@section('nama-bengkel'){{ $bengkel_name }}@endsection

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Hasil Uji</h1>
    </div>

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-11" role="alert" >
        {{ session('success') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show col-lg-11" role="alert" >
        {{ session('error') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
    @endif
    
    <div class="row">
        <div class="col-lg-4">
            <a href="/dashboard/ujiemisi/create" class="btn add-button mb-3">Insert Hasil Uji</a>
            
        </div>
        <div class="col-lg-4  d-flex justify-content-end">
            <form action="{{ route('export') }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-primary mb-3">Export</button>
            </form>            
        </div>
        <form class="col-lg-3 d-flex justify-content-end" method="GET" action="/dashboard/ujiemisi">
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




    <div class="col-11">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>No. Polisi</th>
                            <th>Merk, Tipe, Tahun</th>
                            <th>Tanggal Uji</th>
                            <th>Odometer</th>
                            <th>CO/HC/Opasitas</th>
                            <th>Tanda Lulus</th>
                            <th>Aksi</th>
                            {{-- <th scope="col"><form action="">
                                <input type="checkbox">    
                            </form></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                            {{-- @foreach($ujiemisis as $ujiemisi)
                                <tr>
                                    <td class="text-center">{{ ($ujiemisis->currentPage() - 1) * $ujiemisis->perPage() + $loop->iteration }}</td>
                                    <td>{{ $ujiemisi->nopol }}</td>
                                    <td>{{ $ujiemisi->kendaraan->merk }} {{ $ujiemisi->kendaraan->tipe }} {{ $ujiemisi->kendaraan->tahun }}</td>
                                    <td>{{ $ujiemisi->tanggal_uji }}</td>
                                    <td>{{ $ujiemisi->odometer }}</td>
                                    <td>{{ $ujiemisi->co }}/{{ $ujiemisi->hc }}/{{ $ujiemisi->opasitas }}</td>
                                    <td><a href="#" style="text-decoration: underline;">{{ $ujiemisi->no_sertifikat ?? "kok gaada?" }}</a></td>
                                    <td>
                                        <a href="/dashboard/ujiemisi/{{ $ujiemisi->id }}/edit" class="badge bg-primary"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach --}}
                            @foreach($ujiemisis as $ujiemisi)
                                <tr>
                                    <td class="text-center">{{ ($ujiemisis->currentPage() - 1) * $ujiemisis->perPage() + $loop->iteration }}</td>
                                    <td>{{ $ujiemisi->kendaraan->nopol }}</td>
                                    <td>{{ $ujiemisi->kendaraan->merk }} {{ $ujiemisi->kendaraan->tipe }} {{ $ujiemisi->kendaraan->tahun }}</td>
                                    <td>{{ $ujiemisi->tanggal_uji }}</td>
                                    <td>{{ $ujiemisi->odometer }}</td>
                                    <td>{{ $ujiemisi->co }}/{{ $ujiemisi->hc }}/{{ $ujiemisi->opasitas }}</td>
                                    <td><a href="#" style="text-decoration: underline;">{{ $ujiemisi->no_sertifikat ?? "kok gaada?" }}</a></td>
                                    <td>
                                        <a href="/dashboard/ujiemisi/{{ $ujiemisi->id }}/edit" class="badge bg-primary action-btn"><i class="fa fa-pencil"></i></a>
                                        <form action="/dashboard/ujiemisi/{{ $ujiemisi->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0 action-btn" onclick="return confirm('Hapus hasil uji?')"><i class="fa fa-trash"></i></button>
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
                {{ $ujiemisis->links() }}
            </div>
        </div>
    </div>

<script src="https://kit.fontawesome.com/467dee4ab4.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


@endsection
    