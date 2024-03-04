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
          <div class="box-header text-center">
            <h3 class="box-title ">Pilih Bulan</h3>
          </div>
          <div class="box-body">
            <a href="/bidang/laporanrfk/{{$tahun}}/01" class="btn btn-primary btn-block btn-sm btn-flat"><strong>Januari</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/02" class="btn btn-primary btn-block btn-sm btn-flat"><strong>Februari</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/03" class="btn btn-primary btn-block btn-sm btn-flat"><strong>Maret</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/04" class="btn btn-primary btn-block btn-sm btn-flat"><strong>April</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/05" class="btn btn-primary btn-block btn-sm btn-flat"><strong>Mei</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/06" class="btn btn-primary btn-block btn-sm btn-flat"><strong>Juni</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/07" class="btn btn-primary btn-block btn-sm btn-flat"><strong>Juli</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/08" class="btn btn-primary btn-block btn-sm btn-flat"><strong>Agustus</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/09" class="btn btn-primary btn-block btn-sm btn-flat"><strong>September</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/10" class="btn btn-primary btn-block btn-sm btn-flat"><strong>Oktober</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/11" class="btn btn-primary btn-block btn-sm btn-flat"><strong>November</strong></a>
            <a href="/bidang/laporanrfk/{{$tahun}}/12" class="btn btn-primary btn-block btn-sm btn-flat"><strong>Desember</strong></a>

            <a href="/bidang/laporanrfk" class="btn bg-purple btn-block btn-sm btn-flat"><strong>Kembali</strong></a>   
          </div>
        </div>
      </div>
    </div>
</section>


@endsection
@push('js')

@endpush

