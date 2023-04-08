<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use App\Models\Uraian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BidangSubkegiatanController extends Controller
{
    public function index($program_id, $kegiatan_id)
    {
        $data = Subkegiatan::where('kegiatan_id', $kegiatan_id)->where('jenis_rfk', 'murni')->orderBy('id', 'DESC')->paginate(25);
        //dd($data);
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        //dd('d');
        return view('bidang.subkegiatan.index', compact('data', 'program', 'kegiatan', 'program_id', 'kegiatan_id'));
    }

    public function detailSubKegiatan($id)
    {
        //status rfk
        $status = statusRFK();
        if ($status == 'murni') {
            $result = null;
        } elseif ($status == 'perubahan') {
            $result = 99;
        }

        $data = Uraian::where('subkegiatan_id', $id)->where('status', $result)->get();
        $data->map(function ($item) {
            $item->angkas = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
            return $item;
        });
        $subkegiatan = Subkegiatan::find($id);
        return view('bidang.detailuraian', compact('data', 'subkegiatan'));
    }


    public function create($program_id, $kegiatan_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);

        return view('bidang.subkegiatan.create', compact('program', 'kegiatan', 'program_id', 'kegiatan_id'));
    }

    public function edit($program_id, $kegiatan_id, $subkegiatan_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $data = Subkegiatan::find($subkegiatan_id);
        return view('bidang.subkegiatan.edit', compact('program', 'data', 'kegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id'));
    }
    public function store(Request $req, $program_id, $kegiatan_id)
    {
        $n              = new Subkegiatan;
        $n->skpd_id     = Auth::user()->bidang->skpd_id;
        $n->bidang_id   = Auth::user()->bidang->id;
        $n->program_id  = $program_id;
        $n->tahun       = Program::find($program_id)->tahun;
        $n->kegiatan_id = $kegiatan_id;
        $n->nama        = $req->nama;
        $n->jenis_rfk   = 'murni';
        // $n->dpa = (int)str_replace(str_split('Rp.'), '', $req->dpa);
        $n->save();
        Session::flash('success', 'Sub Kegiatan Berhasil Disimpan');
        return redirect('/bidang/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id);
    }

    public function update(Request $req, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $n = Subkegiatan::find($subkegiatan_id);
        $n->nama = $req->nama;
        $n->save();
        Session::flash('success', 'Berhasil Di Update');
        return redirect('/bidang/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id);
    }

    public function delete($program_id, $kegiatan_id, $subkegiatan_id)
    {
        try {
            Subkegiatan::find($subkegiatan_id)->delete();
            Session::flash('success', 'Berhasil Di Hapus');
            return back();
        } catch (\Exception $e) {
            Session::flash('error', 'Tidak bisa di hapus karena memiliki Uraian kegiatan');
            return back();
        }
    }

    //-------------------------------------------------------------------------
    public function realisasi($program_id, $kegiatan_id, $subkegiatan_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        return view('bidang.subkegiatan.realisasi', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id'));
    }

    public function storerealisasi(Request $req, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $bulan = Carbon::now()->month;
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $update = Subkegiatan::find($subkegiatan_id);
        $rk_jan = (int)str_replace(str_split('.'), '', $req->r_januari_keuangan);
        $rk_feb = (int)str_replace(str_split('.'), '', $req->r_februari_keuangan);
        $rk_mar = (int)str_replace(str_split('.'), '', $req->r_maret_keuangan);
        $rk_apr = (int)str_replace(str_split('.'), '', $req->r_april_keuangan);
        $rk_mei = (int)str_replace(str_split('.'), '', $req->r_mei_keuangan);
        $rk_jun = (int)str_replace(str_split('.'), '', $req->r_juni_keuangan);
        $rk_jul = (int)str_replace(str_split('.'), '', $req->r_juli_keuangan);
        $rk_agu = (int)str_replace(str_split('.'), '', $req->r_agustus_keuangan);
        $rk_sep = (int)str_replace(str_split('.'), '', $req->r_september_keuangan);
        $rk_okt = (int)str_replace(str_split('.'), '', $req->r_oktober_keuangan);
        $rk_nov = (int)str_replace(str_split('.'), '', $req->r_november_keuangan);
        $rk_des = (int)str_replace(str_split('.'), '', $req->r_desember_keuangan);

        $rf_jan = (int)str_replace(str_split('.'), '', $req->r_januari_fisik);
        $rf_feb = (int)str_replace(str_split('.'), '', $req->r_februari_fisik);
        $rf_mar = (int)str_replace(str_split('.'), '', $req->r_maret_fisik);
        $rf_apr = (int)str_replace(str_split('.'), '', $req->r_april_fisik);
        $rf_mei = (int)str_replace(str_split('.'), '', $req->r_mei_fisik);
        $rf_jun = (int)str_replace(str_split('.'), '', $req->r_juni_fisik);
        $rf_jul = (int)str_replace(str_split('.'), '', $req->r_juli_fisik);
        $rf_agu = (int)str_replace(str_split('.'), '', $req->r_agustus_fisik);
        $rf_sep = (int)str_replace(str_split('.'), '', $req->r_september_fisik);
        $rf_okt = (int)str_replace(str_split('.'), '', $req->r_oktober_fisik);
        $rf_nov = (int)str_replace(str_split('.'), '', $req->r_november_fisik);
        $rf_des = (int)str_replace(str_split('.'), '', $req->r_desember_fisik);

        if ($bulan == 1) {
            if ($rk_jan > $subkegiatan->januari_keuangan || $rf_jan > $subkegiatan->januari_fisik) {
                Session::flash('info', 'Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_januari_keuangan' => $rk_jan,
                    'r_januari_fisik' => $rf_jan,
                ]);
                Session::flash('info', 'Realisasi Berhasil Disimpan');
                return back();
            }
        }

        if ($bulan == 2) {
            if ($rk_feb > $subkegiatan->februari_keuangan || $rf_feb > $subkegiatan->februari_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_februari_keuangan' => $rk_feb,
                    'r_februari_fisik' => $rf_feb,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }

        if ($bulan == 3) {
            if ($rk_mar > $subkegiatan->maret_keuangan || $rf_mar > $subkegiatan->maret_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_maret_keuangan' => $rk_mar,
                    'r_maret_fisik' => $rf_mar,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }

        if ($bulan == 4) {
            if ($rk_apr > $subkegiatan->april_keuangan || $rf_apr > $subkegiatan->april_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_april_keuangan' => $rk_apr,
                    'r_april_fisik' => $rf_apr,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }

        if ($bulan == 5) {
            if ($rk_mei > $subkegiatan->mei_keuangan || $rf_mei > $subkegiatan->mei_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_mei_keuangan' => $rk_mei,
                    'r_mei_fisik' => $rf_mei,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }

        if ($bulan == 6) {
            if ($rk_jun > $subkegiatan->juni_keuangan || $rf_jun > $subkegiatan->juni_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_juni_keuangan' => $rk_jun,
                    'r_juni_fisik' => $rf_jun,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }

        if ($bulan == 7) {
            if ($rk_jul > $subkegiatan->juli_keuangan || $rf_jul > $subkegiatan->juli_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_juli_keuangan' => $rk_jul,
                    'r_juli_fisik' => $rf_jul,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }

        if ($bulan == 8) {
            if ($rk_agu > $subkegiatan->agustus_keuangan || $rf_agu > $subkegiatan->agustus_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_agustus_keuangan' => $rk_agu,
                    'r_agustus_fisik' => $rf_agu,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }
        if ($bulan == 9) {
            if ($rk_sep > $subkegiatan->september_keuangan || $rf_sep > $subkegiatan->september_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_september_keuangan' => $rk_sep,
                    'r_september_fisik' => $rf_sep,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }
        if ($bulan == 10) {
            if ($rk_okt > $subkegiatan->oktober_keuangan || $rf_okt > $subkegiatan->oktober_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_oktober_keuangan' => $rk_okt,
                    'r_oktober_fisik' => $rf_okt,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }
        if ($bulan == 11) {
            if ($rk_nov > $subkegiatan->november_keuangan || $rf_nov > $subkegiatan->november_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_november_keuangan' => $rk_nov,
                    'r_november_fisik' => $rf_nov,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }
        if ($bulan == 12) {
            if ($rk_des > $subkegiatan->desember_keuangan || $rf_des > $subkegiatan->desember_fisik) {
                toastr()->error('Nilai Realisasi Tidak bisa lebih dari yang di anggarkan');
                return back();
            } else {
                $update->update([
                    'r_desember_keuangan' => $rk_des,
                    'r_desember_fisik' => $rf_des,
                ]);
                toastr()->success('Realisasi Berhasil Disimpan');
                return back();
            }
        }
    }

    public function rencana($program_id, $kegiatan_id, $subkegiatan_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        return view('bidang.subkegiatan.rencana', compact('program', 'kegiatan', 'subkegiatan', 'program_id', 'kegiatan_id', 'subkegiatan_id'));
    }

    public function storerencana(Request $req, $program_id, $kegiatan_id, $subkegiatan_id)
    {
        $program = Program::find($program_id);
        $kegiatan = Kegiatan::find($kegiatan_id);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $jan_keuangan = (int)str_replace(str_split('.'), '', $req->januari_keuangan);
        $feb_keuangan = (int)str_replace(str_split('.'), '', $req->februari_keuangan);
        $mar_keuangan = (int)str_replace(str_split('.'), '', $req->maret_keuangan);
        $apr_keuangan = (int)str_replace(str_split('.'), '', $req->april_keuangan);
        $mei_keuangan = (int)str_replace(str_split('.'), '', $req->mei_keuangan);
        $jun_keuangan = (int)str_replace(str_split('.'), '', $req->juni_keuangan);
        $jul_keuangan = (int)str_replace(str_split('.'), '', $req->juli_keuangan);
        $agu_keuangan = (int)str_replace(str_split('.'), '', $req->agustus_keuangan);
        $sep_keuangan = (int)str_replace(str_split('.'), '', $req->september_keuangan);
        $okt_keuangan = (int)str_replace(str_split('.'), '', $req->oktober_keuangan);
        $nov_keuangan = (int)str_replace(str_split('.'), '', $req->november_keuangan);
        $des_keuangan = (int)str_replace(str_split('.'), '', $req->desember_keuangan);
        $keuangan = $jan_keuangan + $feb_keuangan + $mar_keuangan + $apr_keuangan + $mei_keuangan + $jun_keuangan + $jul_keuangan + $agu_keuangan + $sep_keuangan + $okt_keuangan + $nov_keuangan + $des_keuangan;

        $jan_fisik = (int)str_replace(str_split('.'), '', $req->januari_fisik);
        $feb_fisik = (int)str_replace(str_split('.'), '', $req->februari_fisik);
        $mar_fisik = (int)str_replace(str_split('.'), '', $req->maret_fisik);
        $apr_fisik = (int)str_replace(str_split('.'), '', $req->april_fisik);
        $mei_fisik = (int)str_replace(str_split('.'), '', $req->mei_fisik);
        $jun_fisik = (int)str_replace(str_split('.'), '', $req->juni_fisik);
        $jul_fisik = (int)str_replace(str_split('.'), '', $req->juli_fisik);
        $agu_fisik = (int)str_replace(str_split('.'), '', $req->agustus_fisik);
        $sep_fisik = (int)str_replace(str_split('.'), '', $req->september_fisik);
        $okt_fisik = (int)str_replace(str_split('.'), '', $req->oktober_fisik);
        $nov_fisik = (int)str_replace(str_split('.'), '', $req->november_fisik);
        $des_fisik = (int)str_replace(str_split('.'), '', $req->desember_fisik);
        $fisik = $jan_fisik + $feb_fisik + $mar_fisik + $apr_fisik + $mei_fisik + $jun_fisik + $jul_fisik + $agu_fisik + $sep_fisik + $okt_fisik + $nov_fisik + $des_fisik;

        if ($keuangan != $subkegiatan->dpa) {
            toastr()->error('Jumlah Keuangan: ' . number_format($keuangan) . ' Tidak Sesuai Dengan DPA (' . number_format($subkegiatan->dpa) . ')');
            $req->flash();
            return back();
        }

        if ($fisik != $subkegiatan->dpa) {
            toastr()->error('Jumlah Fisik: ' . number_format($fisik) . ' Tidak Sesuai Dengan DPA (' . number_format($subkegiatan->dpa) . ')');
            $req->flash();
            return back();
        }

        $u = $subkegiatan;
        $u->januari_keuangan     = $jan_keuangan;
        $u->februari_keuangan    = $feb_keuangan;
        $u->maret_keuangan       = $mar_keuangan;
        $u->april_keuangan       = $apr_keuangan;
        $u->mei_keuangan         = $mei_keuangan;
        $u->juni_keuangan        = $jun_keuangan;
        $u->juli_keuangan        = $jul_keuangan;
        $u->agustus_keuangan     = $agu_keuangan;
        $u->september_keuangan   = $sep_keuangan;
        $u->oktober_keuangan     = $okt_keuangan;
        $u->november_keuangan    = $nov_keuangan;
        $u->desember_keuangan    = $des_keuangan;

        $u->januari_fisik     = $jan_fisik;
        $u->februari_fisik    = $feb_fisik;
        $u->maret_fisik       = $mar_fisik;
        $u->april_fisik       = $apr_fisik;
        $u->mei_fisik         = $mei_fisik;
        $u->juni_fisik        = $jun_fisik;
        $u->juli_fisik        = $jul_fisik;
        $u->agustus_fisik     = $agu_fisik;
        $u->september_fisik   = $sep_fisik;
        $u->oktober_fisik     = $okt_fisik;
        $u->november_fisik    = $nov_fisik;
        $u->desember_fisik    = $des_fisik;
        $u->save();

        toastr()->success('Berhasil Disimpan');
        return redirect('/skpd/bidang/program/kegiatan/' . $program_id . '/sub/' . $kegiatan_id);
    }

    public function perubahan()
    {
        toastr()->success('Perubahan Dalam Pengembangan');
        return back();
    }
}
