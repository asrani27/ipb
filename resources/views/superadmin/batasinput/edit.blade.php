@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="box box-primary">
          <div class="box-header">
            <i class="fa fa-file-o"></i><h3 class="box-title">Edit Batas Input</h3>
          </div>
          <!-- /.box-header -->

          <form class="form-horizontal" action="/superadmin/pengaturan/batasinput/edit/{{$data->id}}" method="post">
            @csrf
            <div class="box-body">
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Jenis RFK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$data->nama}}" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Mulai</label>
                <div class="col-sm-10">
                    <input type="datetime-local" name="mulai" class="form-control" value="{{$data->mulai}}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Sampai</label>
                <div class="col-sm-10">
                    <input type="datetime-local" name="sampai" class="form-control" value="{{$data->sampai}}" required>
                </div>
              </div>
              {{-- <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Jenis</label>
                <div class="col-sm-10">
                      <select name="jenis" class="form-control" required>
                          <option value="">-pilih-</option>
                          <option value="murni">Murni</option>
                          <option value="pergeseran">Pergeseran</option>
                          <option value="perubahan">Perubahan</option>
                      </select>
                </div>
              </div> --}}
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary btn-block" value="excel" name="button">Simpan</button>
                </div>
              </div>
            </div>
          </form>
          <!-- /.box-body -->
        </div>
        
    </div>
</div>
@endsection
@push('js')
    
@endpush