@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>{{$bidang}}</h3>

          <p>TOTAL BIDANG</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
            <h3>{{$program}}</h3>

          <p>TOTAL PROGRAM</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$subkegiatan}}</h3>

          <p>TOTAL SUB KEGIATAN</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>-</h3>

          <p>-</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>

  
  
  <div class="row">
    <div class="col-md-12">
      <!-- Block buttons -->
      <div class="box">
        <div class="box-body table-responsive">
          <table class="table table-bordered table-condensed">
            <tbody>
              <tr style="font-size:10px;" class="bg-purple">
                <th style="width: 10px" rowspan="3">#</th>
                <th rowspan="3" style="text-align: center">Uraian Kegiatan</th>
                <th colspan="2" style="text-align: center">DPA</th>
                <th colspan="8" style="text-align: center">Keuangan</th>
                <th colspan="5" style="text-align: center">Fisik</th>
              </tr>
              <tr style="font-size:10px;" class="bg-purple">
                <th rowspan="2" style="text-align: center">Rp</th>
                <th rowspan="2" style="text-align: center">%</th>
                <th colspan="3" style="text-align: center">Rencana</th>
                <th colspan="3" style="text-align: center">Realisasi</th>
                <th style="text-align: center">Capaian</th>
                <th rowspan="2" style="text-align: center">Sisa Anggaran <br/> Rp</th>
                <th colspan="2" style="text-align: center">Rencana</th>
                <th colspan="2" style="text-align: center">Realisasi</th>
                <th style="text-align: center">Capaian</th>
              </tr>
              <tr style="font-size:10px;" class="bg-purple">
              <th>Rp</th>
              <th>%KUM</th>
              <th>%TTB</th>
              <th>Rp</th>
              <th>%KUM</th>
              <th>%TTB</th>
              <th>%</th>
              <th>KUM</th>
              <th>TTB</th>
              <th>KUM</th>
              <th>TTB</th>
              <th></th>
              </tr>

              @php
              $keg = 1;
              $subkeg = 1;
              @endphp
              @foreach ($data as $key => $item)

              <tr style="font-size:10px;font-weight:bold;" class="bg-danger">
                <td style="width: 10px;"></td>
                <td width="400px">{{$item->nama}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>

                @foreach ($item->kegiatan as $item2)

                <tr style="font-size:10px;" class="bg-warning">
                  <td></td>
                  <td width="200px">{{$item2->nama}}</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                  @foreach ($datasubkegiatan->where('kegiatan_id', $item2->id) as $item3)
                  <tr style="font-size:10px;">
                    <td>{{$subkeg++}}</td>
                    <td width="200px">{{$item3->nama}}</td>
                    <td style="text-align: right;">{{number_format($item3->kolom3)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom4, 2)}}</td>
                    <td style="text-align: right;">{{number_format($item3->kolom5)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom6, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom7, 2)}}</td>
                    <td style="text-align: right;">{{number_format($item3->kolom8)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom9, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom10, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom11, 2)}}</td>
                    <td style="text-align: right;">{{number_format($item3->kolom12)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom13, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom14, 2)}}</td>
                  </tr>
                  @endforeach
                @endforeach
              @endforeach
              <tr style="font-size:10px; background-color:#e7e4e6">
                <td></td>
                <td>JUMLAH</td>
                <td style="text-align: right">{{number_format($datasubkegiatan->sum('kolom3'))}}</td>
                <td style="text-align: right">{{$datasubkegiatan->sum('kolom4')}}</td>
                
                {{-- <td style="text-align: right">{{number_format($data->sum('rencanaRP'))}}</td>
                <td></td>
                <td style="text-align: right">{{round($data->sum('rencanaTTB'), 2)}}</td>
                <td style="text-align: right">{{number_format($data->sum('realisasiRP'))}}</td>
                <td></td>
                <td style="text-align: right">{{round($data->sum('realisasiTTB'), 2)}}</td>
                <td style="text-align: right">
                  @if ($data->sum('realisasiTTB') == 0)
                      0
                  @else
                  {{round(($data->sum('realisasiTTB') / $data->sum('rencanaTTB')) * 100, 2)}}
                  @endif
                </td>
                <td style="text-align: right">{{number_format($data->sum('sisaAnggaran'))}}</td>
                <td></td>
                <td style="text-align: right">{{round($data->sum('fisikRencanaTTB'), 2)}}</td>
                <td></td>
                <td style="text-align: right">{{round($data->sum('fisikRealisasiTTB'), 2)}}</td>
                <td style="text-align: right">
                  @if ($data->sum('fisikRealisasiTTB') == 0)
                      0
                  @else
                  {{round(($data->sum('fisikRealisasiTTB') / $data->sum('fisikRencanaTTB')) * 100, 2)}}
                  @endif
                </td> --}}
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@push('js')

@endpush
