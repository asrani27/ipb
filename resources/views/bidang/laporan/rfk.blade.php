@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i>Laporan RFK</h3>
    
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
</section>


@endsection
@push('js')

@endpush

