<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\T_m;
use App\Models\M_akun;
use App\Models\T_pptk;
use App\Models\Uraian;
use App\Models\JenisRfk;
use App\Models\Pengajuan;
use App\Models\BatasInput;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PPTK2Controller extends Controller
{
    public function updateRK(Request $request)
    {
        // Temukan data berdasarkan primary key (pk)
        $data = Uraian::find($request->pk);
        $bulan = 'r_' . $request->name . '_keuangan';

        $data->update([
            $bulan => (int)$request->value,
        ]);
        $data->save();
        // Kirim respons sukses
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
    }
    public function update_realisasi(Request $req)
    {
        return response()->json([$req->pk, $req->value]);
    }
    public function subkegiatan()
    {
        $status = 'murni';
        //dd(auth::user()->pptk);
        // if (Auth::user()->pptk->skpd->murni == 1) {
        //     $status = 'murni';
        // }
        // if (Auth::user()->pptk->skpd->pergeseran == 1) {
        //     $status = 'pergeseran';
        // }
        // if (Auth::user()->pptk->skpd->perubahan == 1) {
        //     $status = 'perubahan';
        // }
        //dd($status);
        $data = Subkegiatan::where('pptk_id', Auth::user()->pptk->id)->get();
        return view('pptk.subkegiatan.index', compact('data', 'status'));
    }

    public function uraian($subkegiatan_id)
    {
        if (Auth::user()->pptk->skpd->murni == 1) {
            $status = 'murni';
        }
        if (Auth::user()->pptk->skpd->pergeseran == 1) {
            $status = 'pergeseran';
        }
        if (Auth::user()->pptk->skpd->perubahan == 1) {
            $status = 'perubahan';
        }

        if ($status == 'pergeseran') {
            $data = Subkegiatan::find($subkegiatan_id)->uraian->where('jenis_rfk', $status)->where('ke', Auth::user()->pptk->skpd->ke)->values();
        } else {
            $data = Subkegiatan::find($subkegiatan_id)->uraian->where('jenis_rfk', $status);
        }

        // dd($status, Auth::user()->pptk->skpd->ke, Subkegiatan::find($subkegiatan_id)->uraian);
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        if ($subkegiatan->kode == null) {
            Session::flash('info', 'kode subkegiatan tidak ada, Harap perbaharui kode subkegiatan di admin skpd');
            return back();
        } else {
            return view('pptk.uraian.index', compact('data', 'subkegiatan'));
        }
    }


    public function addUraian($subkegiatan_id)
    {
        $subkegiatan = Subkegiatan::find($subkegiatan_id);

        $akun = M_akun::get();
        return view('pptk.uraian.create', compact('subkegiatan', 'subkegiatan_id', 'akun'));
    }
    public function editUraian($id)
    {
        $subkegiatan = Uraian::find($id)->subkegiatan;
        $data = Uraian::find($id);

        $akun = M_akun::get();
        return view('pptk.uraian.edit', compact('subkegiatan', 'data', 'akun'));
    }
    public function kirimUraian($id)
    {
        $data = Uraian::find($id)->update(['status_kirim' => 1]);
        return back();
    }
    public function storeuraian(Request $req, $subkegiatan_id)
    {

        if (Auth::user()->pptk->skpd->murni == 1) {
            $status = 'murni';
        }
        if (Auth::user()->pptk->skpd->pergeseran == 1) {
            $status = 'pergeseran';
        }
        if (Auth::user()->pptk->skpd->perubahan == 1) {
            $status = 'perubahan';
        }

        $ke = Pengajuan::where('skpd_id', Auth::user()->pptk->skpd->id)->where('status', 1)->orderBy('id', 'DESC')->get();
        if (count($ke) != 0) {
            $hasil = $ke->first()->ke;
        }

        $subkegiatan = Subkegiatan::find($subkegiatan_id);
        $rekening_belanja   = M_akun::find($req->kode_akun);
        $n                  = new Uraian;
        $n->pptk_id         = Auth::user()->pptk->id;
        $n->skpd_id         = $subkegiatan->skpd_id;
        $n->program_id      = $subkegiatan->kegiatan->program->id;
        $n->tahun           = $subkegiatan->tahun;
        $n->kegiatan_id     = $subkegiatan->kegiatan->id;
        $n->subkegiatan_id  = $subkegiatan_id;
        $n->m_akun_id       = $rekening_belanja->id;
        $n->kode_rekening   = $rekening_belanja->kode_akun;
        $n->nama            = $rekening_belanja->nama_akun;
        $n->keterangan      = $req->keterangan;
        $n->dpa             = (int)str_replace(str_split('Rp.'), '', $req->dpa);
        if (count($ke) != 0) {
            $n->ke      = $hasil;
        }
        $n->jenis_rfk       = $status;
        $n->save();
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/pptk/subkegiatan/uraian/' . $subkegiatan_id);
    }

    public function updateUraian(Request $req, $id)
    {

        $newdpa = (int)str_replace(str_split('Rp.'), '', $req->dpa);
        $subkegiatan_id = Uraian::find($id)->subkegiatan->id;
        $n = Uraian::find($id);

        if ($newdpa == 0) {
            $n->kode_rekening = $req->kode_rekening;
            $n->nama = $req->nama;
            $n->dpa = $newdpa;
            $n->keterangan = $req->keterangan;
            $n->p_januari_keuangan     = 0;
            $n->p_februari_keuangan    = 0;
            $n->p_maret_keuangan       = 0;
            $n->p_april_keuangan       = 0;
            $n->p_mei_keuangan         = 0;
            $n->p_juni_keuangan        = 0;
            $n->p_juli_keuangan        = 0;
            $n->p_agustus_keuangan     = 0;
            $n->p_september_keuangan   = 0;
            $n->p_oktober_keuangan     = 0;
            $n->p_november_keuangan    = 0;
            $n->p_desember_keuangan    = 0;
            $n->p_januari_fisik     = 0;
            $n->p_februari_fisik    = 0;
            $n->p_maret_fisik       = 0;
            $n->p_april_fisik       = 0;
            $n->p_mei_fisik         = 0;
            $n->p_juni_fisik        = 0;
            $n->p_juli_fisik        = 0;
            $n->p_agustus_fisik     = 0;
            $n->p_september_fisik   = 0;
            $n->p_oktober_fisik     = 0;
            $n->p_november_fisik    = 0;
            $n->p_desember_fisik    = 0;

            $n->save();
            Session::flash('success', 'Berhasil Di Update');
            return redirect('/pptk/subkegiatan/uraian/' . $subkegiatan_id);
        } else {
            $n->kode_rekening = $req->kode_rekening;
            $n->nama = $req->nama;
            $n->dpa = $newdpa;
            $n->keterangan = $req->keterangan;

            // $n->p_januari_fisik     = ($n->p_januari_keuangan / $newdpa) * 100;
            // $n->p_februari_fisik    = ($n->p_februari_keuangan / $newdpa) * 100;
            // $n->p_maret_fisik       = ($n->p_maret_keuangan / $newdpa) * 100;
            // $n->p_april_fisik       = ($n->p_april_keuangan / $newdpa) * 100;
            // $n->p_mei_fisik         = ($n->p_mei_keuangan / $newdpa) * 100;
            // $n->p_juni_fisik        = ($n->p_juni_keuangan / $newdpa) * 100;
            // $n->p_juli_fisik        = ($n->p_juli_keuangan / $newdpa) * 100;
            // $n->p_agustus_fisik     = ($n->p_agustus_keuangan / $newdpa) * 100;
            // $n->p_september_fisik   = ($n->p_september_keuangan / $newdpa) * 100;
            // $n->p_oktober_fisik     = ($n->p_oktober_keuangan / $newdpa) * 100;
            // $n->p_november_fisik    = ($n->p_november_keuangan / $newdpa) * 100;
            // $n->p_desember_fisik    = ($n->p_desember_keuangan / $newdpa) * 100;

            $n->save();
            Session::flash('success', 'Berhasil Di Update, harap sesuaikan kembali angkas anda jika merubah DPA');
            return redirect('/pptk/subkegiatan/uraian/' . $subkegiatan_id);
        }
    }

    public function deleteUraian($id)
    {
        Uraian::find($id)->delete();
        Session::flash('success', 'Berhasil Di Hapus');
        return back();
    }

    public function angkas($id)
    {
        $subkegiatan = Uraian::find($id)->subkegiatan;
        $uraian = Uraian::find($id);

        return view('pptk.angkas.create', compact('uraian', 'subkegiatan'));
    }

    public function updateAngkas(Request $req, $id)
    {

        $subkegiatan = Uraian::find($id)->subkegiatan;
        $uraian = Uraian::find($id);

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

        $jan_fisik = (float)str_replace(str_split(','), '.', $req->januari_fisik);
        $feb_fisik = (float)str_replace(str_split(','), '.', $req->februari_fisik);
        $mar_fisik = (float)str_replace(str_split(','), '.', $req->maret_fisik);
        $apr_fisik = (float)str_replace(str_split(','), '.', $req->april_fisik);
        $mei_fisik = (float)str_replace(str_split(','), '.', $req->mei_fisik);
        $jun_fisik = (float)str_replace(str_split(','), '.', $req->juni_fisik);
        $jul_fisik = (float)str_replace(str_split(','), '.', $req->juli_fisik);
        $agu_fisik = (float)str_replace(str_split(','), '.', $req->agustus_fisik);
        $sep_fisik = (float)str_replace(str_split(','), '.', $req->september_fisik);
        $okt_fisik = (float)str_replace(str_split(','), '.', $req->oktober_fisik);
        $nov_fisik = (float)str_replace(str_split(','), '.', $req->november_fisik);
        $des_fisik = (float)str_replace(str_split(','), '.', $req->desember_fisik);
        $fisik = $jan_fisik + $feb_fisik + $mar_fisik + $apr_fisik + $mei_fisik + $jun_fisik + $jul_fisik + $agu_fisik + $sep_fisik + $okt_fisik + $nov_fisik + $des_fisik;

        if ($keuangan != $uraian->dpa) {
            Session::flash('info', 'SISA DPA HARUS 0');

            $req->flash();
            return back();
        }
        if ((int)$req->total_persen != 100) {
            Session::flash('info', 'PERSEN FISIK harus 100');

            $req->flash();
            return back();
        }

        $u = $uraian;
        $u->p_januari_keuangan     = $jan_keuangan;
        $u->p_februari_keuangan    = $feb_keuangan;
        $u->p_maret_keuangan       = $mar_keuangan;
        $u->p_april_keuangan       = $apr_keuangan;
        $u->p_mei_keuangan         = $mei_keuangan;
        $u->p_juni_keuangan        = $jun_keuangan;
        $u->p_juli_keuangan        = $jul_keuangan;
        $u->p_agustus_keuangan     = $agu_keuangan;
        $u->p_september_keuangan   = $sep_keuangan;
        $u->p_oktober_keuangan     = $okt_keuangan;
        $u->p_november_keuangan    = $nov_keuangan;
        $u->p_desember_keuangan    = $des_keuangan;

        $u->p_januari_fisik     = $jan_fisik;
        $u->p_februari_fisik    = $feb_fisik;
        $u->p_maret_fisik       = $mar_fisik;
        $u->p_april_fisik       = $apr_fisik;
        $u->p_mei_fisik         = $mei_fisik;
        $u->p_juni_fisik        = $jun_fisik;
        $u->p_juli_fisik        = $jul_fisik;
        $u->p_agustus_fisik     = $agu_fisik;
        $u->p_september_fisik   = $sep_fisik;
        $u->p_oktober_fisik     = $okt_fisik;
        $u->p_november_fisik    = $nov_fisik;
        $u->p_desember_fisik    = $des_fisik;
        $u->save();

        Session::flash('success', 'Berhasil Di Simpan');
        return back();
    }

    public function realisasi()
    {
        //dd(auth::user()->pptk);
        if (Auth::user()->pptk->skpd->murni == 1) {
            $status = 'murni';
        }
        if (Auth::user()->pptk->skpd->pergeseran == 1) {
            $status = 'pergeseran';
        }
        if (Auth::user()->pptk->skpd->perubahan == 1) {
            $status = 'perubahan';
        }
        $data = Subkegiatan::where('pptk_id', Auth::user()->pptk->id)->get();
        return view('pptk.realisasi.index', compact('data', 'status'));
    }

    public function detailRealisasi($id)
    {
        if (Auth::user()->pptk->skpd->murni == 1) {
            $status = 'murni';
        }
        if (Auth::user()->pptk->skpd->pergeseran == 1) {
            $status = 'pergeseran';
        }
        if (Auth::user()->pptk->skpd->perubahan == 1) {
            $status = 'perubahan';
        }
        if ($status == 'pergeseran') {
            $uraian = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status)->where('ke', Auth::user()->pptk->skpd->ke)->values();
        } else {
            $uraian = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status);
        }

        if ($uraian->count() == 0) {
            Session::flash('warning', 'Tidak ada Data');
            request()->flash();
            return back();
        } else {

            $data = $uraian;

            $data->map(function ($item) {
                $item->jumlah_renc_keuangan = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
                $item->jumlah_real_keuangan = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan + $item->r_desember_keuangan;
                $item->jumlah_renc_fisik = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik + $item->p_desember_fisik;
                $item->jumlah_real_fisik = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik + $item->r_desember_fisik;
                return $item;
            });
            $subkegiatan = Subkegiatan::find($id);

            return view('pptk.realisasi.uraian', compact('data', 'subkegiatan', 'status'));
        }
    }

    public function updateRealisasiKeuangan(Request $req)
    {
        // $bulanIni = Carbon::now()->format('m');
        // if (nomorBulan(ucfirst($req->bulan)) > $bulanIni) {
        //     Session::flash('info', 'Tidak bisa input bulan ' . Carbon::now()->format('M') . ' atau setelahnya');
        //     return back();
        // } else {

        $data = Uraian::find($req->uraian_id);
        $persen = ($req->real_realisasi / $data->dpa) * 100;

        Uraian::find($req->uraian_id)->update([
            'r_' . $req->bulan . '_keuangan' => $req->real_realisasi,
            'r_' . $req->bulan . '_fisik' => $persen,
        ]);

        Session::flash('success', 'Berhasil Di Simpan');
        return back();
        // }
    }

    public function updateRealisasiFisik(Request $req)
    {
        // $bulanIni = Carbon::now()->format('m');
        // if (nomorBulan(ucfirst($req->bulan)) > $bulanIni) {
        //     Session::flash('info', 'Tidak bisa input bulan' . Carbon::now()->format('M') . '/ setelahnya');
        //     return back();
        // } else {

        $data = Uraian::find($req->uraian_id);
        $total = $data->r_januari_fisik +  $data->r_februari_fisik +  $data->r_maret_fisik +  $data->r_april_fisik +  $data->r_mei_fisik +  $data->r_juni_fisik +  $data->r_juli_fisik +  $data->r_agustus_fisik +  $data->r_september_fisik +  $data->r_oktober_fisik +  $data->r_november_fisik +  $data->r_desember_fisik;
        $hasil = $total + (int) $req->real_realisasi;
        $sisa = number_format(100 - $total, 2);
        if ($hasil > 100) {
            Session::flash('error', 'Total tidak bisa lebih dari 100%, anda hanya input maks ' . $sisa);
            return back();
        } else {
            Uraian::find($req->uraian_id)->update([
                'r_' . $req->bulan . '_fisik' => $req->real_realisasi,
            ]);

            Session::flash('success', 'Berhasil Di Simpan');
            return back();
        }
    }

    public function laporanrfk()
    {
        $data = Subkegiatan::where('pptk_id', Auth::user()->pptk->id)->get();
        return view('pptk.laporan.index', compact('data'));
    }
    public function detailLaporanRfk($id, $tahun, $bulan)
    {
        $nama_bulan = namaBulan($bulan);

        $data = Uraian::where('subkegiatan_id', $id)->get();

        $data->map(function ($item) {
            $item->jumlah_renc_keuangan = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
            $item->jumlah_real_keuangan = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan + $item->r_desember_keuangan;
            $item->jumlah_renc_fisik = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik + $item->p_desember_fisik;
            $item->jumlah_real_fisik = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik + $item->r_desember_fisik;
            return $item;
        });
        $subkegiatan = Subkegiatan::find($id);

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);

        $jenisrfk = BatasInput::where('is_aktif', 1)->first();

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        return view('pptk.laporan.rfk', compact('data', 'tahun', 'bulan', 'nama_bulan', 'subkegiatan', 'jenisrfk', 'status_kirim'));
    }

    public function input($id, $tahun, $bulan)
    {
        $nama_bulan = namaBulan($bulan);

        $status = jenisRFK($bulan, $tahun);


        // $data = Uraian::where('subkegiatan_id', $id)->where('jenis_rfk', $jenisrfk)->get();

        // if (Auth::user()->pptk->skpd->murni == 1) {
        //     $status = 'murni';
        // }
        // if (Auth::user()->pptk->skpd->pergeseran == 1) {
        //     $status = 'pergeseran';
        // }
        // if (Auth::user()->pptk->skpd->perubahan == 1) {
        //     $status = 'perubahan';
        // }
        if ($status == 'pergeseran') {
            $data = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status)->where('ke', Auth::user()->pptk->skpd->ke)->values();
        } else {
            $data = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status);
        }

        $jenisrfk = $status;

        $subkegiatan = Subkegiatan::find($id);

        $checkPptk = T_pptk::where('subkegiatan_id', $id)->where('tahun', $tahun)->where('bulan', $bulan)->first();
        if ($checkPptk == null) {
            $pptk = null;
        } else {
            $pptk = $checkPptk;
        }

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        //dd($pptk);
        return view('pptk.laporan.rfk_input', compact('data', 'tahun', 'bulan', 'nama_bulan', 'subkegiatan', 'pptk', 'jenisrfk', 'status_kirim'));
    }

    public function storeInput(Request $req)
    {
        if ($req->pptk_id == null) {
            T_pptk::create($req->all());
            Session::flash('success', 'Berhasil Di Simpan');
            return back();
        } else {
            T_pptk::find($req->pptk_id)->update($req->all());

            Session::flash('success', 'Berhasil Di Simpan');
            return back();
        }
    }
    public function fiskeu($id, $tahun, $bulan)
    {

        $nama_bulan = namaBulan($bulan);

        $status = jenisRFK($bulan, $tahun);



        // if (Auth::user()->pptk->skpd->murni == 1) {
        //     $status = 'murni';
        // }
        // if (Auth::user()->pptk->skpd->pergeseran == 1) {
        //     $status = 'pergeseran';
        // }
        // if (Auth::user()->pptk->skpd->perubahan == 1) {
        //     $status = 'perubahan';
        // }
        if ($status == 'pergeseran') {
            $data = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status)->where('ke', Auth::user()->pptk->skpd->ke)->values();
        } else {
            $data = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status);
        }

        $jenisrfk = $status;

        $totalDPA = $data->sum('dpa');

        $data->map(function ($item) use ($bulan, $totalDPA) {
            $item->persenDPA = ($item->dpa / $totalDPA) * 100;
            $item->r_januari_keuangan   = (int)$bulan >= 1 ? $item->r_januari_keuangan : 0;
            $item->r_februari_keuangan  = (int)$bulan >= 2 ? $item->r_februari_keuangan : 0;
            $item->r_maret_keuangan     = (int)$bulan >= 3 ? $item->r_maret_keuangan : 0;
            $item->r_april_keuangan     = (int)$bulan >= 4 ? $item->r_april_keuangan : 0;
            $item->r_mei_keuangan       = (int)$bulan >= 5 ? $item->r_mei_keuangan : 0;
            $item->r_juni_keuangan      = (int)$bulan >= 6 ? $item->r_juni_keuangan : 0;
            $item->r_juli_keuangan      = (int)$bulan >= 7 ? $item->r_juli_keuangan : 0;
            $item->r_agustus_keuangan   = (int)$bulan >= 8 ? $item->r_agustus_keuangan : 0;
            $item->r_september_keuangan = (int)$bulan >= 9 ? $item->r_september_keuangan : 0;
            $item->r_oktober_keuangan   = (int)$bulan >= 10 ? $item->r_oktober_keuangan : 0;
            $item->r_november_keuangan  = (int)$bulan >= 11 ? $item->r_november_keuangan : 0;
            $item->r_desember_keuangan  = (int)$bulan >= 12 ? $item->r_desember_keuangan : 0;

            $item->k_januari        = $item->p_januari_fisik * $item->persenDPA / 100;
            $item->k_februari       = $item->p_februari_fisik * $item->persenDPA / 100;
            $item->k_maret          = $item->p_maret_fisik * $item->persenDPA / 100;
            $item->k_april          = $item->p_april_fisik * $item->persenDPA / 100;
            $item->k_mei            = $item->p_mei_fisik * $item->persenDPA / 100;
            $item->k_juni           = $item->p_juni_fisik * $item->persenDPA / 100;
            $item->k_juli           = $item->p_juli_fisik * $item->persenDPA / 100;
            $item->k_agustus        = $item->p_agustus_fisik * $item->persenDPA / 100;
            $item->k_september      = $item->p_september_fisik * $item->persenDPA / 100;
            $item->k_oktober        = $item->p_oktober_fisik * $item->persenDPA / 100;
            $item->k_november       = $item->p_november_fisik * $item->persenDPA / 100;
            $item->k_desember       = $item->p_desember_fisik * $item->persenDPA / 100;
            $item->k_jumlah         = $item->k_januari + $item->k_februari + $item->k_maret + $item->k_april + $item->k_mei + $item->k_juni + $item->k_juli + $item->k_agustus + $item->k_september + $item->k_oktober + $item->k_november + $item->k_desember;
            $item->jumlah_renc_keuangan = $item->p_januari_keuangan + $item->p_februari_keuangan + $item->p_maret_keuangan + $item->p_april_keuangan + $item->p_mei_keuangan + $item->p_juni_keuangan + $item->p_juli_keuangan + $item->p_agustus_keuangan + $item->p_september_keuangan + $item->p_oktober_keuangan + $item->p_november_keuangan + $item->p_desember_keuangan;
            $item->jumlah_real_keuangan = $item->r_januari_keuangan + $item->r_februari_keuangan + $item->r_maret_keuangan + $item->r_april_keuangan + $item->r_mei_keuangan + $item->r_juni_keuangan + $item->r_juli_keuangan + $item->r_agustus_keuangan + $item->r_september_keuangan + $item->r_oktober_keuangan + $item->r_november_keuangan + $item->r_desember_keuangan;
            $item->jumlah_renc_fisik = $item->p_januari_fisik + $item->p_februari_fisik + $item->p_maret_fisik + $item->p_april_fisik + $item->p_mei_fisik + $item->p_juni_fisik + $item->p_juli_fisik + $item->p_agustus_fisik + $item->p_september_fisik + $item->p_oktober_fisik + $item->p_november_fisik + $item->p_desember_fisik;
            $item->jumlah_real_fisik = $item->r_januari_fisik + $item->r_februari_fisik + $item->r_maret_fisik + $item->r_april_fisik + $item->r_mei_fisik + $item->r_juni_fisik + $item->r_juli_fisik + $item->r_agustus_fisik + $item->r_september_fisik + $item->r_oktober_fisik + $item->r_november_fisik + $item->r_desember_fisik;
            return $item;
        });

        $subkegiatan = Subkegiatan::find($id);

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        return view('pptk.laporan.rfk_fiskeu', compact('data', 'tahun', 'bulan', 'nama_bulan', 'subkegiatan', 'jenisrfk', 'status_kirim'));
    }

    public function m($id, $tahun, $bulan)
    {
        $nama_bulan = namaBulan($bulan);
        $subkegiatan = Subkegiatan::find($id);
        $jenisrfk = jenisRFK($bulan, $tahun);

        $m = T_m::where('subkegiatan_id', $id)->where('tahun', $tahun)->where('bulan', $bulan)->get();

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        return view('pptk.laporan.rfk_m', compact('tahun', 'bulan', 'nama_bulan', 'subkegiatan', 'jenisrfk', 'm', 'status_kirim'));
    }

    public function rfk($id, $tahun, $bulan)
    {
        try {
            $nama_bulan = namaBulan($bulan);
            $subkegiatan = Subkegiatan::find($id);

            $status = jenisRFK($bulan, $tahun);

            // $data = Uraian::where('subkegiatan_id', $id)->where('jenis_rfk', $jenisrfk)->get();
            // if (Auth::user()->pptk->skpd->murni == 1) {
            //     $status = 'murni';
            // }
            // if (Auth::user()->pptk->skpd->pergeseran == 1) {
            //     $status = 'pergeseran';
            // }
            // if (Auth::user()->pptk->skpd->perubahan == 1) {
            //     $status = 'perubahan';
            // }
            if ($status == 'pergeseran') {
                $data = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status)->where('ke', Auth::user()->pptk->skpd->ke)->values();
            } else {
                $data = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status);
            }
            $jenisrfk = $status;
            $totalDPA = $data->sum('dpa');

            $data->map(function ($item) use ($totalDPA, $bulan) {

                if ($item->dpa == 0) {
                    $item->persenDPA = 0;
                    $item->rencanaRP = 0;
                    $item->rencanaKUM = 0;
                    $item->rencanaTTB = 0;
                    $item->realisasiRP = 0;
                    $item->realisasiKUM = 0;
                    $item->realisasiTTB = 0;
                    $item->deviasiKUM = 0;
                    $item->deviasiTTB = 0;
                    $item->sisaAnggaran = 0;
                    $item->capaianKeuangan = 0;

                    $item->fisikRencanaKUM = 0;
                    $item->fisikRencanaTTB = 0;
                    $item->fisikRealisasiKUM = 0;
                    $item->fisikRealisasiTTB = 0;
                    $item->fisikDeviasiKUM = 0;
                    $item->fisikDeviasiTTB = 0;
                    $item->capaianFisik = 0;
                } else {
                    $item->persenDPA = ($item->dpa / $totalDPA) * 100;
                    $item->rencanaRP = totalRencana($bulan, $item);
                    $item->rencanaKUM = ($item->rencanaRP / $item->dpa) * 100;
                    $item->rencanaTTB = ($item->persenDPA * $item->rencanaKUM) / 100;
                    $item->realisasiRP = totalRealisasi($bulan, $item);
                    //dd($item->realisasiRP, $item->dpa, $bulan, $item);
                    $item->realisasiKUM = ($item->realisasiRP / $item->dpa) * 100;
                    $item->realisasiTTB = ($item->persenDPA * $item->realisasiKUM) / 100;
                    $item->deviasiKUM =  $item->realisasiKUM - $item->rencanaKUM;
                    $item->deviasiTTB = $item->realisasiTTB - $item->rencanaTTB;
                    $item->sisaAnggaran = $item->dpa - $item->realisasiRP;
                    if ($item->rencanaRP == 0) {
                        $item->capaianKeuangan = 0;
                    } else {
                        $item->capaianKeuangan =  ($item->realisasiRP / $item->rencanaRP) * 100;
                    }

                    $item->fisikRencanaKUM = fisikRencana($bulan, $item);
                    $item->fisikRencanaTTB = $item->fisikRencanaKUM * $item->persenDPA / 100;
                    //dd($item->fisikRencanaTTB);
                    $item->fisikRealisasiKUM = fisikRealisasi($bulan, $item);
                    $item->fisikRealisasiTTB = $item->fisikRealisasiKUM * $item->persenDPA / 100;
                    $item->fisikDeviasiKUM =  $item->fisikRealisasiKUM - $item->fisikRencanaKUM;
                    $item->fisikDeviasiTTB =  $item->fisikRealisasiTTB - $item->fisikRencanaTTB;

                    if ($item->fisikRencanaKUM == 0) {
                        $item->capaianFisik = 0;
                    } else {
                        $item->capaianFisik =  ($item->fisikRealisasiKUM / $item->fisikRencanaKUM) * 100;
                    }
                }
                return $item;
            });

            //dd($data);
        } catch (\Exception $e) {

            Session::flash('error', 'Division By Zero');
            return back();
        }

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        return view('pptk.laporan.rfk_rfk', compact('data', 'tahun', 'bulan', 'nama_bulan', 'subkegiatan', 'jenisrfk', 'status_kirim'));
    }
    public function srp($id, $tahun, $bulan)
    {
        $nama_bulan = namaBulan($bulan);

        $subkegiatan = Subkegiatan::find($id);


        $status = jenisRFK($bulan, $tahun);
        // if (Auth::user()->pptk->skpd->murni == 1) {
        //     $status = 'murni';
        // }
        // if (Auth::user()->pptk->skpd->pergeseran == 1) {
        //     $status = 'pergeseran';
        // }
        // if (Auth::user()->pptk->skpd->perubahan == 1) {
        //     $status = 'perubahan';
        // }
        if ($status == 'pergeseran') {
            $data = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status)->where('ke', Auth::user()->pptk->skpd->ke)->values();
        } else {
            $data = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status);
        }
        $jenisrfk = $status;
        $totalDPA = $data->sum('dpa');

        $data->map(function ($item) use ($totalDPA, $bulan) {
            if ($item->dpa == 0) {
                $item->persenDPA = 0;
                $item->rencanaRP = 0;
                $item->rencanaKUM = 0;
                $item->rencanaTTB = 0;
                $item->realisasiRP = 0;
                $item->realisasiKUM = 0;
                $item->realisasiTTB = 0;
                $item->deviasiKUM = 0;
                $item->deviasiTTB = 0;
                $item->sisaAnggaran = 0;
                $item->capaianKeuangan = 0;

                $item->fisikRencanaKUM = 0;
                $item->fisikRencanaTTB = 0;
                $item->fisikRealisasiKUM = 0;
                $item->fisikRealisasiTTB = 0;
                $item->fisikDeviasiKUM = 0;
                $item->fisikDeviasiTTB = 0;
                $item->capaianFisik = 0;
            } else {
                $item->persenDPA = ($item->dpa / $totalDPA) * 100;
                $item->rencanaRP = totalRencana($bulan, $item);
                $item->rencanaKUM = ($item->rencanaRP / $item->dpa) * 100;
                $item->rencanaTTB = ($item->persenDPA * $item->rencanaKUM) / 100;
                $item->realisasiRP = totalRealisasi($bulan, $item);
                $item->realisasiKUM = ($item->realisasiRP / $item->dpa) * 100;
                $item->realisasiTTB = ($item->persenDPA * $item->realisasiKUM) / 100;
                if ($item->rencanaRP == 0) {
                    $item->capaianKeuangan = 0;
                } else {
                    $item->capaianKeuangan =  ($item->realisasiRP / $item->rencanaRP) * 100;
                }
                $item->deviasiKUM =  $item->realisasiKUM - $item->rencanaKUM;
                $item->deviasiTTB = $item->realisasiTTB - $item->rencanaTTB;
                $item->sisaAnggaran = $item->dpa - $item->realisasiRP;

                $item->fisikRencanaKUM = fisikRencana($bulan, $item);
                $item->fisikRencanaTTB = $item->fisikRencanaKUM * $item->persenDPA / 100;
                $item->fisikRealisasiKUM = fisikRealisasi($bulan, $item);
                $item->fisikRealisasiTTB = $item->fisikRealisasiKUM * $item->persenDPA / 100;
                if ($item->fisikRencanaKUM == 0) {
                    $item->capaianFisik = 0;
                } else {
                    $item->capaianFisik =  ($item->fisikRealisasiKUM / $item->fisikRencanaKUM) * 100;
                }
                $item->fisikDeviasiKUM =  $item->fisikRealisasiKUM - $item->fisikRencanaKUM;
                $item->fisikDeviasiTTB =  $item->fisikRealisasiTTB - $item->fisikRencanaTTB;
            }
            return $item;
        });

        $field_kirim = 'kirim_rfk_' . strtolower($nama_bulan);
        $status_kirim = $subkegiatan[$field_kirim];
        return view('pptk.laporan.rfk_srp', compact('data', 'tahun', 'bulan', 'nama_bulan', 'subkegiatan', 'jenisrfk', 'status_kirim'));
    }

    public function excel($id, $tahun, $bulan)
    {
        $nama_bulan = namaBulan($bulan);

        $subkegiatan = Subkegiatan::find($id);
        $masalah = T_m::where('subkegiatan_id', $id)->where('bulan', $bulan)->where('tahun', $tahun)->get();

        // $jenisrfk = BatasInput::where('is_aktif', 1)->first()->nama;

        // $datainput = Uraian::where('subkegiatan_id', $id)->where('jenis_rfk', $jenisrfk)->get();

        $status = jenisRFK($bulan, $tahun);
        // if (Auth::user()->pptk->skpd->murni == 1) {
        //     $status = 'murni';
        // }
        // if (Auth::user()->pptk->skpd->pergeseran == 1) {
        //     $status = 'pergeseran';
        // }
        // if (Auth::user()->pptk->skpd->perubahan == 1) {
        //     $status = 'perubahan';
        // }
        if ($status == 'pergeseran') {
            $datainput = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status)->where('ke', Auth::user()->pptk->skpd->ke)->values();
        } else {
            $datainput = Subkegiatan::find($id)->uraian->where('jenis_rfk', $status);
        }
        $jenisrfk = $status;

        //dd($datainput);

        $biodata = T_pptk::where('tahun', $tahun)->where('bulan', $bulan)->where('subkegiatan_id', $id)->first();
        //dd($biodata);
        if ($biodata == null) {
            Session::flash('error', 'Data Di Menu Input kosong');
            return back();
        }

        $replace = str_replace([" ", ","], "_", substr($subkegiatan->nama, 0, 50));

        $filename = 'RFK_' . $replace . '.xlsx';
        //dd($filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');

        if ($bulan == '01') {
            $path = public_path('/excel/januari.xlsx');
        }
        if ($bulan == '02') {
            $path = public_path('/excel/februari.xlsx');
        }
        if ($bulan == '03') {
            $path = public_path('/excel/maret.xlsx');
        }
        if ($bulan == '04') {
            $path = public_path('/excel/april.xlsx');
        }
        if ($bulan == '05') {
            $path = public_path('/excel/mei.xlsx');
        }
        if ($bulan == '06') {
            $path = public_path('/excel/juni.xlsx');
        }
        if ($bulan == '07') {
            $path = public_path('/excel/juli.xlsx');
        }
        if ($bulan == '08') {
            $path = public_path('/excel/agustus.xlsx');
        }
        if ($bulan == '09') {
            $path = public_path('/excel/september.xlsx');
        }
        if ($bulan == '10') {
            $path = public_path('/excel/oktober.xlsx');
        }
        if ($bulan == '11') {
            $path = public_path('/excel/november.xlsx');
        }
        if ($bulan == '12') {
            $path = public_path('/excel/desember.xlsx');
        }
        //dd($path);
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($path);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H1', Auth::user()->pptk->skpd->nama);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H2', $subkegiatan->kegiatan->program->nama);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H3', $subkegiatan->kegiatan->nama);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H4', $subkegiatan->nama);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H5', $biodata->nama_kabid);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H6', 'NIP. ' . $biodata->nip_kabid);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H7', $biodata->nama_pptk);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H8', 'NIP. ' . $biodata->nip_pptk);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H9', $subkegiatan->kegiatan->program->bidang == null ? '' : $subkegiatan->kegiatan->program->bidang->nama);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H12', $biodata->pelaporan_bulan);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H13', $biodata->pelaporan_tanggal);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H16', $biodata->kondisi_bulan);
        $spreadsheet->getSheetByName('INPUT')->setCellValue('H17', $biodata->kondisi_tanggal);
        $contentRow = 3;
        $lastRow = 27;
        foreach ($datainput as $key => $item) {
            $spreadsheet->getSheetByName('INPUT')->setCellValue('B' . $contentRow, $item->kode_rekening);
            $spreadsheet->getSheetByName('INPUT')->setCellValue('C' . $contentRow, $item->nama);
            $spreadsheet->getSheetByName('INPUT')->setCellValue('D' . $contentRow, $item->dpa);
            $contentRow++;
        }
        //dd('s');
        $totalHapus = $lastRow - $contentRow - $datainput->count();

        $mulaiHapus = $contentRow;
        //total di hapus
        for ($x = 0; $x < $totalHapus; $x++) {
            $spreadsheet->getSheetByName('INPUT')->setCellValue('B' . $mulaiHapus, '');
            $spreadsheet->getSheetByName('INPUT')->setCellValue('C' . $mulaiHapus, '');
            $spreadsheet->getSheetByName('INPUT')->setCellValue('D' . $mulaiHapus, '');
            $mulaiHapus++;
        }

        //insert masalah
        $rowMasalah = 11;
        foreach ($masalah as $key => $item) {
            $spreadsheet->getSheetByName('M')->setCellValue('A' . $rowMasalah, $key + 1);
            $spreadsheet->getSheetByName('M')->setCellValue('B' . $rowMasalah, $item->deskripsi);
            $spreadsheet->getSheetByName('M')->setCellValue('D' . $rowMasalah, $item->permasalahan);
            $spreadsheet->getSheetByName('M')->setCellValue('E' . $rowMasalah, $item->upaya);
            $spreadsheet->getSheetByName('M')->setCellValue('F' . $rowMasalah, $item->pihak_pembantu);
            $rowMasalah++;
        }

        //insert fiskeu

        $spreadsheet->getSheetByName('FISKEU')->setCellValue('F3', ': ' . Auth::user()->pptk->skpd->nama);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('F4', ': ' . $subkegiatan->kegiatan->program->nama);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('F5', ': ' . $subkegiatan->kegiatan->nama);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('F6', ': ' . $nama_bulan);

        $rencanaKeuanganRow = 11;
        $realisasiKeuanganRow = 12;
        $rencanaFisikRow = 13;
        $realisasiFisikRow = 14;
        $sumKuning = 15;

        $sumJ = '=J11';
        $sumK = '=K11';
        $sumL = '=L11';
        $sumM = '=M11';
        $sumN = '=N11';
        $sumO = '=O11';
        $sumP = '=P11';
        $sumQ = '=Q11';
        $sumR = '=R11';
        $sumS = '=S11';
        $sumT = '=T11';
        $sumU = '=U11';
        $sumV = '=V11';


        $sumJfisik = '=J15';
        $sumKfisik = '=K15';
        $sumLfisik = '=L15';
        $sumMfisik = '=M15';
        $sumNfisik = '=N15';
        $sumOfisik = '=O15';
        $sumPfisik = '=P15';
        $sumQfisik = '=Q15';
        $sumRfisik = '=R15';
        $sumSfisik = '=S15';
        $sumTfisik = '=T15';
        $sumUfisik = '=U15';
        // //dd('d');
        $count = $datainput->count();

        foreach ($datainput as $key => $item) {
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $rencanaKeuanganRow, $item->p_januari_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $rencanaKeuanganRow, $item->p_februari_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $rencanaKeuanganRow, $item->p_maret_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $rencanaKeuanganRow, $item->p_april_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $rencanaKeuanganRow, $item->p_mei_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $rencanaKeuanganRow, $item->p_juni_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $rencanaKeuanganRow, $item->p_juli_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $rencanaKeuanganRow, $item->p_agustus_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $rencanaKeuanganRow, $item->p_september_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $rencanaKeuanganRow, $item->p_oktober_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $rencanaKeuanganRow, $item->p_november_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $rencanaKeuanganRow, $item->p_desember_keuangan);

            $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $realisasiKeuanganRow, $item->r_januari_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $realisasiKeuanganRow, $item->r_februari_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $realisasiKeuanganRow, $item->r_maret_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $realisasiKeuanganRow, $item->r_april_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $realisasiKeuanganRow, $item->r_mei_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $realisasiKeuanganRow, $item->r_juni_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $realisasiKeuanganRow, $item->r_juli_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $realisasiKeuanganRow, $item->r_agustus_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $realisasiKeuanganRow, $item->r_september_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $realisasiKeuanganRow, $item->r_oktober_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $realisasiKeuanganRow, $item->r_november_keuangan);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $realisasiKeuanganRow, $item->r_desember_keuangan);

            $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $rencanaFisikRow, $item->p_januari_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $rencanaFisikRow, $item->p_februari_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $rencanaFisikRow, $item->p_maret_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $rencanaFisikRow, $item->p_april_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $rencanaFisikRow, $item->p_mei_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $rencanaFisikRow, $item->p_juni_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $rencanaFisikRow, $item->p_juli_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $rencanaFisikRow, $item->p_agustus_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $rencanaFisikRow, $item->p_september_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $rencanaFisikRow, $item->p_oktober_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $rencanaFisikRow, $item->p_november_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $rencanaFisikRow, $item->p_desember_fisik / 100);

            $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $realisasiFisikRow, $item->r_januari_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $realisasiFisikRow, $item->r_februari_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $realisasiFisikRow, $item->r_maret_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $realisasiFisikRow, $item->r_april_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $realisasiFisikRow, $item->r_mei_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $realisasiFisikRow, $item->r_juni_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $realisasiFisikRow, $item->r_juli_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $realisasiFisikRow, $item->r_agustus_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $realisasiFisikRow, $item->r_september_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $realisasiFisikRow, $item->r_oktober_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $realisasiFisikRow, $item->r_november_fisik / 100);
            $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $realisasiFisikRow, $item->r_desember_fisik / 100);

            $rencanaKeuanganRow += 6;
            $realisasiKeuanganRow += 6;
            $rencanaFisikRow += 6;
            $realisasiFisikRow += 6;
            $sumKuning += 6;

            if ($key == ($count - 1)) {
            } else {
                $sumJ = $sumJ . '+J' . $rencanaKeuanganRow;
                $sumK = $sumK . '+K' . $rencanaKeuanganRow;
                $sumL = $sumL . '+L' . $rencanaKeuanganRow;
                $sumM = $sumM . '+M' . $rencanaKeuanganRow;
                $sumN = $sumN . '+N' . $rencanaKeuanganRow;
                $sumO = $sumO . '+O' . $rencanaKeuanganRow;
                $sumP = $sumP . '+P' . $rencanaKeuanganRow;
                $sumQ = $sumQ . '+Q' . $rencanaKeuanganRow;
                $sumR = $sumR . '+R' . $rencanaKeuanganRow;
                $sumS = $sumS . '+S' . $rencanaKeuanganRow;
                $sumT = $sumT . '+T' . $rencanaKeuanganRow;
                $sumU = $sumU . '+U' . $rencanaKeuanganRow;
                $sumV = $sumV . '+V' . $rencanaKeuanganRow;

                $sumJfisik = $sumJfisik . '+J' . $sumKuning;
                $sumKfisik = $sumKfisik . '+K' . $sumKuning;
                $sumLfisik = $sumLfisik . '+L' . $sumKuning;
                $sumMfisik = $sumMfisik . '+M' . $sumKuning;
                $sumNfisik = $sumNfisik . '+N' . $sumKuning;
                $sumOfisik = $sumOfisik . '+O' . $sumKuning;
                $sumPfisik = $sumPfisik . '+P' . $sumKuning;
                $sumQfisik = $sumQfisik . '+Q' . $sumKuning;
                $sumRfisik = $sumRfisik . '+R' . $sumKuning;
                $sumSfisik = $sumSfisik . '+S' . $sumKuning;
                $sumTfisik = $sumTfisik . '+T' . $sumKuning;
                $sumUfisik = $sumUfisik . '+U' . $sumKuning;
            }

            $totalRencanaKeuanganBulanRow = $rencanaKeuanganRow + 1;
            $totalRencanaFisikBulanRow = $rencanaKeuanganRow + 2;
        }

        $mulaiHapusDariBaris = $rencanaKeuanganRow - 1;
        $jumlahDihapus = 448 - $mulaiHapusDariBaris;

        // //remove row
        // //$countRemove = 77;
        $spreadsheet->getSheetByName('FISKEU')->removeRow($mulaiHapusDariBaris, $jumlahDihapus);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $totalRencanaKeuanganBulanRow, $sumJ);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $totalRencanaKeuanganBulanRow, $sumK);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $totalRencanaKeuanganBulanRow, $sumL);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $totalRencanaKeuanganBulanRow, $sumM);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $totalRencanaKeuanganBulanRow, $sumN);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $totalRencanaKeuanganBulanRow, $sumO);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $totalRencanaKeuanganBulanRow, $sumP);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $totalRencanaKeuanganBulanRow, $sumQ);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $totalRencanaKeuanganBulanRow, $sumR);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $totalRencanaKeuanganBulanRow, $sumS);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $totalRencanaKeuanganBulanRow, $sumT);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $totalRencanaKeuanganBulanRow, $sumU);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('V' . $totalRencanaKeuanganBulanRow, $sumV);

        $spreadsheet->getSheetByName('FISKEU')->setCellValue('J' . $totalRencanaFisikBulanRow, $sumJfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('K' . $totalRencanaFisikBulanRow, $sumKfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('L' . $totalRencanaFisikBulanRow, $sumLfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('M' . $totalRencanaFisikBulanRow, $sumMfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('N' . $totalRencanaFisikBulanRow, $sumNfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('O' . $totalRencanaFisikBulanRow, $sumOfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('P' . $totalRencanaFisikBulanRow, $sumPfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('Q' . $totalRencanaFisikBulanRow, $sumQfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('R' . $totalRencanaFisikBulanRow, $sumRfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('S' . $totalRencanaFisikBulanRow, $sumSfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('T' . $totalRencanaFisikBulanRow, $sumTfisik);
        $spreadsheet->getSheetByName('FISKEU')->setCellValue('U' . $totalRencanaFisikBulanRow, $sumUfisik);

        $rfkMulaiKosong = $datainput->count() + 13;
        $jumlah_D = $datainput->count() + 13 + 1;
        $jmlrfkdihapus = 85 - $rfkMulaiKosong;
        for ($x = 13; $x < 85; $x++) {
            $spreadsheet->getSheetByName('RFK')->setCellValue('E' . $x, '=D' . $x . '/$D$' . $jumlah_D . '*100');
        }
        // for ($x = $rfkMulaiKosong; $x < 85; $x++) {
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('B' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('C' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('D' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('E' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('F' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('G' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('H' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('I' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('J' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('K' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('L' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('M' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('N' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('O' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('P' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('Q' . $x, '');
        //     $spreadsheet->getSheetByName('RFK')->setCellValue('R' . $x, '');
        //}

        $jmlrfkdihapus = 85 - $rfkMulaiKosong;
        $spreadsheet->getSheetByName('RFK')->removeRow($rfkMulaiKosong, $jmlrfkdihapus);

        $spreadsheet->getSheetByName('SPENGANTAR')->setCellValue('A3', strtoupper(Auth::user()->pptk->skpd->nama));
        $spreadsheet->getSheetByName('SPENGANTAR')->setCellValue('F9', 'Kepala ' . ucfirst(strtolower(Auth::user()->pptk->skpd->nama)));
        $spreadsheet->getSheetByName('SPENGANTAR')->setCellValue('C8', $biodata->no_surat);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function m_tambah($id, $tahun, $bulan)
    {
        return view('pptk.laporan.m.create', compact('id', 'bulan', 'tahun'));
    }
    public function m_store(Request $req, $id, $tahun, $bulan)
    {
        $subkegiatan = Subkegiatan::find($id);

        $param = $req->all();
        $param['tahun'] = $subkegiatan->tahun;
        $param['bulan'] = $bulan;
        $param['program_id'] = $subkegiatan->program_id;
        $param['kegiatan_id'] = $subkegiatan->kegiatan_id;
        $param['subkegiatan_id'] = $subkegiatan->id;
        $param['skpd_id'] = $subkegiatan->skpd_id;

        T_m::create($param);
        Session::flash('success', 'Berhasil Di Simpan');
        return redirect('/pptk/laporanrfk/' . $id . '/' . $tahun . '/' . $bulan . '/m');
        //return back();
    }
    public function edit_m($id)
    {
        $data = T_m::find($id);

        return view('pptk.laporan.m.edit', compact('data'));
    }

    public function update_m(Request $req, $id)
    {
        T_m::find($id)->update($req->all());
        $data = T_m::find($id);
        //dd($data);

        Session::flash('success', 'Berhasil Di update');
        return back();
    }
    public function delete_m($id)
    {
        T_m::find($id)->delete();
        Session::flash('success', 'Berhasil Di hapus');
        return back();
    }

    public function kirimAngkas2($id)
    {
        Subkegiatan::find($id)->update(['kirim_angkas' => 1]);
        Session::flash('success', 'Berhasil Dikirim');
        return back();
    }
    public function kirimData($bulan, $subkegiatan_id)
    {
        if (Subkegiatan::find($subkegiatan_id)->masalah->count() == 0) {
            Session::flash('info', 'Harap Isi Kolom Masalah (M)');
            return back();
        } else {
            $tahun = Subkegiatan::find($subkegiatan_id)->tahun;
            $biodata = T_pptk::where('tahun', $tahun)->where('bulan', $bulan)->where('subkegiatan_id', $subkegiatan_id)->first();
            //dd($biodata);
            // if ($biodata == null) {
            //     Session::flash('error', 'Data Di menu Input kosong');
            //     return back();
            // }

            $field = 'kirim_rfk_' . strtolower(namaBulan($bulan));
            Subkegiatan::find($subkegiatan_id)->update([
                $field => 1,
            ]);
            Session::flash('success', 'berhasil Di Kirim Ke Admin SKPD');
            return back();
        }
    }
}
