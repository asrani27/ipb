@extends('layouts.app')
@push('css')

@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-clipboard"></i> Laporan RFK</h3>


        </div>
        <!-- /.box-header -->
        <div class="box-body text-sm">
          <dl>
            <dd><strong>TAHUN :</strong> {{$tahun}}</dd>
            <dd><strong>BULAN :</strong> {{$nama_bulan}}</dd>
            <dd><strong>PROGRAM :</strong> {{$subkegiatan->kode_program()}} - {{$subkegiatan->nama_program()}}</dd>
            <dd><strong>KEGIATAN :</strong> {{$subkegiatan->kode_kegiatan()}} - {{$subkegiatan->nama_kegiatan()}}</dd>
            <dd><strong>SUBKEGIATAN :</strong> {{$subkegiatan->kode}} - {{$subkegiatan->nama}}</dd>
            <dd><strong>JENIS RFK :</strong> {{$jenisrfk}}</dd>
            <dd><strong>STATUS :</strong>
              @if ($status_kirim != null)

              <i class="fa fa-check-circle"></i> Terkirim
              @endif
            </dd>
          </dl>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <!-- Block buttons -->
      <div class="box">
        <div class="box-body">
          @include('pptk.laporan.rfk_menu')
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <!-- Block buttons -->
      <div class="box">
        <div class="box-body table-responsive text-center">
          <strong style="font-size: 16px;"><i class="fa fa-comment"></i> Jika terdapat warna merah di
            kolom Realisasi
            Fisik KUM, <br />harap
            naikkan persentase realisasi
            fisiknya di
            menu
            realisasi</strong>
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
                <th rowspan="2" style="text-align: center">Sisa Anggaran <br /> Rp</th>
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
              @foreach ($data as $key => $item)

              <tr style="font-size:10px;">
                <td style="width: 10px">{{$key + 1}}</td>
                <td width="200px" class="text-left">{{$item->nama}}<br />{{$item->keterangan}}</td>
                <td style="text-align: right">{{number_format($item->dpa)}}</td>
                <td style="text-align: right">{{round($item->persenDPA, 2)}}</td>
                <td style="text-align: right">{{number_format($item->rencanaRP)}}</td>
                <td style="text-align: right">{{round($item->rencanaKUM, 2)}}</td>
                <td style="text-align: right">{{round($item->rencanaTTB, 2)}}</td>
                <td style="text-align: right">{{number_format($item->realisasiRP)}}</td>
                <td style="text-align: right">{{round($item->realisasiKUM, 2)}}</td>
                <td style="text-align: right">{{round($item->realisasiTTB, 2)}}</td>
                <td style="text-align: right">{{round($item->capaianKeuangan, 2)}}</td>
                <td style="text-align: right">{{number_format($item->sisaAnggaran)}}</td>
                <td style="text-align: right">{{round($item->fisikRencanaKUM, 2)}}</td>
                <td style="text-align: right">{{round($item->fisikRencanaTTB, 2)}}</td>
                @if (round($item->fisikRealisasiKUM,2) < round($item->realisasiKUM,2))
                  <td style="text-align: right; background-color:#fad1d1">{{round($item->fisikRealisasiKUM, 2)}}</td>
                  @else
                  <td style="text-align: right; background-color:#d1fadd">{{round($item->fisikRealisasiKUM, 2)}}</td>
                  @endif

                  <td style="text-align: right">{{round($item->fisikRealisasiTTB, 2)}}</td>
                  <td style="text-align: right">{{round($item->capaianFisik, 2)}}</td>
              </tr>
              @endforeach
              <tr style="font-size:10px; background-color:#e7e4e6">
                <td></td>
                <td>JUMLAH</td>
                <td style="text-align: right">{{number_format($data->sum('dpa'))}}</td>
                <td style="text-align: right">{{$data->sum('persenDPA')}}</td>
                <td style="text-align: right">{{number_format($data->sum('rencanaRP'))}}</td>
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
                </td>
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