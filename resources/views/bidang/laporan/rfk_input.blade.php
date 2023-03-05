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
                <dd><strong>JENIS RFK :</strong> {{$jenisrfk}}</dd>
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
            <form class="form-horizontal" method="post" action="/bidang/laporanrfk/rfk_input">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">No. Surat</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="no_surat" value="{{$pptk == null ? null : $pptk->no_surat}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">SKPD</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control input-sm" name="skpd_id" value="{{Auth::user()->bidang->skpd->id}}" readonly>
                    <input type="hidden" class="form-control input-sm" name="program_id" value="{{$program->id}}" readonly>
                    <input type="hidden" class="form-control input-sm" name="kegiatan_id" value="{{$kegiatan->id}}" readonly>
                    <input type="hidden" class="form-control input-sm" name="tahun" value="{{$tahun}}" readonly>
                    <input type="hidden" class="form-control input-sm" name="bulan" value="{{$bulan}}" readonly>
                    <input type="hidden" class="form-control input-sm" name="subkegiatan_id" value="{{$subkegiatan->id}}" readonly>
                    <input type="hidden" class="form-control input-sm" name="pptk_id" value="{{$pptk == null ? null : $pptk->id}}" readonly>
                    <input type="text" class="form-control input-sm" value="{{Auth::user()->bidang->skpd->nama}}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Program</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" value="{{$program->nama}}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kegiatan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" value="{{$kegiatan->nama}}"  readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Sekre/Kabid</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="nama_kabid" value="{{$pptk == null ? null : $pptk->nama_kabid}}" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">NIP Sekre/Kabid</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="nip_kabid" value="{{$pptk == null ? null : $pptk->nip_kabid}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama PPTK</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="nama_pptk" value="{{$pptk == null ? null : $pptk->nama_pptk}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">NIP PPTK</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="nip_pptk" value="{{$pptk == null ? null : $pptk->nip_pptk}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Bidang</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" value="{{$pptk == null ? null : $pptk->program->bidang->nama}}" readonly>
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
                    <input type="text" class="form-control input-sm" name="pelaporan_bulan" value="{{$pptk == null ? null : $pptk->pelaporan_bulan}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Tanggal</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="pelaporan_tanggal" value="{{$pptk == null ? null : $pptk->pelaporan_tanggal}}">
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
                    <input type="text" class="form-control input-sm" name="kondisi_bulan" value="{{$pptk == null ? null : $pptk->kondisi_bulan}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Tanggal</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" name="kondisi_tanggal" value="{{$pptk == null ? null : $pptk->kondisi_tanggal}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label"></label>
                  <div class="col-sm-9">
                    <button type="submit" class='btn btn-primary btn-flat btn-block'>SIMPAN</button>
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

