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
    
              {{-- <div class="box-tools">
                <a href="/bidang/program/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus-circle"></i> Tambah Program</a>
              </div> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body text-sm">
                <dl>
                <dd><strong>TAHUN :</strong> {{$tahun}}</dd>
                <dd><strong>BULAN :</strong> {{$nama_bulan}}</dd>
                <dd><strong>PROGRAM :</strong> {{$program->nama}}</dd>
                <dd><strong>KEGIATAN :</strong> {{$kegiatan->nama}}</dd>
                <dd><strong>SUB KEGIATAN :</strong> {{$subkegiatan->nama}}</dd>
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
            @include('bidang.laporan.rfk_menu')
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
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
              @foreach ($data as $key => $item)
                  
              <tr style="font-size:10px;">
                <td style="width: 10px">{{$key + 1}}</td>
                <td width="200px">{{$item->nama}}</td>
                <td>{{number_format($item->dpa)}}</td>
                <td>
                Renc.Keuangan <br/>
                Real Keuangan <br/>
                Renc.Fisik <br/>
                Real Fisik  
                </td>
                <td style="text-align: right;">
                  {{number_format($item->p_januari_keuangan)}} <br/>
                  {{number_format($item->r_januari_keuangan)}}<br/>
                  {{$item->p_januari_fisik}}% <br/>
                  {{$item->r_januari_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_februari_keuangan)}} <br/>
                  {{number_format($item->r_februari_keuangan)}}<br/>
                  {{$item->p_februari_fisik}}% <br/>
                  {{$item->r_februari_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_maret_keuangan)}} <br/>
                  {{number_format($item->r_maret_keuangan)}}<br/>
                  {{$item->p_maret_fisik}}% <br/>
                  {{$item->r_maret_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_april_keuangan)}} <br/>
                  {{number_format($item->r_april_keuangan)}}<br/>
                  {{$item->p_april_fisik}}% <br/>
                  {{$item->r_april_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_mei_keuangan)}} <br/>
                  {{number_format($item->r_mei_keuangan)}} <br/>
                  {{$item->p_mei_fisik}}% <br/>
                  {{$item->r_mei_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_juni_keuangan)}} <br/>
                  {{number_format($item->r_juni_keuangan)}} <br/>
                  {{$item->p_juni_fisik}}% <br/>
                  {{$item->r_juni_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_juli_keuangan)}} <br/>
                  {{number_format($item->r_juli_keuangan)}} <br/>
                  {{$item->p_juli_fisik}}% <br/>
                  {{$item->r_juli_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_agustus_keuangan)}} <br/>
                  {{number_format($item->r_agustus_keuangan)}}<br/>
                  {{$item->p_agustus_fisik}}% <br/>
                  {{$item->r_agustus_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_september_keuangan)}} <br/>
                  {{number_format($item->r_september_keuangan)}} <br/>
                  {{$item->p_september_fisik}}% <br/>
                  {{$item->r_september_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_oktober_keuangan)}} <br/>
                  {{number_format($item->r_oktober_keuangan)}} <br/>
                  {{$item->p_oktober_fisik}}% <br/>
                  {{$item->r_oktober_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_november_keuangan)}} <br/>
                  {{number_format($item->r_november_keuangan)}} <br/>
                  {{$item->p_november_fisik}}% <br/>
                  {{$item->r_november_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_desember_keuangan)}} <br/>
                  {{number_format($item->r_desember_keuangan)}} <br/>
                  {{$item->p_desember_fisik}}% <br/>
                  {{$item->r_desember_fisik}}%
                </td>
                <td style="text-align: right">
                  {{number_format($item->jumlah_renc_keuangan)}} <br/>
                 {{number_format($item->jumlah_real_keuangan)}} <br/>
                  {{$item->jumlah_renc_fisik}}% <br/>
                  {{$item->jumlah_real_fisik}}%
                </td>
              </tr>
              <tr style="background-color: rgb(249, 243, 185); font-size:9px">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right">{{round($item->k_januari, 2)}}</td>
                <td style="text-align: right">{{round($item->k_februari, 2)}}</td>
                <td style="text-align: right">{{round($item->k_maret, 2)}}</td>
                <td style="text-align: right">{{round($item->k_april, 2)}}</td>
                <td style="text-align: right">{{round($item->k_mei, 2)}}</td>
                <td style="text-align: right">{{round($item->k_juni, 2)}}</td>
                <td style="text-align: right">{{round($item->k_juli, 2)}}</td>
                <td style="text-align: right">{{round($item->k_agustus, 2)}}</td>
                <td style="text-align: right">{{round($item->k_september, 2)}}</td>
                <td style="text-align: right">{{round($item->k_oktober, 2)}}</td>
                <td style="text-align: right">{{round($item->k_november, 2)}}</td>
                <td style="text-align: right">{{round($item->k_desember, 2)}}</td>
                <td style="text-align: right">{{round($item->k_jumlah, 2)}}</td>
              </tr>
              @endforeach
                <tr style="font-size: 10px; background-color:#e7e4e6">
                <td></td>
                <td>Total Rencana Keuangan</td>
                <td rowspan="2">{{number_format($data->sum('dpa'))}}</td>
                <td></td>
                <td style="text-align: right">{{number_format($data->sum('p_januari_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_februari_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_maret_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_april_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_mei_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_juni_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_juli_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_agustus_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_september_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_oktober_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_november_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_desember_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('jumlah_renc_keuangan'))}}</td>
              </tr>
              <tr style="font-size: 10px; background-color:#e7e4e6">
                <td></td>
                <td>Total Rencana Fisik</td>
                
                <td></td>
                <td style="text-align: right">{{number_format($data->sum('k_januari'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_februari'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_maret'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_april'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_mei'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_juni'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_juli'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_agustus'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_september'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_oktober'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_november'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_desember'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('k_jumlah'))}}</td>
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

