@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Realisasi</h3>
    
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
    {{-- <div class="row">
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
          <div class="box-header text-center">
            <h3 class="box-title ">Pilih Tahun</h3>
          </div>
          <div class="box-body">
            <a href="/bidang/realisasi/2022" class="btn btn-primary btn-block btn-sm btn-flat"><strong>2022</strong></a>
            <a href="/bidang/realisasi/2023" class="btn btn-primary btn-block btn-sm btn-flat"><strong>2023</strong></a>
            <a href="/bidang/realisasi/2024" class="btn btn-primary btn-block btn-sm btn-flat"><strong>2024</strong></a>
          </div>
        </div>
      </div>
    </div> --}}
    <div class="row">
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
          <div class="box-header text-center">
            <h3 class="box-title ">Cari Data</h3>
          </div>
          <div class="box-body">
            <form method="get" action="/bidang/realisasi/caridata">
              @csrf
                <br/>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Subkegiatan</label>
                  <div class="col-sm-10">
                    <select name="subkegiatan_id" class="form-control" required>
                      <option value="">-</option>
                      @foreach ($subkegiatan as $item)
                          <option value="{{$item->id}}" {{old('subkegiatan_id') == $item->id ? 'selected':''}}>(tahun : {{$item->tahun}}) - {{$item->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis</label>
                  <div class="col-sm-10">
                    <select name="jenis" class="form-control" required>
                          <option value="">-</option>
                          <option value="murni" {{old('jenis') == 'murni' ? 'selected':''}}>MURNI</option>
                          <option value="pergeseran" {{old('jenis') == 'pergeseran' ? 'selected':''}}>PERGESERAN</option>
                          <option value="perubahan" {{old('jenis') == 'perubahan' ? 'selected':''}}>PERUBAHAN</option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn bg-primary btn-flat btn-block"><i class="fa fa-send"></i> TAMPILKAN</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>


@endsection
@push('js')

@endpush

