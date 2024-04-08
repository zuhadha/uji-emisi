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
                        ->orWhere('kendaraans.bahan_bakar','LIKE', '%'.$keyword.'%');
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


    // public function show(UjiEmisi $ujiemisi)
    // {
    //     return view('dashboard.ujiemisi.input-sertif', [
    //         "bengkel_name" => auth()->user()->bengkel_name,
    //         "ujiemisi" => $ujiemisi
    //     ]);
    // }

    public function showInputSertifikat(UjiEmisi $ujiemisi, $ujiemisi_id)
    {
        $ujiemisiLulus = UjiEmisi::findOrFail($ujiemisi_id);
        return view('dashboard.UjiEmisi.input-sertif', [
            "bengkel_name" => auth()->user()->bengkel_name,
            "ujiemisi" => $ujiemisiLulus
        ]);
    }

    public function inputSertifikat(Request $request, UjiEmisi $ujiemisi) // ini gak kepake.
    {
        $validatedData = $request->validate([
            'no_sertifikat' => 'required',
        ]);

        dd($request);

        UjiEmisi::where('id', $ujiemisi->id)->update($validatedData);

        $ujiemisi->update($validatedData);

        return redirect('/dashboard/ujiemisi')->with('success', 'Uji Emisi berhasil ditambahkan, dan kendaraan lulus uji emisi');
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
            'odometer' => 'required',
            'co' => '',
            'hc' => 'integer',
            'opasitas' => 'integer',
            'co2' => '',
            'co_koreksi' => '',
            'o2' => '',
            'putaran' => '',
            'temperatur' => '',
            'lambda' => '',
        ], [
            'hc.integer' => 'HC harus berupa bilangan bulat',
            'opasitas.integer' => 'Opasitas harus berupa bilangan bulat'
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
            'odometer' => 'required',
            'co' => '',
            'hc' => 'integer',
            'opasitas' => 'integer',
            'co2' => '',
            'co_koreksi' => '',
            'o2' => '',
            'putaran' => '',
            'temperatur' => '',
            'lambda' => '',
        ], [
            'hc.integer' => 'HC harus berupa bilangan bulat',
            'opasitas.integer' => 'Opasitas harus berupa bilangan bulat'
        ]);

        // $idKendaraan = session()->get('idKendaraan');
        // dd($ujiemisi);

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
