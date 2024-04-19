@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Statistik Hasil Uji Emisi</h1>
        <div>
            <img class="mx-1" src="/img/logo_asbekindo.png" alt="Logo Asbekindo" style="max-height: 50px;">
            <img class="mx-1" src="/img/logo_dishub.png" alt="Logo Asbekindo" style="max-height: 50px;">
            <img class="mx-1" src="/img/logo_dlh.png" alt="Logo Asbekindo" style="max-height: 50px;">
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="card bg-white shadow">
                <div class="card-body">
                    @if (auth()->user()->user_kategori != 'bengkel' || auth()->user()->is_admin)
                        <h2 class="text-center">{{ $bengkel }}</h2>
                        <h3 class="text-center">Total Bengkel</h3>
                        <hr>
                    @endif
                    <h2 class="text-center">{{ $kendaraan }}</h2>
                    <h3 class="text-center">Total Kendaraan</h3>
                    <hr>
                    <h2 class="text-center">{{ $ujiEmisi }}</h2>
                    <h3 class="text-center">Total Uji</h3>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="row">
                @foreach ($averages as $avg)
                    <div class="col-4">
                        <div class="card shadow bg-white">
                            <h3 class="card-header text-center">Rata-Rata {{ $avg['label'] }}</h3>
                            <div class="card-body" style="height: 150px">
                                <canvas id="{{ $avg['label'] }}"></canvas>
                            </div>
                            <h3 class="text-center text-{{ $avg['color'] }}">{{ $avg['value'] }}</h3>
                        </div>
                    </div>
                @endforeach
                <div class="col-12">
                    <a href="/dashboard/ujiemisi" class="btn btn-primary w-100 mt-4">Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card bg-white shadow mt-3">
                <h3 class="card-header">10 Data Uji Emisi Terakhir</h3>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lastUjiEmisi as $ujiemisi)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $ujiemisi->kendaraan->nopol }}</td>
                                <td>{{ $ujiemisi->kendaraan->merk }} {{ $ujiemisi->kendaraan->tipe }}
                                    {{ $ujiemisi->kendaraan->tahun }}</td>
                                <td>{{ $ujiemisi->tanggal_uji->isoFormat('LLLL') }}</td>
                                <td>{{ $ujiemisi->odometer }}</td>
                                <td>{{ $ujiemisi->co }}/{{ $ujiemisi->hc }}/{{ $ujiemisi->opasitas }}</td>
                                <td><a href="#"
                                        style="text-decoration: underline;">{{ $ujiemisi->no_sertifikat ?? 'kok gaada?' }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="/dashboard/ujiemisi" class="btn btn-primary">Selengkapnya</a>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @foreach ($averages as $avg)
        <script>
            'use strict';
            var data = {
                value: '{{ $avg['value'] }}',
                max: '{{ $avg['max'] }}',
                label: "Rata-Rata {{ $avg['label'] }}"
            };

            var config = {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [data.value, data.max - data.value],
                        backgroundColor: ['rgba(0, 0, 0, 0.1)', 'rgba(54, 162, 235, 0.8)'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutoutPercentage: 85,
                    rotation: -90,
                    circumference: 180,
                    tooltips: {
                        enabled: false
                    },
                    legend: {
                        display: false
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: false
                    },
                    title: {
                        display: true,
                        text: data.label,
                        fontSize: 16
                    }
                }
            };

            // Create the chart
            var chartCtx = document.getElementById('{{ $avg['label'] }}').getContext('2d');
            var gaugeChart = new Chart(chartCtx, config);
        </script>
    @endforeach
@endpush
