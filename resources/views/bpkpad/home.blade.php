@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="info-box bg-purple">
        <span class="info-box-icon"><i class="fa fa-user-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Selamat Datang Di Aplikasi RFK</span>
          <span class="info-box-number">Hi, {{Auth::user()->name}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
              <span class="progress-description">
                Di bawah ini adalah laporan per SKPD
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div>
  <div class="row">
    <form method="get" action="/bpkpad/tampilkan">
    @csrf
      <div class="col-xs-4">
        <select class="form-control" name="skpd_id" required>
          <option value="">-skpd-</option>
          @foreach ($skpd as $item)
          <option value="{{$item->id}}" {{old('skpd_id') == $item->id ?'selected':''}}>{{$item->nama}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-xs-2">
        <select class="form-control" name="tahun" required>
          <option value="">-tahun-</option>
          <option value="2024" {{old('tahun') == '2024' ?'selected':''}}>2024</option>
        </select>
      </div>
      <div class="col-xs-2">
        <button type="submit" class='btn btn-primary'>Tampilkan</button>
      </div>
    </form>
  </div>
  <br/>
  <div class="row">
    <div class="col-lg-12">
      <strong>LAPORAN REALISASI KEUANGAN</strong>
      <div class="box">
        <div class="box-body table-responsive">
          <table class="table table-bordered table-condensed" width="100%">
            <tr style="background-color: rgb(4, 114, 169);text-align:center;color:white">
              <td rowspan="2">Kode_Akun_laporan_keuangan</td>
              <td colspan="3">Januari</td>
              <td colspan="3">Februari</td>
              <td colspan="3">Maret</td>
              <td colspan="3">April</td>
              <td colspan="3">Mei</td>
              <td colspan="3">Juni</td>
              <td colspan="3">Juli</td>
              <td colspan="3">Agustus</td>
              <td colspan="3">September</td>
              <td colspan="3">Oktober</td>
              <td colspan="3">November</td>
              <td colspan="3">Desember</td>
            </tr>
            <tr style="background-color:orange; text-align:center;font-weight:bold">
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
            </tr>

            @if ($param != null)
                
            <tr>
              <td>5.1 Belanja Operasi</td>
              <td>{{number_format($param['Belanja Operasi']['p_januari'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_januari'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_januari'] / $param['Belanja Operasi']['p_januari']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_februari'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_februari'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_februari'] / $param['Belanja Operasi']['p_februari']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_maret'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_maret'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_maret'] / $param['Belanja Operasi']['p_maret']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_april'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_april'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_april'] / $param['Belanja Operasi']['p_april']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_mei'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_mei'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_mei'] / $param['Belanja Operasi']['p_mei']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_juni'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_juni'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_juni'] / $param['Belanja Operasi']['p_juni']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_juli'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_juli'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_juli'] / $param['Belanja Operasi']['p_juli']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_agustus'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_agustus'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_agustus'] / $param['Belanja Operasi']['p_agustus']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_september'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_september'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_september'] / $param['Belanja Operasi']['p_september']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_oktober'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_oktober'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_oktober'] / $param['Belanja Operasi']['p_oktober']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_november'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_november'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_november'] / $param['Belanja Operasi']['p_november']) * 100,2)}}</td>

              <td>{{number_format($param['Belanja Operasi']['p_desember'])}}</td>
              <td>{{number_format($param['Belanja Operasi']['r_desember'])}}</td>
              <td>{{number_format(($param['Belanja Operasi']['r_desember'] / $param['Belanja Operasi']['p_desember']) * 100,2)}}</td>
            </tr>

            <tr>
              <td style="width: 10%">5.2 Belanja Modal</td>
              <td>{{number_format($param['Belanja Modal']['p_januari'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_januari'])}}</td>
              @if ($param['Belanja Modal']['p_januari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_januari'] / $param['Belanja Modal']['p_januari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Modal']['p_februari'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_februari'])}}</td>
              @if ($param['Belanja Modal']['p_februari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_februari'] / $param['Belanja Modal']['p_februari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Modal']['p_maret'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_maret'])}}</td>
              @if ($param['Belanja Modal']['p_maret'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_maret'] / $param['Belanja Modal']['p_maret']) * 100,2)}}</td>
              @endif
              
              <td>{{number_format($param['Belanja Modal']['p_april'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_april'])}}</td>
              @if ($param['Belanja Modal']['p_april'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_april'] / $param['Belanja Modal']['p_april']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Modal']['p_mei'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_mei'])}}</td>
              @if ($param['Belanja Modal']['p_mei'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_mei'] / $param['Belanja Modal']['p_mei']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Modal']['p_juni'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_juni'])}}</td>
              @if ($param['Belanja Modal']['p_juni'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_juni'] / $param['Belanja Modal']['p_juni']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Modal']['p_juli'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_juli'])}}</td>
              @if ($param['Belanja Modal']['p_juli'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_juli'] / $param['Belanja Modal']['p_juli']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Modal']['p_agustus'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_agustus'])}}</td>
              @if ($param['Belanja Modal']['p_agustus'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_agustus'] / $param['Belanja Modal']['p_agustus']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Modal']['p_september'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_september'])}}</td>
              @if ($param['Belanja Modal']['p_september'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_september'] / $param['Belanja Modal']['p_september']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Modal']['p_oktober'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_oktober'])}}</td>
              @if ($param['Belanja Modal']['p_oktober'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_oktober'] / $param['Belanja Modal']['p_oktober']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Modal']['p_november'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_november'])}}</td>
              @if ($param['Belanja Modal']['p_november'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_november'] / $param['Belanja Modal']['p_november']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Modal']['p_desember'])}}</td>
              <td>{{number_format($param['Belanja Modal']['r_desember'])}}</td>
              @if ($param['Belanja Modal']['p_desember'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Modal']['r_desember'] / $param['Belanja Modal']['p_desember']) * 100,2)}}</td>
              @endif
            </tr>

            <tr>
              <td style="width: 10%">5.3 Belanja Tidak Terduga</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['p_januari'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_januari'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_januari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_januari'] / $param['Belanja Tidak Terduga']['p_januari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Tidak Terduga']['p_februari'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_februari'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_februari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_februari'] / $param['Belanja Tidak Terduga']['p_februari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Tidak Terduga']['p_maret'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_maret'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_maret'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_maret'] / $param['Belanja Tidak Terduga']['p_maret']) * 100,2)}}</td>
              @endif
              
              <td>{{number_format($param['Belanja Tidak Terduga']['p_april'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_april'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_april'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_april'] / $param['Belanja Tidak Terduga']['p_april']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Tidak Terduga']['p_mei'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_mei'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_mei'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_mei'] / $param['Belanja Tidak Terduga']['p_mei']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Tidak Terduga']['p_juni'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_juni'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_juni'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_juni'] / $param['Belanja Tidak Terduga']['p_juni']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Tidak Terduga']['p_juli'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_juli'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_juli'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_juli'] / $param['Belanja Tidak Terduga']['p_juli']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Tidak Terduga']['p_agustus'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_agustus'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_agustus'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_agustus'] / $param['Belanja Tidak Terduga']['p_agustus']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Tidak Terduga']['p_september'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_september'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_september'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_september'] / $param['Belanja Tidak Terduga']['p_september']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Tidak Terduga']['p_oktober'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_oktober'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_oktober'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_oktober'] / $param['Belanja Tidak Terduga']['p_oktober']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Tidak Terduga']['p_november'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_november'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_november'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_november'] / $param['Belanja Tidak Terduga']['p_november']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Tidak Terduga']['p_desember'])}}</td>
              <td>{{number_format($param['Belanja Tidak Terduga']['r_desember'])}}</td>
              @if ($param['Belanja Tidak Terduga']['p_desember'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Tidak Terduga']['r_desember'] / $param['Belanja Tidak Terduga']['p_desember']) * 100,2)}}</td>
              @endif
            </tr>

            <tr>
              <td style="width: 10%">5.4 Belanja Transfer</td>
              <td>{{number_format($param['Belanja Transfer']['p_januari'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_januari'])}}</td>
              @if ($param['Belanja Transfer']['p_januari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_januari'] / $param['Belanja Transfer']['p_januari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Transfer']['p_februari'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_februari'])}}</td>
              @if ($param['Belanja Transfer']['p_februari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_februari'] / $param['Belanja Transfer']['p_februari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Transfer']['p_maret'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_maret'])}}</td>
              @if ($param['Belanja Transfer']['p_maret'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_maret'] / $param['Belanja Transfer']['p_maret']) * 100,2)}}</td>
              @endif
              
              <td>{{number_format($param['Belanja Transfer']['p_april'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_april'])}}</td>
              @if ($param['Belanja Transfer']['p_april'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_april'] / $param['Belanja Transfer']['p_april']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Transfer']['p_mei'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_mei'])}}</td>
              @if ($param['Belanja Transfer']['p_mei'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_mei'] / $param['Belanja Transfer']['p_mei']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Transfer']['p_juni'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_juni'])}}</td>
              @if ($param['Belanja Transfer']['p_juni'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_juni'] / $param['Belanja Transfer']['p_juni']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Transfer']['p_juli'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_juli'])}}</td>
              @if ($param['Belanja Transfer']['p_juli'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_juli'] / $param['Belanja Transfer']['p_juli']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Transfer']['p_agustus'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_agustus'])}}</td>
              @if ($param['Belanja Transfer']['p_agustus'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_agustus'] / $param['Belanja Transfer']['p_agustus']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Transfer']['p_september'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_september'])}}</td>
              @if ($param['Belanja Transfer']['p_september'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_september'] / $param['Belanja Transfer']['p_september']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Transfer']['p_oktober'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_oktober'])}}</td>
              @if ($param['Belanja Transfer']['p_oktober'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_oktober'] / $param['Belanja Transfer']['p_oktober']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Transfer']['p_november'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_november'])}}</td>
              @if ($param['Belanja Transfer']['p_november'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_november'] / $param['Belanja Transfer']['p_november']) * 100,2)}}</td>
              @endif

              <td>{{number_format($param['Belanja Transfer']['p_desember'])}}</td>
              <td>{{number_format($param['Belanja Transfer']['r_desember'])}}</td>
              @if ($param['Belanja Transfer']['p_desember'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($param['Belanja Transfer']['r_desember'] / $param['Belanja Transfer']['p_desember']) * 100,2)}}</td>
              @endif
            </tr>
            
            @endif

          </table>
        </div>

      </div>

      <strong>LAPORAN REALISASI FISIK</strong>
      <div class="box">
        <div class="box-body table-responsive">
          <table class="table table-bordered table-condensed" width="100%">
            <tr style="background-color: rgb(4, 114, 169);text-align:center;color:white">
              <td rowspan="2">Kode_Akun_laporan_fisik__</td>
              <td colspan="3">Januari</td>
              <td colspan="3">Februari</td>
              <td colspan="3">Maret</td>
              <td colspan="3">April</td>
              <td colspan="3">Mei</td>
              <td colspan="3">Juni</td>
              <td colspan="3">Juli</td>
              <td colspan="3">Agustus</td>
              <td colspan="3">September</td>
              <td colspan="3">Oktober</td>
              <td colspan="3">November</td>
              <td colspan="3">Desember</td>
            </tr>
            <tr style="background-color:orange; text-align:center;font-weight:bold">
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
              <td>Rencana</td>
              <td>Realisasi</td>
              <td>%</td>
            </tr>

            @if ($param != null)
            <tr>
              <td>5.1 Belanja Operasi</td>
              <td>{{number_format($fisik['Belanja Operasi']['p_januari'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_januari'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_januari'] / $fisik['Belanja Operasi']['p_januari']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_februari'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_februari'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_februari'] / $fisik['Belanja Operasi']['p_februari']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_maret'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_maret'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_maret'] / $fisik['Belanja Operasi']['p_maret']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_april'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_april'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_april'] / $fisik['Belanja Operasi']['p_april']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_mei'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_mei'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_mei'] / $fisik['Belanja Operasi']['p_mei']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_juni'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_juni'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_juni'] / $fisik['Belanja Operasi']['p_juni']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_juli'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_juli'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_juli'] / $fisik['Belanja Operasi']['p_juli']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_agustus'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_agustus'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_agustus'] / $fisik['Belanja Operasi']['p_agustus']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_september'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_september'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_september'] / $fisik['Belanja Operasi']['p_september']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_oktober'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_oktober'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_oktober'] / $fisik['Belanja Operasi']['p_oktober']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_november'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_november'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_november'] / $fisik['Belanja Operasi']['p_november']) * 100,2)}}</td>

              <td>{{number_format($fisik['Belanja Operasi']['p_desember'])}}</td>
              <td>{{number_format($fisik['Belanja Operasi']['r_desember'])}}</td>
              <td>{{number_format(($fisik['Belanja Operasi']['r_desember'] / $fisik['Belanja Operasi']['p_desember']) * 100,2)}}</td>
            </tr>

            <tr>
              <td style="width: 10%">5.2 Belanja Modal</td>
              <td>{{number_format($fisik['Belanja Modal']['p_januari'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_januari'])}}</td>
              @if ($fisik['Belanja Modal']['p_januari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_januari'] / $fisik['Belanja Modal']['p_januari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Modal']['p_februari'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_februari'])}}</td>
              @if ($fisik['Belanja Modal']['p_februari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_februari'] / $fisik['Belanja Modal']['p_februari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Modal']['p_maret'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_maret'])}}</td>
              @if ($fisik['Belanja Modal']['p_maret'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_maret'] / $fisik['Belanja Modal']['p_maret']) * 100,2)}}</td>
              @endif
              
              <td>{{number_format($fisik['Belanja Modal']['p_april'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_april'])}}</td>
              @if ($fisik['Belanja Modal']['p_april'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_april'] / $fisik['Belanja Modal']['p_april']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Modal']['p_mei'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_mei'])}}</td>
              @if ($fisik['Belanja Modal']['p_mei'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_mei'] / $fisik['Belanja Modal']['p_mei']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Modal']['p_juni'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_juni'])}}</td>
              @if ($fisik['Belanja Modal']['p_juni'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_juni'] / $fisik['Belanja Modal']['p_juni']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Modal']['p_juli'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_juli'])}}</td>
              @if ($fisik['Belanja Modal']['p_juli'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_juli'] / $fisik['Belanja Modal']['p_juli']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Modal']['p_agustus'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_agustus'])}}</td>
              @if ($fisik['Belanja Modal']['p_agustus'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_agustus'] / $fisik['Belanja Modal']['p_agustus']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Modal']['p_september'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_september'])}}</td>
              @if ($fisik['Belanja Modal']['p_september'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_september'] / $fisik['Belanja Modal']['p_september']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Modal']['p_oktober'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_oktober'])}}</td>
              @if ($fisik['Belanja Modal']['p_oktober'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_oktober'] / $fisik['Belanja Modal']['p_oktober']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Modal']['p_november'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_november'])}}</td>
              @if ($fisik['Belanja Modal']['p_november'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_november'] / $fisik['Belanja Modal']['p_november']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Modal']['p_desember'])}}</td>
              <td>{{number_format($fisik['Belanja Modal']['r_desember'])}}</td>
              @if ($fisik['Belanja Modal']['p_desember'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Modal']['r_desember'] / $fisik['Belanja Modal']['p_desember']) * 100,2)}}</td>
              @endif
            </tr>

            <tr>
              <td style="width: 10%">5.3 Belanja Tidak Terduga</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_januari'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_januari'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_januari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_januari'] / $fisik['Belanja Tidak Terduga']['p_januari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_februari'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_februari'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_februari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_februari'] / $fisik['Belanja Tidak Terduga']['p_februari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_maret'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_maret'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_maret'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_maret'] / $fisik['Belanja Tidak Terduga']['p_maret']) * 100,2)}}</td>
              @endif
              
              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_april'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_april'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_april'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_april'] / $fisik['Belanja Tidak Terduga']['p_april']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_mei'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_mei'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_mei'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_mei'] / $fisik['Belanja Tidak Terduga']['p_mei']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_juni'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_juni'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_juni'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_juni'] / $fisik['Belanja Tidak Terduga']['p_juni']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_juli'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_juli'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_juli'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_juli'] / $fisik['Belanja Tidak Terduga']['p_juli']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_agustus'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_agustus'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_agustus'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_agustus'] / $fisik['Belanja Tidak Terduga']['p_agustus']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_september'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_september'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_september'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_september'] / $fisik['Belanja Tidak Terduga']['p_september']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_oktober'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_oktober'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_oktober'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_oktober'] / $fisik['Belanja Tidak Terduga']['p_oktober']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_november'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_november'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_november'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_november'] / $fisik['Belanja Tidak Terduga']['p_november']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Tidak Terduga']['p_desember'])}}</td>
              <td>{{number_format($fisik['Belanja Tidak Terduga']['r_desember'])}}</td>
              @if ($fisik['Belanja Tidak Terduga']['p_desember'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Tidak Terduga']['r_desember'] / $fisik['Belanja Tidak Terduga']['p_desember']) * 100,2)}}</td>
              @endif
            </tr>

            <tr>
              <td style="width: 10%">5.4 Belanja Transfer</td>
              <td>{{number_format($fisik['Belanja Transfer']['p_januari'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_januari'])}}</td>
              @if ($fisik['Belanja Transfer']['p_januari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_januari'] / $fisik['Belanja Transfer']['p_januari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Transfer']['p_februari'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_februari'])}}</td>
              @if ($fisik['Belanja Transfer']['p_februari'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_februari'] / $fisik['Belanja Transfer']['p_februari']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Transfer']['p_maret'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_maret'])}}</td>
              @if ($fisik['Belanja Transfer']['p_maret'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_maret'] / $fisik['Belanja Transfer']['p_maret']) * 100,2)}}</td>
              @endif
              
              <td>{{number_format($fisik['Belanja Transfer']['p_april'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_april'])}}</td>
              @if ($fisik['Belanja Transfer']['p_april'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_april'] / $fisik['Belanja Transfer']['p_april']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Transfer']['p_mei'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_mei'])}}</td>
              @if ($fisik['Belanja Transfer']['p_mei'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_mei'] / $fisik['Belanja Transfer']['p_mei']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Transfer']['p_juni'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_juni'])}}</td>
              @if ($fisik['Belanja Transfer']['p_juni'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_juni'] / $fisik['Belanja Transfer']['p_juni']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Transfer']['p_juli'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_juli'])}}</td>
              @if ($fisik['Belanja Transfer']['p_juli'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_juli'] / $fisik['Belanja Transfer']['p_juli']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Transfer']['p_agustus'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_agustus'])}}</td>
              @if ($fisik['Belanja Transfer']['p_agustus'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_agustus'] / $fisik['Belanja Transfer']['p_agustus']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Transfer']['p_september'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_september'])}}</td>
              @if ($fisik['Belanja Transfer']['p_september'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_september'] / $fisik['Belanja Transfer']['p_september']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Transfer']['p_oktober'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_oktober'])}}</td>
              @if ($fisik['Belanja Transfer']['p_oktober'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_oktober'] / $fisik['Belanja Transfer']['p_oktober']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Transfer']['p_november'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_november'])}}</td>
              @if ($fisik['Belanja Transfer']['p_november'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_november'] / $fisik['Belanja Transfer']['p_november']) * 100,2)}}</td>
              @endif

              <td>{{number_format($fisik['Belanja Transfer']['p_desember'])}}</td>
              <td>{{number_format($fisik['Belanja Transfer']['r_desember'])}}</td>
              @if ($fisik['Belanja Transfer']['p_desember'] == 0)
                  <td>0</td>
              @else
              <td>{{number_format(($fisik['Belanja Transfer']['r_desember'] / $fisik['Belanja Transfer']['p_desember']) * 100,2)}}</td>
              @endif
            </tr>
            @endif

          </table>
        </div>

      </div>
    </div>
  </div>
  <br/>
  
  
</section>


@endsection
@push('js')

@endpush
