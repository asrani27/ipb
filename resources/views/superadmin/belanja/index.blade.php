@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="row">
  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-header">
        <i class="fa fa-file-o"></i>
        <h3 class="box-title">Export Laporan</h3>
      </div>
      <!-- /.box-header -->


      <div class="box-body">
        <a href="/superadmin/belanjaskpd/export" class="btn btn-primary btn-block">Export
          Laporan Belanja</a>
      </div>
      <!-- /.box-body -->
    </div>

  </div>
</div>

@endsection
@push('js')

@endpush