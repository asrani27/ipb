@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
   <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Edit Program</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/bidang/program/edit/{{$data->id}}" method="post">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
                  <div class="col-sm-10">
                        <select name="tahun" class="form-control" required>
                            <option value="">-pilih-</option>
                            <option value="2022" {{$data->tahun == '2022' ? 'selected':''}}>2022</option>
                            <option value="2023" {{$data->tahun == '2023' ? 'selected':''}}>2023</option>
                        </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Program</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="{{$data->nama}}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-flat btn-block"><i class="fa fa-send"></i> Simpan</button>
                    <a href="/bidang/program" class="btn bg-gray btn-flat btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
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

