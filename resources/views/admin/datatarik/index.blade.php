@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-list"></i> Tarik Dari Kayuh Baimbai</h3>
        
                  <div class="box-tools">
                    {{-- <a href="/admin/bidang/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus"></i> Tambah Bidang</a> --}}
                  </div>
                </div>
                <div class="box-body">
                    {{-- <form class="form-horizontal" action="/admin/datatarik/" method="post">
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
                          <div class="col-sm-8">
                            <select name="tahun" class="form-control">
                                <option value="2023" {{old('tahun') == '2023' ? 'selected':''}}>2023</option>
                                <option value="2024" {{old('tahun') == '2024' ? 'selected':''}}>2024</option>
                            </select>
                          </div>
                          <div class="col-sm-2">
                            <button type="submit" class="btn bg-primary btn-flat btn-block"><i class="fa fa-send"></i> TARIK DATA</button>
                          </div>
                        </div>
                        
                      </div>
                      
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Data Program, Kegiatan Dan Subkegiatan</h3>
    
              <div class="box-tools">
                {{-- <a href="/admin/bidang/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus"></i> Tambah Bidang</a> --}}
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th>Tahun</th>
                  <th>Data</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($tahun as $item)
                    <tr>
                        <td>{{$item->nama}}</td>
                        <td>
                          {{-- <a href="/admin/datatarik/detail/{{$item->nama}}" class="btn btn-sm bg-green"> DETAIL</a> --}}
                            <a href="/admin/datatarik/program/{{$item->nama}}" class="btn btn-sm bg-blue">{{$item->program}} PROGRAM</a>
                            <a href="/admin/datatarik/kegiatan/{{$item->nama}}" class="btn btn-sm  bg-blue">{{$item->kegiatan}} KEGIATAN</a>
                            <a href="/admin/datatarik/subkegiatan/{{$item->nama}}" class="btn btn-sm  bg-blue">{{$item->subkegiatan}} SUB KEGIATAN</a>
                        </td>
                        <td></td>
                    </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
</section>


@endsection
@push('js')

@endpush

