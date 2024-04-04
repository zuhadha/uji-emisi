<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UjiEmisi;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;


class KendaraanUjiEmisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Kendaraan $kendaraan, UjiEmisi $ujiemisi)
    {
        // dd($ujiemisi);
        // dd($kendaraan);
        return view('dashboard.UjiEmisi.insert-uji', [
            "bengkel_name" => auth()->user()->bengkel_name,
            "kendaraan" => $kendaraan,
            "ujiemisi" => $ujiemisi,
        ]);
    }


    public function showCreateFormWithKendaraan($kendaraan_id)
    {

        $kendaraan = Kendaraan::findOrFail($kendaraan_id);
        // dd($kendaraan);

        return view('dashboard.UjiEmisi.insert-uji', [
            "bengkel_name" => auth()->user()->bengkel_name,
            'kendaraan' => $kendaraan
        ]);
    }

    public function showInputSertifikat($ujiemisi_id)
    {
        // $ujiemisi =
        $ujiemisiLulus = UjiEmisi::findOrFail($ujiemisi_id);
        // dd($ujiemisiLulus);
        $tanggal = Carbon::parse($ujiemisiLulus->tanggal_uji)->locale('id')->translatedFormat('l, d F Y');


        return view('dashboard.UjiEmisi.input-sertif', [
            "bengkel_name" => auth()->user()->bengkel_name,
            "ujiemisi" => $ujiemisiLulus,
            "tanggal_uji" => $tanggal,
        ]);
    }

    public function inputSertifikat(Request $request, $ujiemisi_id)
    {
        // $ujiemisi = UjiEmisi::findOrFail($ujiemisi_id);
        $ujiemisi = UjiEmisi::findOrFail($ujiemisi_id);
        $validatedData = $request->validate([
            'no_sertifikat' => 'required',
        ]);

        $ujiemisi->update($validatedData);



        $message = new HtmlString("Kendaraan dengan nomor polisi {$ujiemisi->kendaraan->nopol} dinyatakan <strong>lulus</strong> uji emisi");
        // return redirect('/dashboard/ujiemisi')->with('success', $message);

        Session::put('ujiemisi', $ujiemisi);

            // Memeriksa tombol yang ditekan
        $printType = $request->input('print_type');

        // Mengarahkan pengguna ke rute yang sesuai berdasarkan tombol yang ditekan
        if ($printType === 'dot_matrix') {
            return redirect('/dashboard/cetak/dotmatrix');
        } elseif ($printType === 'printer') {
            return redirect('/dashboard/cetak/printer');
        }


        // return redirect('/dashboard/cetak/dotmatrix');
        // return redirect('/dashboard/ujiemisi')->with('success', $message)->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nopol' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'tahun' => 'required|gt:1900',
            'cc' => 'required|gt:100',
            'no_rangka' => '',
            'no_mesin' => '',
            'kendaraan_kategori' => 'required',
            'bahan_bakar' => 'required',
            'odometer' => 'required', // tambahkan validasi uji emisi juga di sini
            'co' => 'required',
            'hc' => 'required',
            'opasitas' => '',
            'co2' => '',
            'co_koreksi' => '',
            'o2' => '',
            'putaran' => '',
            'temperatur' => '',
            'lambda' => '',
        ]);

        $kendaraan = Kendaraan::where('nopol', $validatedData['nopol'])->first();

        // Jika kendaraan belum ada, buat baru
        if (!$kendaraan) {
            $validatedData['user_id'] = auth()->user()->id;
            $kendaraan = Kendaraan::create($validatedData);
        }

        // Tambahkan data uji emisi dengan kendaraan yang ada (baik yang sudah ada atau baru dibuat)
        $ujiEmisiData = $validatedData;
        $ujiEmisiData['user_id'] = auth()->user()->id;
        $ujiEmisiData['kendaraan_id'] = $kendaraan->id;
        $ujiemisi = UjiEmisi::create($ujiEmisiData);

        if ($this->checkIsLulus($ujiemisi)) {
            return redirect("/dashboard/ujiemisi/input-sertif/{$ujiemisi->id}/input-nomor")->with('success', "Kendaraan dinyatakan lulus uji emisi");
        } else {
            return redirect("/dashboard/ujiemisi")->with('error', 'Kendaraan dan Uji emisi berhasil ditambah tetapi kendaraan tidak lulus uji emisi');
        }

        // return redirect("/dashboard/ujiemisi/input-sertif/{$ujiemisi->id}/input-nomor")->with('success', 'Kendaraan dinyatakan lulus uji emisi');
        // return redirect("/dashboard/ujiemisi/input-sertif/{$ujiemisi->id}/input-nomor")->with('success', 'Uji Emisi berhasil ditambahkan, dan kendaraan lulus uji emisi');

        // dd($tanggal_uji);
        // return view("/dashboard/ujiemisi/input-sertif", [
        //     'ujiemisi' => $ujiemisi,
        //     'kendaraan' => $kendaraan,
        //     "tanggal_uji" => $tanggal,
        // ]);



        // return redirect("/dashboard/ujiemisi/input-sertif/{$ujiemisi->id}")->with('success', 'Kendaraan memenuhi standard dan dinyatakan lulus uji emisi');
        // return redirect('/dashboard/ujiemisi')->with('success', 'Kendaraan dan hasil uji emisi berhasil ditambahkan');
        // return redirect("/dashboard/ujiemisi/input-sertif/{$ujiemisi->id}")->with('success', 'Kendaraan memenuhi standard dan dinyatakan lulus uji emisi');

    }


    /**
     * Display the specified resource.
     */
    public function show(Kendaraan $kendaraan, UjiEmisi $ujiemisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kendaraan $kendaraan, UjiEmisi $ujiemisi)
    {
        // dd($ujiemisi);
        // return view('/dashboard/ujiemisi/edit-uji', [
        //     "bengkel_name" => auth()->user()->bengkel_name,
        //     'kendaraan' => $kendaraan,
        //     'ujiemisi' => $ujiemisi,
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kendaraan $kendaraan, UjiEmisi $ujiemisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kendaraan $kendaraan, UjiEmisi $ujiemisi)
    {
        //
    }

    private function checkIsLulus($ujiemisi) {
        $isLulus = false;
        // ini baru untuk bensin
        if ($ujiemisi->kendaraan->bahan_bakar == "Bensin") {
            switch ($ujiemisi->kendaraan->kendaraan_kategori) {
              case '1':
                  if ($ujiemisi->kendaraan->tahun < 2007) {
                      if ($ujiemisi->co <= 4 && $ujiemisi->hc <=1000) {
                          $isLulus = true;
                      }
                  } elseif ($ujiemisi->kendaraan->tahun > 2018) {
                      if ($ujiemisi->co <= 0.5 && $ujiemisi->hc <= 100) {
                          $isLulus = true;
                      }
                  } else {
                      if ($ujiemisi->co <= 1 && $ujiemisi->hc <= 150) {
                          $isLulus = true;
                      }
                  }
                  break;

              case '2':
                  if ($ujiemisi->kendaraan->tahun < 2007) {
                      if ($ujiemisi->co <= 4 && $ujiemisi->hc <=1100) {
                          $isLulus = true;
                      }
                  } elseif ($ujiemisi->kendaraan->tahun > 2018) {
                      if ($ujiemisi->co <= 0.5 && $ujiemisi->hc <= 150) {
                          $isLulus = true;
                      }
                  } else {
                      if ($ujiemisi->co <= 1 && $ujiemisi->hc <= 200) {
                          $isLulus = true;
                      }
                  }
                  break;

              case '3':
                  if ($ujiemisi->kendaraan->tahun < 2007) {
                      if ($ujiemisi->co <= 4 && $ujiemisi->hc <=1100) {
                          $isLulus = true;
                      }
                  } elseif ($ujiemisi->kendaraan->tahun > 2018) {
                      if ($ujiemisi->co <= 0.5 && $ujiemisi->hc <= 150) {
                          $isLulus = true;
                      }
                  } else {
                      if ($ujiemisi->co <= 1 && $ujiemisi->hc <= 200) {
                          $isLulus = true;
                      }
                  }
                  break;

              case '4': // 2 tak
                  if ($ujiemisi->kendaraan->tahun < 2010) {
                      if ($ujiemisi->co <= 4.5 && $ujiemisi->hc <=6000) {
                          $isLulus = true;
                      }
                  } elseif ($ujiemisi->kendaraan->tahun > 2016) {
                      if ($ujiemisi->co <= 3 && $ujiemisi->hc <= 1000) {
                          $isLulus = true;
                      }
                  } else {
                      if ($ujiemisi->co <= 4 && $ujiemisi->hc <= 1800) {
                          $isLulus = true;
                      }
                  }
                  break;

              case '5': // 4 tak
                  if ($ujiemisi->kendaraan->tahun < 2010) {
                      if ($ujiemisi->co <= 5.5 && $ujiemisi->hc <=2200) {
                          $isLulus = true;
                      }
                  } elseif ($ujiemisi->kendaraan->tahun > 2016) {
                      if ($ujiemisi->co <= 3 && $ujiemisi->hc <= 1000) {
                          $isLulus = true;
                      }
                  } else {
                      if ($ujiemisi->co <= 4 && $ujiemisi->hc <= 1800) {
                          $isLulus = true;
                      }
                  }
                  break;

              default:
                  break;
          }
            # code...
        } elseif ($ujiemisi->kendaraan->bahan_bakar == "Solar") {
            if ($ujiemisi->kendaraan->tahun < 2010) {
                if ($ujiemisi->opasitas <= 65) {
                    $isLulus = true;
                }
            } elseif ($ujiemisi->kendaraan->tahun > 2021) {
                if ($ujiemisi->opasitas <= 30) {
                    $isLulus = true;
                }
            } else {
                if ($ujiemisi->opasitas <= 40) {
                    $isLulus = true;
                }
            }
        }
        return $isLulus;
    }

    public function cetakPdfDotMatrix() {
        $ujiemisi = Session::get('ujiemisi');

        $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $ujiemisi->tanggal_uji)->format('d-m-Y');
        $expirationDate = Carbon::createFromFormat('d-m-Y', $formattedDate)->addYear()->format('d-m-Y');
        $alamat = strtoupper($ujiemisi->kendaraan->user->jalan) . ' ' . $ujiemisi->kendaraan->user->kab_kota;

        $row=23;
        $table=155;
        $space_per_row=4.3;
        $column=35;

        // setting nama kepala bengkel
        $kepala_bengkel = $ujiemisi->user->kepala_bengkel;
        if (strlen($kepala_bengkel) > 16) {
            // Potong kata terakhir dan ambil huruf pertama
            $last_space_position = strrpos(substr($kepala_bengkel, 0, 16), ' ');
            $kepala_bengkel = substr($kepala_bengkel, 0, $last_space_position) . ' ' . substr($kepala_bengkel, $last_space_position + 1, 1) . '.';
        }

        $kepala_bengkel_baru_formatted = str_pad($kepala_bengkel, 16, ' ', STR_PAD_BOTH);

        $pdf = new FPDF('L','mm',array(203.2,78)); //tambah 2 karena kepotong // original
        // $pdf = new FPDF('P','mm',array(203.2,203.2)); //tambah 2 karena kepotong // coba buat printer
        $pdf->AddPage();
        $pdf->SetFont('courier','',9);
        $pdf->Text($column,$row-0.5,strtoupper($formattedDate));
        $pdf->Text($column,$row+$space_per_row-0.5,strtoupper($ujiemisi->kendaraan->merk));
        $pdf->Text($column,$row+($space_per_row*2)-0.5,strtoupper($ujiemisi->kendaraan->tipe));$pdf->Text($table,$row+($space_per_row*3)-0.5,$ujiemisi->co);
        $pdf->Text($column,$row+($space_per_row*3)-0.5,strtoupper($ujiemisi->kendaraan->tahun));$pdf->Text($table,$row+($space_per_row*4)-0.5,$ujiemisi->hc);
        $pdf->Text($column,$row+($space_per_row*4),strtoupper($ujiemisi->kendaraan->cc));
        $pdf->Text($column,$row+($space_per_row*5)-0.5,strtoupper($ujiemisi->kendaraan->no_rangka));$pdf->Text($table,$row+($space_per_row*6)-0.5,$ujiemisi->opasitas);
        $pdf->Text($column,$row+($space_per_row*6)-0.5,strtoupper($ujiemisi->kendaraan->no_mesin));
        $pdf->Text($column,$row+($space_per_row*7)-0.5,strtoupper($ujiemisi->kendaraan->bahan_bakar));
        $pdf->Text($column,$row+($space_per_row*8),strtoupper($ujiemisi->odometer));
        $pdf->Text($column,$row+($space_per_row*9),strtoupper($ujiemisi->kendaraan->user->bengkel_name));
        $pdf->Text($column,$row+($space_per_row*10),strtoupper($alamat)); $pdf->Text($table-26,$row+($space_per_row*11)+1.5,strtoupper($kepala_bengkel_baru_formatted)); //setting maks 16 huruf

        $pdf->SetFont('courier', 'B', 9);
        $pdf->Text($column,$row+($space_per_row*11)+1,strtoupper($ujiemisi->kendaraan->nopol));
        $pdf->SetFont('courier','',9);
        $pdf->Text($column,$row+($space_per_row*12)+0.5,strtoupper($expirationDate));
        // $pdf->Text(168,97,strtoupper("test"));
        $pdf->Output();
        // $pdf->Output('F', public_path('pdf/' . $fileName));

        $fileName = $formattedDate . '_' . $ujiemisi->kendaraan->nopol . '.pdf';
        exit;
    }

    public function cetakPdfPrinter() {
        $ujiemisi = Session::get('ujiemisi');

        $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $ujiemisi->tanggal_uji)->format('d-m-Y');
        $expirationDate = Carbon::createFromFormat('d-m-Y', $formattedDate)->addYear()->format('d-m-Y');
        $alamat = strtoupper($ujiemisi->kendaraan->user->jalan) . ' ' . $ujiemisi->kendaraan->user->kab_kota;

        $row=21;
        $table=155+18+4;
        $space_per_row=4.1;
        $little_space=0.2;
        $column=35+26-4;

        // setting nama kepala bengkel
        $kepala_bengkel = $ujiemisi->user->kepala_bengkel;
        if (strlen($kepala_bengkel) > 16) {
            // Potong kata terakhir dan ambil huruf pertama
            $last_space_position = strrpos(substr($kepala_bengkel, 0, 16), ' ');
            $kepala_bengkel = substr($kepala_bengkel, 0, $last_space_position) . ' ' . substr($kepala_bengkel, $last_space_position + 1, 1) . '.';
        }

        $kepala_bengkel_baru_formatted = str_pad($kepala_bengkel, 16, ' ', STR_PAD_BOTH);

        $pdf = new FPDF('P','mm',array(203.2, 297));
        $pdf->AddPage();
        $pdf->SetFont('courier','',9);
        $pdf->Text($column,$row-0.5,strtoupper($formattedDate));
        $pdf->Text($column,$row+$space_per_row,strtoupper($ujiemisi->kendaraan->merk));
        $pdf->Text($column,$row+($space_per_row*2),strtoupper($ujiemisi->kendaraan->tipe));$pdf->Text($table,$row+($space_per_row*3)-1,$ujiemisi->co);
        $pdf->Text($column,$row+($space_per_row*3),strtoupper($ujiemisi->kendaraan->tahun));$pdf->Text($table,$row+($space_per_row*4)-1,$ujiemisi->hc);
        $pdf->Text($column,$row+($space_per_row*4)+($little_space),strtoupper($ujiemisi->kendaraan->cc));
        $pdf->Text($column,$row+($space_per_row*5)+($little_space*2),strtoupper($ujiemisi->kendaraan->no_rangka));$pdf->Text($table,$row+($space_per_row*6)-1,$ujiemisi->opasitas);
        $pdf->Text($column,$row+($space_per_row*6)+($little_space*3),strtoupper($ujiemisi->kendaraan->no_mesin));
        $pdf->Text($column,$row+($space_per_row*7)+($little_space*4),strtoupper($ujiemisi->kendaraan->bahan_bakar));
        $pdf->Text($column,$row+($space_per_row*8)+($little_space*5),strtoupper($ujiemisi->odometer));
        $pdf->Text($column,$row+($space_per_row*9)+($little_space*5),strtoupper($ujiemisi->kendaraan->user->bengkel_name));
        $pdf->Text($column,$row+($space_per_row*10)+($little_space*4),strtoupper($alamat)); $pdf->Text($table-26,$row+($space_per_row*11)+1,strtoupper($kepala_bengkel_baru_formatted)); //setting maks 16 huruf
        $pdf->SetFont('courier','B',9);
        $pdf->Text($column,$row+($space_per_row*11)+1,strtoupper($ujiemisi->kendaraan->nopol));
        $pdf->SetFont('courier','',9);
        $pdf->Text($column,$row+($space_per_row*12)+0.5,strtoupper($expirationDate));
        // $pdf->Text(168,97,strtoupper("test"));
        $pdf->Output();
        // $pdf->Output('F', public_path('pdf/' . $fileName));

        $fileName = $formattedDate . '_' . $ujiemisi->kendaraan->nopol . '.pdf';
        exit;
    }
}
