@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            @include('bidang.kegiatan.deskripsi')
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-clipboard"></i> Tambah Kegiatan</h3>
        
                  <div class="box-tools">
                    
                  </div>
                </div>
                <form class="form-horizontal" action="/bidang/program/kegiatan/{{$program->id}}/add" method="post">
                    @csrf
                  <div class="box-body">
                    
                    <input type="hidden" name="tahun" value="{{$program->tahun}}">
                    <input type="hidden" name="program_id" value="{{$program->id}}">

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Kegiatan</label>
                      <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-flat btn-block"><i class="fa fa-send"></i> Simpan</button>
                        <a href="/bidang/program/kegiatan/{{$program->id}}" class="btn bg-gray btn-flat btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
        </div>
    </div>
    
</section>


@endsection
@push('js')

@endpush

