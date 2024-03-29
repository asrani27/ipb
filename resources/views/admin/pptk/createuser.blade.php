@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
   <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-key"></i> Tambah User Login PPTK</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/pptk/createuser/{{$data->id}}" method="post">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-10">
                    <input type="text" name="nip_pptk" value="{{$data->nip_pptk}}" class="form-control" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_pptk" value="{{$data->nama_pptk}}" class="form-control" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Bidang</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" value="{{$data->bidang->nama}}" class="form-control" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" name="username" placeholder="username" value="{{old('username')}}" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" name="password" placeholder="Password" value="{{old('password')}}" class="form-control" required>
                  </div>
                </div>
                
              </div>
              <div class="box-footer">
                <button type="submit" class="btn bg-primary btn-flat btn-block"><i class="fa fa-send"></i> Simpan</button>
              </div>
            </form>
          </div>
    </div>
   </div>
    
</section>


@endsection
@push('js')

@endpush

