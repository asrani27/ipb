<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TkrkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PPTK2Controller;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminKrkController;
use App\Http\Controllers\AdminPptkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PPTKMurniController;
use App\Http\Controllers\TarikDataController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AdminBagianController;
use App\Http\Controllers\AdminBidangController;
use App\Http\Controllers\BidangKirimController;
use App\Http\Controllers\BidangMurniController;
use App\Http\Controllers\TpermohonanController;
use App\Http\Controllers\AdminBerandaController;
use App\Http\Controllers\AdminCapaianController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\AdminPeriodeController;
use App\Http\Controllers\AdminProgramController;
use App\Http\Controllers\BidangAngkasController;
use App\Http\Controllers\BidangUraianController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\AdminKegiatanController;
use App\Http\Controllers\AdminValidasiController;
use App\Http\Controllers\BidangBerandaController;
use App\Http\Controllers\BidangProgramController;
use App\Http\Controllers\DaftarLayananController;
use App\Http\Controllers\AdminKelurahanController;
use App\Http\Controllers\AdminPengajuanController;
use App\Http\Controllers\BidangKegiatanController;
use App\Http\Controllers\SuperadminSkpdController;
use App\Http\Controllers\AdminBatasInputController;
use App\Http\Controllers\AdminPermohonanController;
use App\Http\Controllers\BidangPerubahanController;
use App\Http\Controllers\BidangRealisasiController;
use App\Http\Controllers\AdminSubKegiatanController;
use App\Http\Controllers\BidangLaporanRFKController;
use App\Http\Controllers\BidangPergeseranController;
use App\Http\Controllers\BidangSubkegiatanController;
use App\Http\Controllers\SuperadminBerandaController;
use App\Http\Controllers\SuperadminJenisrfkController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('lupa-password', [LupaPasswordController::class, 'index']);

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::prefix('superadmin')->group(function () {
        Route::get('beranda', [SuperadminBerandaController::class, 'index']);
        Route::get('pengaturan/batasinput', [SuperadminBerandaController::class, 'batasinput']);
        Route::get('jenisrfk', [SuperadminJenisrfkController::class, 'index']);
        Route::get('jenisrfk/add', [SuperadminJenisrfkController::class, 'create']);
        Route::post('jenisrfk/add', [SuperadminJenisrfkController::class, 'store']);
        Route::get('jenisrfk/edit/{id}', [SuperadminJenisrfkController::class, 'edit']);
        Route::post('jenisrfk/edit/{id}', [SuperadminJenisrfkController::class, 'update']);
        Route::get('jenisrfk/delete/{id}', [SuperadminJenisrfkController::class, 'delete']);
        Route::get('skpd', [SuperadminSkpdController::class, 'index']);
        Route::get('skpd/createakun/{id}', [SuperadminSkpdController::class, 'createakun']);
        Route::get('skpd/resetakun/{id}', [SuperadminSkpdController::class, 'resetakun']);
        Route::get('laporan', [SuperadminController::class, 'laporan']);
        Route::get('laporan/rfk', [SuperadminController::class, 'export']);
        Route::get('pengajuan', [PengajuanController::class, 'index']);
        Route::get('pengajuan/verifikasi/{id_skpd}/{id_pengajuan}', [PengajuanController::class, 'verifikasi']);
    });
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::prefix('admin')->group(function () {

        Route::get('datatarik/{tahun}', [TarikDataController::class, 'detail']);
        Route::get('datatarik', [TarikDataController::class, 'index']);
        Route::post('datatarik/bidang', [TarikDataController::class, 'updateBidang']);
        Route::get('datatarik/program/{tahun}', [TarikDataController::class, 'program']);
        Route::get('datatarik/kegiatan/{tahun}', [TarikDataController::class, 'kegiatan']);
        Route::get('datatarik/subkegiatan/{tahun}', [TarikDataController::class, 'subkegiatan']);
        Route::post('datatarik/pptk', [TarikDataController::class, 'updatePPTK']);
        Route::post('datatarik', [TarikDataController::class, 'tarikData']);
        Route::get('capaian', [AdminCapaianController::class, 'index']);
        Route::get('capaian/tarik-indikator', [AdminCapaianController::class, 'tarikIndikator']);
        Route::get('capaian/hapus-indikator', [AdminCapaianController::class, 'hapusIndikator']);
        Route::get('capaian/hitung-realisasi', [AdminCapaianController::class, 'hitungRealisasi']);
        Route::post('capaian/store', [AdminCapaianController::class, 'simpanCapaian']);
        Route::post('capaian/update', [AdminCapaianController::class, 'updateCapaian']);
        Route::post('capaian/program', [AdminCapaianController::class, 'capaianProgram']);
        Route::post('capaian/kegiatan', [AdminCapaianController::class, 'capaianKegiatan']);
        Route::post('capaian/subkegiatan', [AdminCapaianController::class, 'capaianSubkegiatan']);
        Route::get('laporan', [AdminLaporanController::class, 'index']);
        Route::get('laptriwulan', [AdminLaporanController::class, 'triwulan']);
        Route::post('laptriwulan', [AdminLaporanController::class, 'exporttriwulan']);
        Route::get('laporan/rencana/{tahun}', [AdminLaporanController::class, 'rencana']);
        Route::get('laporan/rencana/batal/{id}', [AdminLaporanController::class, 'rencanabatal']);
        Route::get('laporan/{tahun}', [AdminLaporanController::class, 'laporan']);
        Route::get('laporan/batal/{id}/{bulan}', [AdminLaporanController::class, 'batal']);
        Route::get('laporan/{tahun}/{bulan}', [AdminLaporanController::class, 'laporanRfk']);
        Route::get('laporan/{tahun}/{bulan}/excel', [AdminLaporanController::class, 'excel']);

        Route::get('subkegiatan/angkas/{id}', [AdminLaporanController::class, 'angkas']);

        Route::get('perioderfk', [AdminPeriodeController::class, 'index']);
        Route::get('perioderfk/add', [AdminPeriodeController::class, 'create']);
        Route::post('perioderfk/add', [AdminPeriodeController::class, 'store']);
        Route::get('perioderfk/edit/{id}', [AdminPeriodeController::class, 'edit']);
        Route::post('perioderfk/edit/{id}', [AdminPeriodeController::class, 'update']);
        Route::get('perioderfk/delete/{id}', [AdminPeriodeController::class, 'delete']);

        Route::get('batas_input', [AdminBatasInputController::class, 'index']);
        Route::get('batas_input/add', [AdminBatasInputController::class, 'create']);
        Route::post('batas_input/add', [AdminBatasInputController::class, 'store']);
        Route::get('batas_input/edit/{id}', [AdminBatasInputController::class, 'edit']);
        Route::post('batas_input/edit/{id}', [AdminBatasInputController::class, 'update']);
        Route::get('batas_input/delete/{id}', [AdminBatasInputController::class, 'delete']);

        Route::get('validasi', [AdminValidasiController::class, 'index']);

        Route::get('beranda', [AdminBerandaController::class, 'index']);
        Route::get('beranda/{tahun}', [AdminBerandaController::class, 'indexTahun']);

        Route::get('beranda/murni/buka', [AdminBerandaController::class, 'bukaMurni']);
        Route::get('beranda/murni/tutup', [AdminBerandaController::class, 'tutupMurni']);

        Route::get('beranda/pergeseran/buka', [AdminBerandaController::class, 'bukaPergeseran']);
        Route::get('beranda/pergeseran/tutup', [AdminBerandaController::class, 'tutupPergeseran']);

        Route::get('beranda/perubahan/buka', [AdminBerandaController::class, 'bukaPerubahan']);
        Route::get('beranda/perubahan/tutup', [AdminBerandaController::class, 'tutupPerubahan']);

        Route::get('beranda/realisasi/buka', [AdminBerandaController::class, 'bukaRealisasi']);
        Route::get('beranda/realisasi/tutup', [AdminBerandaController::class, 'tutupRealisasi']);

        Route::get('bidang', [AdminBidangController::class, 'index']);
        Route::get('bidang/add', [AdminBidangController::class, 'create']);
        Route::post('bidang/add', [AdminBidangController::class, 'store']);
        Route::get('bidang/edit/{id}', [AdminBidangController::class, 'edit']);
        Route::post('bidang/edit/{id}', [AdminBidangController::class, 'update']);
        Route::get('bidang/delete/{id}', [AdminBidangController::class, 'delete']);

        Route::get('pengajuan', [AdminPengajuanController::class, 'index']);
        Route::get('pengajuan/add', [AdminPengajuanController::class, 'create']);
        Route::post('pengajuan/add', [AdminPengajuanController::class, 'store']);
        Route::get('pengajuan/edit/{id}', [AdminPengajuanController::class, 'edit']);
        Route::post('pengajuan/edit/{id}', [AdminPengajuanController::class, 'update']);
        Route::get('pengajuan/delete/{id}', [AdminPengajuanController::class, 'delete']);

        Route::get('bagian', [AdminBagianController::class, 'index']);
        Route::get('bagian/add', [AdminBagianController::class, 'create']);
        Route::post('bagian/add', [AdminBagianController::class, 'store']);
        Route::get('bagian/edit/{id}', [AdminBagianController::class, 'edit']);
        Route::post('bagian/edit/{id}', [AdminBagianController::class, 'update']);
        Route::get('bagian/delete/{id}', [AdminBagianController::class, 'delete']);


        Route::get('kelurahan', [AdminKelurahanController::class, 'index']);
        Route::get('kelurahan/add', [AdminKelurahanController::class, 'create']);
        Route::post('kelurahan/add', [AdminKelurahanController::class, 'store']);
        Route::get('kelurahan/edit/{id}', [AdminKelurahanController::class, 'edit']);
        Route::post('kelurahan/edit/{id}', [AdminKelurahanController::class, 'update']);
        Route::get('kelurahan/delete/{id}', [AdminKelurahanController::class, 'delete']);

        Route::get('bidang/createuser/{id}', [AdminBidangController::class, 'createuser']);
        Route::post('bidang/createuser/{id}', [AdminBidangController::class, 'storeuser']);
        Route::get('bidang/resetpass/{id}', [AdminBidangController::class, 'resetpass']);

        Route::get('program', [AdminProgramController::class, 'index']);
        Route::get('program/add', [AdminProgramController::class, 'create']);
        Route::post('program/add', [AdminProgramController::class, 'store']);
        Route::get('program/edit/{id}', [AdminProgramController::class, 'edit']);
        Route::post('program/edit/{id}', [AdminProgramController::class, 'update']);
        Route::get('program/delete/{id}', [AdminProgramController::class, 'delete']);

        Route::get('kegiatan', [AdminKegiatanController::class, 'index']);
        Route::get('kegiatan/add', [AdminKegiatanController::class, 'create']);
        Route::post('kegiatan/add', [AdminKegiatanController::class, 'store']);
        Route::get('kegiatan/edit/{id}', [AdminKegiatanController::class, 'edit']);
        Route::post('kegiatan/edit/{id}', [AdminKegiatanController::class, 'update']);
        Route::get('kegiatan/delete/{id}', [AdminKegiatanController::class, 'delete']);

        Route::get('subkegiatan', [AdminSubKegiatanController::class, 'index']);
        Route::get('subkegiatan/add', [AdminSubKegiatanController::class, 'create']);
        Route::post('subkegiatan/add', [AdminSubKegiatanController::class, 'store']);
        Route::get('subkegiatan/edit/{id}', [AdminSubKegiatanController::class, 'edit']);
        Route::post('subkegiatan/edit/{id}', [AdminSubKegiatanController::class, 'update']);
        Route::get('subkegiatan/delete/{id}', [AdminSubKegiatanController::class, 'delete']);

        Route::get('pptk', [AdminPptkController::class, 'index']);
        Route::get('pptk/add', [AdminPptkController::class, 'create']);
        Route::post('pptk/add', [AdminPptkController::class, 'store']);
        Route::get('pptk/edit/{id}', [AdminPptkController::class, 'edit']);
        Route::post('pptk/edit/{id}', [AdminPptkController::class, 'update']);
        Route::get('pptk/delete/{id}', [AdminPptkController::class, 'delete']);
        Route::get('pptk/createuser/{id}', [AdminPptkController::class, 'createuser']);
        Route::post('pptk/createuser/{id}', [AdminPptkController::class, 'storeuser']);
        Route::get('pptk/resetpass/{id}', [AdminPptkController::class, 'resetpass']);
        Route::get('pptk/hapusakun/{id}', [AdminPptkController::class, 'hapusakun']);
    });
});

Route::group(['middleware' => ['auth', 'role:bidang']], function () {
    Route::prefix('bidang')->group(function () {

        Route::get('kirim_angkas/{id}', [BidangKirimController::class, 'kirimAngkas']);

        Route::get('beranda', [BidangBerandaController::class, 'index']);
        Route::get('beranda/uraian', [BidangBerandaController::class, 'uraian']);
        Route::get('beranda/sortir', [BidangBerandaController::class, 'sortir']);
        Route::get('beranda/uraian/angkas/{id}', [BidangBerandaController::class, 'angkas']);
        Route::get('beranda/realisasi/{id}', [BidangBerandaController::class, 'realisasi']);
        Route::get('beranda/tahun', [PencarianController::class, 'bTahun']);

        Route::get('detail/subkegiatan/{id}', [BidangSubkegiatanController::class, 'detailSubKegiatan']);

        //-------------------route pergeseran--------------------------//

        Route::get('murni/subkegiatan', [BidangMurniController::class, 'subkegiatan']);
        //-------------------------------------------------------------//
        //-------------------route pergeseran--------------------------//
        Route::get('pergeseran/program', [BidangPergeseranController::class, 'program']);
        Route::get('pergeseran/program/kegiatan/{program_id}', [BidangPergeseranController::class, 'kegiatan']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}', [BidangPergeseranController::class, 'subkegiatan']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/add', [BidangPergeseranController::class, 'createsubkegiatan']);
        Route::post('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/add', [BidangPergeseranController::class, 'storesubkegiatan']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/edit/{sub_id}', [BidangPergeseranController::class, 'editsubkegiatan']);
        Route::post('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/edit/{sub_id}', [BidangPergeseranController::class, 'updatesubkegiatan']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/delete/{sub_id}', [BidangPergeseranController::class, 'deletesubkegiatan']);

        Route::get('pergeseran/kirim_angkas/{id}', [BidangKirimController::class, 'kirimAngkas']);

        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}', [BidangPergeseranController::class, 'uraian']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangPergeseranController::class, 'createuraian']);
        Route::post('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangPergeseranController::class, 'storeuraian']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangPergeseranController::class, 'edituraian']);
        Route::post('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangPergeseranController::class, 'updateuraian']);
        Route::get('pergeseran/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/delete/{uraian_id}', [BidangPergeseranController::class, 'deleteuraian']);

        Route::get('pergeseran/program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangPergeseranController::class, 'createangkas']);
        Route::post('pergeseran/program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangPergeseranController::class, 'storeangkas']);
        //------------------------------------------------------------//

        //-------------------route perubahan--------------------------//
        Route::get('perubahan/program', [BidangPerubahanController::class, 'program']);
        Route::get('perubahan/program/kegiatan/{program_id}', [BidangPerubahanController::class, 'kegiatan']);
        Route::get('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}', [BidangPerubahanController::class, 'subKegiatan']);
        Route::get('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}', [BidangPerubahanController::class, 'uraian']);
        Route::get('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangPerubahanController::class, 'editUraian']);
        Route::post('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangPerubahanController::class, 'updateUraian']);
        Route::get('perubahan/program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangPerubahanController::class, 'editDPA']);
        Route::post('perubahan/program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangPerubahanController::class, 'updateDPA']);

        Route::get('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangPerubahanController::class, 'addUraian']);
        Route::post('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangPerubahanController::class, 'storeUraian']);
        Route::get('perubahan/program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/delete/{uraian_id}', [BidangPerubahanController::class, 'deleteUraian']);
        //------------------------------------------------------------//

        Route::get('program', [BidangProgramController::class, 'index']);
        Route::get('program/add', [BidangProgramController::class, 'create']);
        Route::post('program/add', [BidangProgramController::class, 'store']);
        Route::get('program/edit/{id}', [BidangProgramController::class, 'edit']);
        Route::post('program/edit/{id}', [BidangProgramController::class, 'update']);
        Route::get('program/delete/{id}', [BidangProgramController::class, 'delete']);

        Route::get('realisasi', [BidangRealisasiController::class, 'index']);
        Route::get('realisasi/caridata', [BidangRealisasiController::class, 'caridata']);
        Route::post('realisasi', [BidangRealisasiController::class, 'store']);
        Route::post('realisasifisik', [BidangRealisasiController::class, 'storeFisik']);
        Route::get('realisasi/{tahun}', [BidangRealisasiController::class, 'tahun']);
        Route::get('realisasi/{tahun}/{program_id}', [BidangRealisasiController::class, 'program']);
        Route::get('realisasi/{tahun}/{program_id}/{kegiatan_id}', [BidangRealisasiController::class, 'kegiatan']);
        Route::get('realisasi/{tahun}/{program_id}/{kegiatan_id}/{subkegiatan_id}', [BidangRealisasiController::class, 'subkegiatan']);

        Route::get('laporanrfk', [BidangLaporanRFKController::class, 'index']);
        Route::get('laporanrfk/kirimdata/{bulan}/{subkegiatan_id}', [BidangLaporanRFKController::class, 'kirimData']);
        Route::get('laporanrfk/{tahun}', [BidangLaporanRFKController::class, 'tahun']);
        Route::get('laporanrfk/{tahun}/{bulan}', [BidangLaporanRFKController::class, 'bulan']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}', [BidangLaporanRFKController::class, 'program']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}', [BidangLaporanRFKController::class, 'kegiatan']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}', [BidangLaporanRFKController::class, 'subkegiatan']);

        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/srp', [BidangLaporanRFKController::class, 'srp']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/rfk', [BidangLaporanRFKController::class, 'rfk']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/pbj', [BidangLaporanRFKController::class, 'pbj']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/st', [BidangLaporanRFKController::class, 'st']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/m', [BidangLaporanRFKController::class, 'm']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/v', [BidangLaporanRFKController::class, 'v']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/fiskeu', [BidangLaporanRFKController::class, 'fiskeu']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/input', [BidangLaporanRFKController::class, 'input']);
        Route::get('laporanrfk/{tahun}/{bulan}/{program_id}/{kegiatan_id}/{subkegiatan_id}/export', [BidangLaporanRFKController::class, 'excel']);

        Route::post('laporanrfk/rfk_input', [BidangLaporanRFKController::class, 'storeInput']);
        //Route::post('laporanrfk/rfk_st', [BidangLaporanRFKController::class, 'storeSt']);
        Route::get('laporanrfk-rfk_st/delete/{id}', [BidangLaporanRFKController::class, 'deleteSt']);
        Route::get('laporanrfk-rfk_st/edit/{id}', [BidangLaporanRFKController::class, 'editSt']);
        Route::post('laporanrfk-rfk_st/edit/{id}', [BidangLaporanRFKController::class, 'updateSt']);
        Route::get('laporanrfk-rfk_st/tambah-st/{id}/{bulan}', [BidangLaporanRFKController::class, 'tambahSt']);
        Route::post('laporanrfk-rfk_st/tambah-st/{id}/{bulan}', [BidangLaporanRFKController::class, 'storeSt']);

        Route::get('laporanrfk-rfk_m/delete/{id}', [BidangLaporanRFKController::class, 'deleteM']);
        Route::get('laporanrfk-rfk_m/edit/{id}', [BidangLaporanRFKController::class, 'editM']);
        Route::post('laporanrfk-rfk_m/edit/{id}', [BidangLaporanRFKController::class, 'updateM']);
        Route::get('laporanrfk-rfk_m/tambah-m/{id}/{bulan}', [BidangLaporanRFKController::class, 'tambahM']);
        Route::get('laporanrfk-rfk_m/sama-m/{id}/{bulan}/{tahun}', [BidangLaporanRFKController::class, 'samaM']);
        Route::post('laporanrfk-rfk_m/tambah-m/{id}/{bulan}', [BidangLaporanRFKController::class, 'storeM']);

        Route::get('laporanrfk-rfk_pbj/tambah-pbj/{id}/{bulan}', [BidangLaporanRFKController::class, 'tambahPbj']);
        Route::post('laporanrfk-rfk_pbj/tambah-pbj/{id}/{bulan}', [BidangLaporanRFKController::class, 'storePbj']);
        Route::get('laporanrfk-rfk_pbj/delete/{id}', [BidangLaporanRFKController::class, 'deletePbj']);
        Route::get('laporanrfk-rfk_pbj/edit/{id}', [BidangLaporanRFKController::class, 'editPbj']);
        Route::post('laporanrfk-rfk_pbj/edit/{id}', [BidangLaporanRFKController::class, 'updatePbj']);

        Route::get('laporanrfk-rfk_v/delete/{id}', [BidangLaporanRFKController::class, 'deleteV']);
        Route::post('laporanrfk-rfk_v/tambah-v/{id}/{bulan}', [BidangLaporanRFKController::class, 'storeV']);

        Route::get('program/kegiatan/{id}', [BidangKegiatanController::class, 'index']);
        Route::get('program/kegiatan/{id}/add', [BidangKegiatanController::class, 'create']);
        Route::post('program/kegiatan/{id}/add', [BidangKegiatanController::class, 'store']);
        Route::get('program/kegiatan/{program_id}/edit/{kegiatan_id}', [BidangKegiatanController::class, 'edit']);
        Route::post('program/kegiatan/{program_id}/edit/{kegiatan_id}', [BidangKegiatanController::class, 'update']);
        Route::get('program/kegiatan/{program_id}/delete/{kegiatan_id}', [BidangKegiatanController::class, 'delete']);

        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}', [BidangSubkegiatanController::class, 'index']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/add', [BidangSubkegiatanController::class, 'create']);
        Route::post('program/kegiatan/{program_id}/sub/{kegiatan_id}/add', [BidangSubkegiatanController::class, 'store']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/edit/{sub_id}', [BidangSubkegiatanController::class, 'edit']);
        Route::post('program/kegiatan/{program_id}/sub/{kegiatan_id}/edit/{sub_id}', [BidangSubkegiatanController::class, 'update']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/delete/{sub_id}', [BidangSubkegiatanController::class, 'delete']);

        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}', [BidangUraianController::class, 'index']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangUraianController::class, 'create']);
        Route::post('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/add', [BidangUraianController::class, 'store']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangUraianController::class, 'edit']);
        Route::post('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/edit/{uraian_id}', [BidangUraianController::class, 'update']);
        Route::get('program/kegiatan/{program_id}/sub/{kegiatan_id}/uraian/{subkegiatan_id}/delete/{uraian_id}', [BidangUraianController::class, 'delete']);

        Route::get('program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangAngkasController::class, 'create']);
        Route::post('program/angkas/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [BidangAngkasController::class, 'store']);

        Route::get('skpd/bidang/pptk', [PPTK2Controller::class, 'index']);
        Route::get('skpd/bidang/pptk/add', [PPTK2Controller::class, 'create']);
        Route::post('skpd/bidang/pptk/add', [PPTK2Controller::class, 'store']);
        Route::get('skpd/bidang/pptk/edit/{id}', [PPTK2Controller::class, 'edit']);
        Route::post('skpd/bidang/pptk/edit/{id}', [PPTK2Controller::class, 'update']);
        Route::get('skpd/bidang/pptk/delete/{id}', [PPTK2Controller::class, 'delete']);
        Route::get('skpd/bidang/pptk/createuser/{id}', [PPTK2Controller::class, 'createuser']);
        Route::post('skpd/bidang/pptk/createuser/{id}', [PPTK2Controller::class, 'storeuser']);
        Route::get('skpd/bidang/pptk/resetpass/{id}', [PPTK2Controller::class, 'resetpass']);

        Route::get('kirimdata', [BidangKirimController::class, 'index']);

        Route::get('murni/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [MurniController::class, 'create']);
        Route::post('murni/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [MurniController::class, 'store']);

        Route::get('pergeseran/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [PergeseranController::class, 'create']);
        Route::post('pergeseran/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [PergeseranController::class, 'store']);

        Route::get('realisasi/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [RealisasiController::class, 'create']);
        Route::post('realisasi/{program_id}/{kegiatan_id}/{subkegiatan_id}/{uraian_id}', [RealisasiController::class, 'store']);

        Route::get('excel/sp/{program_id}/{kegiatan_id}/{subkegiatan_id}', [ExcelController::class, 'suratpengantar']);
        Route::get('excel/rfk/{program_id}/{kegiatan_id}/{subkegiatan_id}', [ExcelController::class, 'rfk']);
        Route::get('excel/fiskeu/{program_id}/{kegiatan_id}/{subkegiatan_id}', [ExcelController::class, 'fiskeu']);
        Route::get('excel/input/{program_id}/{kegiatan_id}/{subkegiatan_id}', [ExcelController::class, 'input']);

        Route::get('skpd/bidang/riwayat/kegiatan', [RiwayatKegiatanController::class, 'index']);
        Route::get('skpd/bidang/riwayat/kegiatan/search', [RiwayatKegiatanController::class, 'tampilkan']);
    });
});

Route::group(['middleware' => ['auth', 'role:bidang|pptk']], function () {
    Route::get('pptk/beranda', [BerandaController::class, 'pptk']);
    Route::get('pptk/beranda/uraian', [BerandaController::class, 'uraian']);

    Route::get('pptk/laporanrfk/kirimdata/{bulan}/{subkegiatan_id}', [PPTK2Controller::class, 'kirimData']);
    Route::get('pptk/subkegiatan', [PPTK2Controller::class, 'subkegiatan']);
    Route::get('pptk/subkegiatan/kirim/{id}', [PPTK2Controller::class, 'kirimAngkas2']);
    Route::get('pptk/subkegiatan/uraian/{subkegiatan_id}', [PPTK2Controller::class, 'uraian']);
    Route::get('pptk/subkegiatan/uraian/{subkegiatan_id}/add', [PPTK2Controller::class, 'addUraian']);
    Route::post('pptk/subkegiatan/uraian/{subkegiatan_id}/add', [PPTK2Controller::class, 'storeUraian']);
    Route::get('pptk/edituraian/{id}', [PPTK2Controller::class, 'editUraian']);
    Route::post('pptk/edituraian/{id}', [PPTK2Controller::class, 'updateUraian']);
    Route::get('pptk/deleteuraian/{id}', [PPTK2Controller::class, 'deleteUraian']);
    Route::get('pptk/angkas/{id}', [PPTK2Controller::class, 'angkas']);
    Route::post('pptk/angkas/{id}', [PPTK2Controller::class, 'updateAngkas']);

    Route::get('pptk/realisasi', [PPTK2Controller::class, 'realisasi']);
    Route::post('pptk/realisasikeuangan', [PPTK2Controller::class, 'updateRealisasiKeuangan']);
    Route::post('pptk/realisasifisik', [PPTK2Controller::class, 'updateRealisasiFisik']);
    Route::get('pptk/realisasi/{id}', [PPTK2Controller::class, 'detailRealisasi']);
    Route::get('pptk/laporanrfk', [PPTK2Controller::class, 'laporanrfk']);
    Route::get('pptk/laporanrfk/{id}/{tahun}/{bulan}', [PPTK2Controller::class, 'detailLaporanRfk']);
    Route::get('pptk/laporanrfk/{id}/{tahun}/{bulan}/srp', [PPTK2Controller::class, 'srp']);
    Route::get('pptk/laporanrfk/{id}/{tahun}/{bulan}/rfk', [PPTK2Controller::class, 'rfk']);
    Route::get('pptk/laporanrfk/{id}/{tahun}/{bulan}/m', [PPTK2Controller::class, 'm']);
    Route::get('pptk/laporanrfk/{id}/{tahun}/{bulan}/m/add', [PPTK2Controller::class, 'm_tambah']);
    Route::post('pptk/laporanrfk/{id}/{tahun}/{bulan}/m/add', [PPTK2Controller::class, 'm_store']);
    Route::get('pptk/edit_m/{id}', [PPTK2Controller::class, 'edit_m']);
    Route::post('pptk/edit_m/{id}', [PPTK2Controller::class, 'update_m']);
    Route::get('pptk/delete_m/{id}', [PPTK2Controller::class, 'delete_m']);

    Route::get('pptk/laporanrfk/{id}/{tahun}/{bulan}/fiskeu', [PPTK2Controller::class, 'fiskeu']);
    Route::get('pptk/laporanrfk/{id}/{tahun}/{bulan}/input', [PPTK2Controller::class, 'input']);
    Route::get('pptk/laporanrfk/{id}/{tahun}/{bulan}/export', [PPTK2Controller::class, 'excel']);
    Route::post('/pptk/laporanrfk/rfk_input', [PPTK2Controller::class, 'storeInput']);
});

Route::group(['middleware' => ['auth', 'role:superadmin|admin|bidang|pptk']], function () {
    Route::get('/logout', [LogoutController::class, 'logout']);

    Route::get('gantipass', [GantiPassController::class, 'index']);
    Route::post('gantipass', [GantiPassController::class, 'update']);
});
