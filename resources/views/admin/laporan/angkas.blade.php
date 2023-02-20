@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row">
  </div>
  <div class="row">
    <div class="col-xs-12">
      <a href="/admin/laporan/{{$data->tahun}}" class="btn bg-gray btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a><br/><br/>
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-clipboard"></i> Deskripsi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body text-sm">
            <dl>
            <dd><strong>TAHUN :</strong> {{$data->tahun}}</dd>
            <dd><strong>PROGRAM :</strong> {{$data->kegiatan->program->nama}}</dd>
            <dd><strong>KEGIATAN :</strong> {{$data->kegiatan->nama}}</dd>
            <dd><strong>SUBKEGIATAN :</strong> {{$data->nama}}</dd>
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
      <div class="box-header">
        <h3 class="box-title ">Uraian</h3>
      </div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-condensed">
          <tbody>
          <tr style="font-size:12px;" class="bg-purple">
            <th style="width: 10px">#</th>
            <th>Uraian</th>
            <th>DPA</th>
            <th>RFK</th>
            <th>Jan</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Apr</th>
            <th>Mei</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Augt</th>
            <th>Sept</th>
            <th>Okt</th>
            <th>Nov</th>
            <th>Des</th>
            <th>Jumlah</th>
          </tr>
          @foreach ($uraian as $key => $item)
              
          <tr style="font-size:10px;">
            <td style="width: 10px">{{$key + 1}}</td>
            <td width="200px">{{$item->nama}}</td>
            <td>{{number_format($item->dpa)}}</td>
            <td>
            Renc.Keuangan <br/>
            Renc.Fisik <br/>
            </td>
            <td style="text-align: right;">
              {{number_format($item->p_januari_keuangan)}} <br/>
              {{round($item->p_januari_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_februari_keuangan)}} <br/>
              {{round($item->p_februari_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_maret_keuangan)}} <br/>
              {{round($item->p_maret_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_april_keuangan)}} <br/>
              {{round($item->p_april_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_mei_keuangan)}} <br/>
              {{round($item->p_mei_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_juni_keuangan)}} <br/>
              {{round($item->p_juni_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_juli_keuangan)}} <br/>
              {{round($item->p_juli_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_agustus_keuangan)}} <br/>
              {{round($item->p_agustus_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_september_keuangan)}} <br/>
              {{round($item->p_september_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_oktober_keuangan)}} <br/>
              {{round($item->p_oktober_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_november_keuangan)}} <br/>
              {{round($item->p_november_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->p_desember_keuangan)}} <br/>
              {{round($item->p_desember_fisik,2)}}% <br/>
            </td>
            <td style="text-align: right">
              {{number_format($item->jumlah_renc_keuangan)}} <br/>
              {{round($item->jumlah_renc_fisik,2)}}%
            </td>
          </tr>
          @endforeach
          <tr style="font-size: 10px">
            <td></td>
            <td>Total Rencana Keuangan</td>
            <td>{{number_format($uraian->sum('dpa'))}}</td>
            <td></td>
            <td style="text-align: right">{{number_format($uraian->sum('p_januari_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_februari_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_maret_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_april_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_mei_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_juni_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_juli_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_agustus_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_september_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_oktober_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_november_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('p_desember_keuangan'))}}</td>
            <td style="text-align: right">{{number_format($uraian->sum('jumlah_renc_keuangan'))}}</td>
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
