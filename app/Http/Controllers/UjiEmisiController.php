<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUjiEmisiRequest;
use App\Http\Requests\UpdateUjiEmisiRequest;
use Illuminate\Http\Request;
use App\Models\UjiEmisi;
use App\Models\Kendaraan;
use Codedge\Fpdf\Fpdf\Fpdf;

use Carbon\Carbon;

class UjiEmisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $keyword = $request->keyword;
        if (auth()->user()->is_admin || auth()->user()->user_kategori != 'bengkel') {

            // Query uji emisi dengan join ke tabel kendaraan
            $ujiemisis = UjiEmisi::with('kendaraan')
                ->join('kendaraans', 'uji_emisis.kendaraan_id', '=', 'kendaraans.id')
                ->select('uji_emisis.*') // Pilih kolom dari uji_emisis
                ->where('kendaraans.nopol', 'LIKE', '%'.$keyword.'%')
                ->orWhere('kendaraans.merk','LIKE', '%'.$keyword.'%')
                ->orWhere('kendaraans.tipe','LIKE', '%'.$keyword.'%')
                ->orWhere('kendaraans.bahan_bakar','LIKE', '%'.$keyword.'%')
                ->orWhere('kendaraans.ujiemisis.tanggal_uji','LIKE', '%'.$keyword.'%')
                ->paginate(10);
            $ujiemisis->appends($request->all());
        } else {
            $ujiemisis = UjiEmisi::with('kendaraan')
                ->join('kendaraans', 'uji_emisis.kendaraan_id', '=', 'kendaraans.id')
                ->select('uji_emisis.*') // Pilih kolom dari uji_emisis
                ->where('uji_emisis.user_id', auth()->user()->id)
                ->where(function($query) use ($keyword) {
                    $query
                        ->where('kendaraans.nopol', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('kendaraans.merk','LIKE', '%'.$keyword.'%')
                        ->orWhere('kendaraans.tipe','LIKE', '%'.$keyword.'%')
                        ->orWhere('kendaraans.bahan_bakar','LIKE', '%'.$keyword.'%')
                        ->orWhere('kendaraans.ujiemisis.tanggal_uji','LIKE', '%'.$keyword.'%')
                ;
                })
                ->paginate(10);
            $ujiemisis->appends($request->all());
        }

        $totalRecords = $ujiemisis->total();

        return view('dashboard.UjiEmisi.index', [
            "title" => "List Kendaraan",
            // "kendaraans" => $kendaraans, // Gunakan kendaraans di view jika diperlukan
            "ujiemisis" => $ujiemisis,
            "bengkel_name" => auth()->user()->bengkel_name,
            "keyword" => $keyword,
            "totalRecords" => $totalRecords
        ]);
    }

    public function showInputSertifikat(UjiEmisi $ujiemisi, $ujiemisi_id)
    {
        $ujiemisiLulus = UjiEmisi::findOrFail($ujiemisi_id);
        return view('dashboard.UjiEmisi.input-sertif', [
            "bengkel_name" => auth()->user()->bengkel_name,
            "ujiemisi" => $ujiemisiLulus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        $kendaraan = "";
        // dd($kendaraan);
        return view('dashboard.UjiEmisi.insert-uji', [
            "bengkel_name" => auth()->user()->bengkel_name,
            "kendaraan" => $kendaraan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreUjiEmisiRequest $request)
    {
        $validatedData = $request->validate([
            'nopol' => '',
            'merk' => '',
            'tipe' => '',
            'tahun' => '|gt:1900',
            'cc' => '|gt:100',
            'no_rangka' => '',
            'no_mesin' => '',
            'kendaraan_kategori' => '',
            'bahan_bakar' => '',
            'odometer' => 'required',
            'co' => 'numeric|between:0,9.99',
            'hc' => 'integer|between:0,9999',
            'opasitas' => 'integer|between:0,100',
            'co2' => 'nullable|numeric|between:0,19.9',
            'co_koreksi' => 'nullable|numeric|between:0,9.99',
            'o2' => 'nullable|numeric|between:0,25',
            'putaran' => 'nullable|integer|between:300,9990',
            'temperatur' => 'nullable|numeric|between:10,150',
            'lambda' => 'nullable|numeric|between:0.5,5',
        ], [
            'tahun.gt' => 'Tahun kendaraan harus lebih besar dari 1900',
            'cc.gt' => 'Kapasitas mesin (CC) harus lebih besar dari 100',
            'odometer.required' => 'Odometer kendaraan harus diisi',
            'co.numeric' => 'Nilai CO harus berupa angka',
            'co.between' => 'Nilai CO harus antara 0 sampai 9.99',
            'hc.integer' => 'HC harus berupa bilangan bulat',
            'hc.between' => 'HC harus berada di antara 0 sampai 9999',
            'opasitas.numeric' => 'Nilai opasitas harus berupa angka',
            'opasitas.between' => 'Nilai opasitas harus antara 0 sampai 9.99',
            'co2.numeric' => 'Nilai CO2 harus berupa angka',
            'co2.between' => 'Nilai CO2 harus antara 0 sampai 19.9',
            'co_koreksi.numeric' => 'Nilai CO koreksi harus berupa angka',
            'co_koreksi.between' => 'Nilai CO koreksi harus antara 0 sampai 9.99',
            'o2.numeric' => 'Nilai O2 harus berupa angka',
            'o2.between' => 'Nilai O2 harus antara 0 sampai 25',
            'putaran.integer' => 'Putaran mesin harus berupa bilangan bulat',
            'putaran.between' => 'Putaran mesin harus antara 300 sampai 9990',
            'temperatur.numeric' => 'Suhu oli harus berupa angka',
            'temperatur.between' => 'Suhu oli harus antara 10 sampai 150',
            'lambda.numeric' => 'Nilai Lambda harus berupa angka',
            'lambda.between' => 'Nilai Lambda harus antara 0.5 sampai 5',
        ]);  

        $lastKendaraan = Kendaraan::orderBy('id', 'desc')->first();
        $lastKendaraanId = $lastKendaraan ? $lastKendaraan->id : 0;

        $idKendaraanBaru = $lastKendaraanId;

        if ($idKendaraanBaru) {
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['kendaraan_id'] = $idKendaraanBaru;



            $ujiemisi = UjiEmisi::create($validatedData);

            if ($this->checkIsLulus($ujiemisi)) {
                return redirect("/dashboard/ujiemisi/input-sertif/{$ujiemisi->id}/input-nomor")->with('success', "Kendaraan dinyatakan lulus uji emisi");
            } else {
                return redirect("/dashboard/ujiemisi")->with('error', 'Uji emisi berhasil ditambah tetapi kendaraan tidak lulus uji emisi');
            }

        } else {
            return redirect('/dashboard/ujiemisi')->with('error', 'Gagal menambahkan hasil uji. Silakan coba lagi.');
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UjiEmisi $ujiemisi, Kendaraan $kendaraan)
    {
        // dd($kendaraan);
        // dd($ujiemisi);
        return view('dashboard.UjiEmisi.edit-uji', [
            "bengkel_name" => auth()->user()->bengkel_name,
            'kendaraan' => $kendaraan,
            'ujiemisi' => $ujiemisi,
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUjiEmisiRequest $request, UjiEmisi $ujiemisi)
    {
        $validatedData = $request->validate([
            'nopol' => '',
            'merk' => '',
            'tipe' => '',
            'tahun' => '|gt:1900',
            'cc' => '|gt:100',
            'no_rangka' => '',
            'no_mesin' => '',
            'kendaraan_kategori' => '',
            'bahan_bakar' => '',
            'odometer' => 'required',
            'co' => 'numeric|between:0,9.99',
            'hc' => 'integer|between:0,9999',
            'opasitas' => 'integer|between:0,100',
            'co2' => 'nullable|numeric|between:0,19.9',
            'co_koreksi' => 'nullable|numeric|between:0,9.99',
            'o2' => 'nullable|numeric|between:0,25',
            'putaran' => 'nullable|integer|between:300,9990',
            'temperatur' => 'nullable|numeric|between:10,150',
            'lambda' => 'nullable|numeric|between:0.5,5',
        ], [
            'tahun.gt' => 'Tahun kendaraan harus lebih besar dari 1900',
            'cc.gt' => 'Kapasitas mesin (CC) harus lebih besar dari 100',
            'odometer.required' => 'Odometer kendaraan harus diisi',
            'co.numeric' => 'Nilai CO harus berupa angka',
            'co.between' => 'Nilai CO harus antara 0 sampai 9.99',
            'hc.integer' => 'HC harus berupa bilangan bulat',
            'hc.between' => 'HC harus berada di antara 0 sampai 9999',
            'opasitas.numeric' => 'Nilai opasitas harus berupa angka',
            'opasitas.between' => 'Nilai opasitas harus antara 0 sampai 9.99',
            'co2.numeric' => 'Nilai CO2 harus berupa angka',
            'co2.between' => 'Nilai CO2 harus antara 0 sampai 19.9',
            'co_koreksi.numeric' => 'Nilai CO koreksi harus berupa angka',
            'co_koreksi.between' => 'Nilai CO koreksi harus antara 0 sampai 9.99',
            'o2.numeric' => 'Nilai O2 harus berupa angka',
            'o2.between' => 'Nilai O2 harus antara 0 sampai 25',
            'putaran.integer' => 'Putaran mesin harus berupa bilangan bulat',
            'putaran.between' => 'Putaran mesin harus antara 300 sampai 9990',
            'temperatur.numeric' => 'Suhu oli harus berupa angka',
            'temperatur.between' => 'Suhu oli harus antara 10 sampai 150',
            'lambda.numeric' => 'Nilai Lambda harus berupa angka',
            'lambda.between' => 'Nilai Lambda harus antara 0.5 sampai 5',
        ]);  

        $validatedData['user_id'] = auth()->user()->id;
        UjiEmisi::where('id', $ujiemisi->id)->update($validatedData);
        $ujiemisi->refresh();

        if ($this->checkIsLulus($ujiemisi)) {
            return redirect("/dashboard/ujiemisi/input-sertif/{$ujiemisi->id}/input-nomor")->with('success', "Kendaraan dinyatakan lulus uji emisi");
        } else {
            return redirect("/dashboard/ujiemisi")->with('error', 'Uji emisi berhasil diedit tetapi kendaraan tidak lulus uji emisi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

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

    public function destroy(UjiEmisi $ujiemisi)
    {

        UjiEmisi::destroy($ujiemisi->id);
        return redirect('/dashboard/ujiemisi')->with('success', 'Hasil uji berhasil dihapus');
        //
    }
}
