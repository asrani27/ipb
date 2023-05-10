@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-clipboard"></i> Tambah Sub Kegiatan</h3>
        
                  <div class="box-tools">
                    
                  </div>
                </div>
                <form class="form-horizontal" action="/pptk/murni/subkegiatan/add" method="post">
                    @csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Kegiatan</label>
                      <div class="col-sm-10">
                        <select name="kegiatan_id" class="form-control" required>
                          <option value="">-pilih-</option>
                          @foreach ($kegiatan as $item)
                              <option value="{{$item->id}}">{{$item->tahun}} - {{$item->nama}}, Program : {{$item->program->nama}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Sub Kegiatan</label>
                      <div class="col-sm-10">
                        <textarea name="nama" rows="3" required class="form-control"></textarea>
                        
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-flat btn-block"><i class="fa fa-send"></i> Simpan</button>
                        <a href="/pptk/murni" class="btn bg-gray btn-flat btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
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

