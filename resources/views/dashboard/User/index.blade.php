@extends('layout.main')
@section('nama-bengkel'){{ $bengkel_name }}@endsection
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Management Pengguna</h1>
    </div>

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-11" role="alert" >
        {{ session('success') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
    @endif

    <a href="/dashboard/user/create" class="btn add-button mb-3">Tambah Pengguna</a>

    <div class="col-lg-11">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center" scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama Instansi/Bengkel</th>
                    <th scope="col">Cabang</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $u["username"] }}</td>
                        <td>{{ $u["bengkel_name"] }}</td>
                        {{-- <td>{{ \Carbon\Carbon::parse($u["created_at"])->format('d/m/Y') }}</td> --}}
                        <td>{{ $u["perusahaan_name"]}}</td>
                        <td>{{ $u["jalan"]}}</td>

                        <td>
                            <div style="display: flex;">
                                <a href="/dashboard/user/{{ $u->id }}/edit" class="badge bg-primary px-2 me-1 py-0 py-2"><i class="fa fa-pencil"></i></a>
                                <form action="/dashboard/user/{{ $u->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class=" badge bg-danger border-0 action-btn px-2 py-2" onclick="return confirm('Hapus user dengan username {!! $u['username'] !!} ?')"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
    
@endsection