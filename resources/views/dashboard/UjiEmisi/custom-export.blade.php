@extends('layout.main')

{{-- @section('nama-bengkel'){{ $bengkel_name }}@endsection --}}

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Rentang Waktu</h1>
    </div>


    <div class="col-lg-6">
        <form id="exportForm" action="{{ route('export') }}" method="GET">
            @csrf
            <input type="hidden" name="selectedButtonId" value="customRangeBtn">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Mulai Tanggal</th>
                        <td>
                            <input type="date" class="px-2 form-control custom-placeholder2" id="start_date" name="start_date">
                        </td>
                    </tr>
                    <tr>
                        <th>Hingga Tanggal</th>
                        <td>
                            <input type="date" class="px-2 form-control custom-placeholder2" id="end_date" name="end_date">
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success mb-2" name="print_type" value="customRangeBtn">Export Data<i class="fa fa-table ms-2"></i></button><br/>
        </form>
        <a href="/dashboard/ujiemisi" class="btn btn-primary"><i class="fa fa-long-arrow-left me-2"></i><span>Kembali ke Halaman Uji Emisi</span></a>
    </div>

<script src="https://kit.fontawesome.com/467dee4ab4.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function exportData(range) {
        // Menyimpan id tombol yang dipilih ke dalam variabel buttonId
        let buttonId;
        switch (range) {
            case 'last_year':
                buttonId = 'lastYearBtn';
                break;
            case 'last_month':
                buttonId = 'lastMonthBtn';
                break;
            case 'all':
                buttonId = 'allDataBtn';
                break;
            default:
                buttonId = 'customRangeBtn';
        }

        // Set nilai input dengan id tombol yang dipilih
        document.getElementById('selectedButtonId').value = buttonId;

        // Submit form
        document.getElementById('exportForm').submit();
    }
</script>

@endsection