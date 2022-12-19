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
      <div class="col-md-6">
        <!-- Block buttons -->
        <div class="box">
          <div class="box-body">
            <table class="table table-bordered table-condensed">
              <tbody>
              <tr style="font-size:12px;" class="bg-purple">
                <th style="width: 10px">#</th>
                <th>Kode Rekening</th>
                <th>Uraian Kegiatan</th>
                <th>DPA</th>
              </tr>
              @foreach ($data as $key => $item)
                  
              <tr style="font-size:10px;">
                <td style="width: 10px">{{$key + 1}}</td>
                <td>{{$item->kode_rekening}}</td>
                <td>{{$item->nama}}</td>
                <td style="text-align: right">{{number_format($item->dpa)}}</td>
              </tr>
              @endforeach
              <tr style="font-size:10px;">
                <td></td>
                <td></td>
                <td>Jumlah</td>
                <td style="text-align: right">{{number_format($data->sum('dpa'))}}</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <!-- Block buttons -->
        <div class="box">
          <div class="box-body">
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">SKPD</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Program</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kegiatan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Sekre/Kabid</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">NIP Sekre/Kabid</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama PPTK</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">NIP PPTK</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Bidang</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Tanggal Pelaporan</label>
                  <div class="col-sm-9">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Bulan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Tanggal</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm">
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-3 control-label">Kondisi RFK</label>
                  <div class="col-sm-9">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Bulan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Tanggal</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>


@endsection
@push('js')

@endpush

