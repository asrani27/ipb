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
            <div class="box-body table-responsive no-padding">
              
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
            <h3 class="box-title ">Pilih Tahun</h3>
          </div>
          <div class="box-body">
            <a href="/bidang/laporanrfk/2022" class="btn btn-primary btn-block btn-sm btn-flat"><strong>2022</strong></a>
            <a href="/bidang/laporanrfk/2023" class="btn btn-primary btn-block btn-sm btn-flat"><strong>2023</strong></a>
          </div>
        </div>
      </div>
    </div>
</section>


@endsection
@push('js')

@endpush

