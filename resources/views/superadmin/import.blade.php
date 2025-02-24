@extends('layouts.app')
@push('css')
@endpush
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-upload"></i> Import Kode Rekening</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/superadmin/importdata/koderekening" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <button type="submit" class="btn btn-sm btn-primary">Import</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-upload"></i> Import Sub Kegiatan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/superadmin/importdata/subkegiatan" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <button type="submit" class="btn btn-sm btn-primary">Import</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-upload"></i> Import Kegiatan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/superadmin/importdata/kegiatan" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <button type="submit" class="btn btn-sm btn-primary">Import</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-upload"></i> Import Program</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/superadmin/importdata/program" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <button type="submit" class="btn btn-sm btn-primary">Import</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
@push('js')
@endpush