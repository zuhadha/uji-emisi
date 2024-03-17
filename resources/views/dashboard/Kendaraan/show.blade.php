@extends('layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Kendaraan</h1>
</div>

<div class="col-lg-8">

  <h2 class="h5 mb-0 px-2">
    Informasi Kendaraan
  </h2>
    <table class="table">
        <tbody>
            <tr>
              <th>Nomor Polisi</th>
                <td>{{ $kendaraan["nopol"] }}</td>
            </tr>
            <tr>
              <th>Merk</th>
                <td>{{ $kendaraan["merk"] }}</td>
            </tr>
            <tr>
              <th>Tipe</th>
                  <td>{{ $kendaraan["tipe"] }}</td>
            </tr>
            <tr>
              <th>CC</th>
                  <td>{{ $kendaraan["cc"] }}</td>
            </tr>
            <tr>
              <th>Tahun</th>
                  <td>{{ $kendaraan["tahun"] }}</td>
            </tr>
        </tbody>
    </table>

</div>
@endsection