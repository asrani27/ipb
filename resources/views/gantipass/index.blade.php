@extends('layouts.app')
@push('css')
@endpush
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-key"></i> Ganti Password</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="form-horizontal" method="POST" action="/gantipass" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Masukkan Password Lama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="password_lama" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Masukkan Password Baru</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="password_baru" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Masukkan Lagi Password Baru</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="confirm_password" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>

    </div>
</div>
@endsection
@push('js')
@endpush