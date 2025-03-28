@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    
  <div class="row">
    <form method="get" action="/bpkpad/fisik/tampilkan">
    @csrf
      <div class="col-xs-4">
        <select class="form-control" name="skpd_id">
          <option value="">Konsolidasi</option>
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

            @if ($fisik != null)
            <tr>
                <td style="width: 10%">5.1 Belanja Operasi</td>
                <td>{{number_format($fisik['Belanja Operasi']['p_januari'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_januari'])}}</td>
                @if ($fisik['Belanja Operasi']['p_januari'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_januari'] / $fisik['Belanja Operasi']['p_januari']) * 100,2)}}</td>
                @endif
  
                <td>{{number_format($fisik['Belanja Operasi']['p_februari'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_februari'])}}</td>
                @if ($fisik['Belanja Operasi']['p_februari'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_februari'] / $fisik['Belanja Operasi']['p_februari']) * 100,2)}}</td>
                @endif
  
                <td>{{number_format($fisik['Belanja Operasi']['p_maret'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_maret'])}}</td>
                @if ($fisik['Belanja Operasi']['p_maret'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_maret'] / $fisik['Belanja Operasi']['p_maret']) * 100,2)}}</td>
                @endif
                
                <td>{{number_format($fisik['Belanja Operasi']['p_april'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_april'])}}</td>
                @if ($fisik['Belanja Operasi']['p_april'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_april'] / $fisik['Belanja Operasi']['p_april']) * 100,2)}}</td>
                @endif
  
                <td>{{number_format($fisik['Belanja Operasi']['p_mei'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_mei'])}}</td>
                @if ($fisik['Belanja Operasi']['p_mei'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_mei'] / $fisik['Belanja Operasi']['p_mei']) * 100,2)}}</td>
                @endif
  
                <td>{{number_format($fisik['Belanja Operasi']['p_juni'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_juni'])}}</td>
                @if ($fisik['Belanja Operasi']['p_juni'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_juni'] / $fisik['Belanja Operasi']['p_juni']) * 100,2)}}</td>
                @endif
  
                <td>{{number_format($fisik['Belanja Operasi']['p_juli'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_juli'])}}</td>
                @if ($fisik['Belanja Operasi']['p_juli'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_juli'] / $fisik['Belanja Operasi']['p_juli']) * 100,2)}}</td>
                @endif
  
                <td>{{number_format($fisik['Belanja Operasi']['p_agustus'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_agustus'])}}</td>
                @if ($fisik['Belanja Operasi']['p_agustus'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_agustus'] / $fisik['Belanja Operasi']['p_agustus']) * 100,2)}}</td>
                @endif
  
                <td>{{number_format($fisik['Belanja Operasi']['p_september'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_september'])}}</td>
                @if ($fisik['Belanja Operasi']['p_september'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_september'] / $fisik['Belanja Operasi']['p_september']) * 100,2)}}</td>
                @endif
  
                <td>{{number_format($fisik['Belanja Operasi']['p_oktober'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_oktober'])}}</td>
                @if ($fisik['Belanja Operasi']['p_oktober'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_oktober'] / $fisik['Belanja Operasi']['p_oktober']) * 100,2)}}</td>
                @endif
  
                <td>{{number_format($fisik['Belanja Operasi']['p_november'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_november'])}}</td>
                @if ($fisik['Belanja Operasi']['p_november'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_november'] / $fisik['Belanja Operasi']['p_november']) * 100,2)}}</td>
                @endif
  
                <td>{{number_format($fisik['Belanja Operasi']['p_desember'])}}</td>
                <td>{{number_format($fisik['Belanja Operasi']['r_desember'])}}</td>
                @if ($fisik['Belanja Operasi']['p_desember'] == 0)
                    <td>0</td>
                @else
                <td>{{number_format(($fisik['Belanja Operasi']['r_desember'] / $fisik['Belanja Operasi']['p_desember']) * 100,2)}}</td>
                @endif
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
