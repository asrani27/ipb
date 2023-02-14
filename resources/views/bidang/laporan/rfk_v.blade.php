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
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
          <form class="form-horizontal" method="post" action="/bidang/laporanrfk-rfk_v/tambah-v/{{$subkegiatan->id}}/{{$bulan}}" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control input-sm" name="file">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-block bg-purple btn-flat">Upload</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <table>
      <tr>
      @foreach ($v as $item)
      <td style="text-align: center">
        <img src="/storage/visual/{{$item->file}}" width="100px" height="100px"><br/>
        <a href="/bidang/laporanrfk-rfk_v/delete/{{$item->id}}" onclick="return confirm('Yakin Ingin Di Hapus?');"><i class="fa fa-close text-danger"></i></a>
      </td>
      @endforeach
      </tr>
    </table>
</section>


@endsection
@push('js')

@endpush

