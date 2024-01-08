<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JenisRfk;
use App\Models\M_program;
use App\Models\T_capaian;
use App\Models\M_kegiatan;
use App\Models\M_indikator;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use App\Models\M_subkegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AdminCapaianController extends Controller
{

    public function hitungRealisasi()
    {
        $period = Carbon::now()->subMonths(11)->monthsUntil(now());

        $getAllMonth = [];
        foreach ($period as $date) {
            $getAllMonth[] = ['month' => $date->translatedFormat('F')];
        }

        $map = [];
        foreach ($getAllMonth as $item) {
            $item[] = [
                'tw' => 1,
            ];
        }
        //dd($getAllMonth);

        $bulan = Carbon::now()->translatedFormat('F');
        $statusRFK = JenisRfk::where('skpd_id',  Auth::user()->skpd->id)->where('tahun', 2023)->first();

        $result = $statusRFK[$bulan];

        $subkeg = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', 2023)->where('jenis_rfk', $result)->get();

        $mapsubkegi = $subkeg->map(function ($item) use ($result, $bulan) {
            $item->realisasi = realisasiSKPDTriwulan($bulan, $item, $result);
            $item->kodesubkegiatan = M_subkegiatan::where('nama', $item->nama)->first() == null ? null : M_subkegiatan::where('nama', $item->nama)->first()->kode;

            //simpan capaian di tabel t_capaian
            $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', 2023)->where('jenis', 'subkegiatan')->where('kode', $item->kodesubkegiatan)->first();

            if ($check == null) {
                $data = M_subkegiatan::where('nama', $item->nama)->first();
                if ($data == null) {
                } else {
                    //dd($data, $item->realisasi);
                    $new = new T_capaian;
                    $new->skpd_id = Auth::user()->skpd->id;
                    $new->jenis = 'subkegiatan';
                    $new->tahun = '2023';
                    $new->kode  = $data->kode;
                    $new->nama = $data->nama;
                    $new->tw1  = $item->realisasi['tw1'];
                    $new->tw2  = $item->realisasi['tw2'];
                    $new->tw3  = $item->realisasi['tw3'];
                    $new->tw4  = $item->realisasi['tw4'];
                    $new->save();
                }
            } else {
                $update = $check;
                $update->tw1 = $item->realisasi['tw1'];
                $update->tw2 = $item->realisasi['tw2'];
                $update->tw3 = $item->realisasi['tw3'];
                $update->tw4 = $item->realisasi['tw4'];
                $update->save();
                //update capaian TW1, TW2, TW3, TW4
            }
            return $item;
        });
        Session::flash('success', 'Berhasil Di Hitung');
        return back();
    }

    public function hapusIndikator()
    {
        M_indikator::where('tahun', 2023)->where('skpd_id', Auth::user()->skpd->id)->get()->map->delete();
        T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', 2023)->where('jenis', 'LIKE', '%indikator%')->get()->map->delete();
        Session::flash('success', 'Berhasil Di Hapus');
        return back();
    }
    public function tarikIndikator()
    {
        $response = Http::get('http://kayuhbaimbai.banjarmasinkota.go.id/api/renstra/target/skpd/1.01.001/2023')->json();

        foreach ($response as $key => $program) {
            //simpan indikator program
            foreach ($program['list_indikator'] as $indikator_program) {
                $checkIndikatorProgram = M_indikator::where('jenis', 'program')->where('tahun', '2023')->where('kode', $program['kode'])->where('kode_indikator', $indikator_program['kode'])->first();
                if ($checkIndikatorProgram == null) {
                    $s = new M_indikator;
                    $s->kode = $program['kode'];
                    $s->jenis = 'program';
                    $s->tahun = 2023;
                    $s->kode_indikator = $indikator_program['kode'];
                    $s->nama = $indikator_program['indikator'];
                    $s->skpd_id = Auth::user()->skpd->id;
                    $s->save();
                } else {
                    $checkIndikatorProgram->update([
                        'nama' => $indikator_program['indikator'],
                        'skpd_id' => Auth::user()->skpd->id,
                    ]);
                }
            }

            foreach ($program['kegiatan'] as $kegiatan) {
                //simpan indikator kegiatan
                foreach ($kegiatan['list_indikator'] as $indikator_kegiatan) {
                    $checkIndikatorKegiatan = M_indikator::where('jenis', 'kegiatan')->where('tahun', '2023')->where('kode', $kegiatan['kode'])->where('kode_indikator', $indikator_kegiatan['kode'])->first();
                    //dd($checkIndikatorKegiatan, $kegiatan);
                    if ($checkIndikatorKegiatan == null) {
                        $s = new M_indikator;
                        $s->kode = $kegiatan['kode'];
                        $s->jenis = 'kegiatan';
                        $s->tahun = 2023;
                        $s->kode_indikator = $indikator_kegiatan['kode'];
                        $s->nama = $indikator_kegiatan['indikator'];
                        $s->skpd_id = Auth::user()->skpd->id;
                        $s->save();
                    } else {
                        $checkIndikatorKegiatan->update([
                            'nama' => $indikator_kegiatan['indikator'],
                            'skpd_id' => Auth::user()->skpd->id,
                        ]);
                    }
                }

                //simpan indikator subkegiatan
                foreach ($kegiatan['subkegiatan'] as $subkegiatan) {
                    foreach ($subkegiatan['list_indikator'] as $indikator_subkegiatan) {
                        $checkIndikatorSubKegiatan = M_indikator::where('jenis', 'subkegiatan')->where('tahun', '2023')->where('kode', $subkegiatan['kode'])->where('kode_indikator', $indikator_subkegiatan['kode'])->first();
                        //dd($checkIndikatorSubKegiatan, $indikator_subkegiatan, $kegiatan['kode']);
                        if ($checkIndikatorSubKegiatan == null) {
                            $s = new M_indikator;
                            $s->kode = $subkegiatan['kode'];
                            $s->jenis = 'subkegiatan';
                            $s->tahun = 2023;
                            $s->kode_indikator = $indikator_subkegiatan['kode'];
                            $s->nama = $indikator_subkegiatan['indikator'];
                            $s->skpd_id = Auth::user()->skpd->id;
                            $s->save();
                        } else {
                            $checkIndikatorSubKegiatan->update([
                                'nama' => $indikator_subkegiatan['indikator'],
                                'skpd_id' => Auth::user()->skpd->id,
                            ]);
                        }
                    }
                }
            }
            //dd($indikator_kegiatan);
        }

        Session::flash('success', 'Berhasil Di Tarik');
        return back();
        //        dd($response);
    }
    public function index()
    {
        $tahun = "2023";
        $program = M_program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get()->map(function ($item, $key) use ($tahun) {
            return $item;
        });


        $count_program = M_program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $count_kegiatan = M_kegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();
        $count_subkegiatan = M_subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->count();


        return view('admin.capaian.index', compact('program', 'count_program', 'count_kegiatan', 'count_subkegiatan', 'tahun'));
    }

    public function updateCapaian(Request $req)
    {

        $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('jenis', $req->jenis)->where('kode', $req->kode)->first();
        $check->update([
            'tw1' => $req->tw1,
            'tw2' => $req->tw2,
            'tw3' => $req->tw3,
            'tw4' => $req->tw4,
        ]);
        Session::flash('success', 'Diupdate');
        return back();
    }

    public function simpanCapaian(Request $req)
    {
        if ($req->kode == null) {
            Session::flash('warning', 'Harap Isi Kode terlebih dahulu');
            return back();
        }
        $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('jenis', $req->jenis)->where('kode', $req->kode)->first();
        if ($check != null) {
            Session::flash('warning', 'Sudah ada');
            return back();
        } else {
            $n = new T_capaian;
            $n->skpd_id = Auth::user()->skpd->id;
            $n->tahun = $req->tahun;
            $n->jenis = $req->jenis;
            $n->kode = $req->kode;
            $n->nama = $req->uraian;
            $n->tw1 = $req->tw1;
            $n->tw2 = $req->tw2;
            $n->tw3 = $req->tw3;
            $n->tw4 = $req->tw4;
            $n->save();
            Session::flash('success', 'Berhasil Disimpan');
            return back();
        }
    }
    public function capaianProgram(Request $req)
    {
        if ($req->kode == null) {
            Session::flash('warning', 'Harap Isi Kode terlebih dahulu');
            return back();
        }
        $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('jenis', 'program')->where('kode', $req->kode)->first();
        if ($check != null) {
            Session::flash('warning', 'Sudah ada');
            return back();
        } else {
            $n = new T_capaian;
            $n->skpd_id = Auth::user()->skpd->id;
            $n->tahun = $req->tahun;
            $n->jenis = $req->jenis;
            $n->kode = $req->kode;
            $n->nama = $req->uraian;
            $n->capaian = $req->capaian;
            $n->save();
            Session::flash('success', 'Berhasil Disimpan');
            return back();
        }
    }
    public function capaianKegiatan(Request $req)
    {
        if ($req->kode == null) {
            Session::flash('warning', 'Harap Isi Kode terlebih dahulu');
            return back();
        }
        $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('jenis', 'kegiatan')->where('kode', $req->kode)->first();
        if ($check != null) {
            Session::flash('warning', 'Sudah ada');
            return back();
        } else {
            $n = new T_capaian;
            $n->skpd_id = Auth::user()->skpd->id;
            $n->tahun = $req->tahun;
            $n->jenis = $req->jenis;
            $n->kode = $req->kode;
            $n->nama = $req->uraian;
            $n->capaian = $req->capaian;
            $n->save();
            Session::flash('success', 'Berhasil Disimpan');
            return back();
        }
    }
    public function capaianSubkegiatan(Request $req)
    {
        if ($req->kode == null) {
            Session::flash('warning', 'Harap Isi Kode terlebih dahulu');
            return back();
        }
        $check = T_capaian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $req->tahun)->where('jenis', 'subkegiatan')->where('kode', $req->kode)->first();
        if ($check != null) {
            Session::flash('warning', 'Sudah ada');
            return back();
        } else {
            $n = new T_capaian;
            $n->skpd_id = Auth::user()->skpd->id;
            $n->tahun = $req->tahun;
            $n->jenis = $req->jenis;
            $n->kode = $req->kode;
            $n->nama = $req->uraian;
            $n->capaian = $req->capaian;
            $n->save();
            Session::flash('success', 'Berhasil Disimpan');
            return back();
        }
    }
}
