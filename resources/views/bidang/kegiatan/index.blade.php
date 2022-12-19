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
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Kegiatan</h3>
        
                  <div class="box-tools">
                    <a href="/bidang/program" class="btn btn-sm bg-gray btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a href="/bidang/program/kegiatan/{{$program->id}}/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus-circle"></i> Tambah Kegiatan</a>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding text-sm">
                  <table class="table table-hover">
                    <tbody>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Kegiatan</th>
                      <th>Subkegiatan</th>
                      <th>Aksi</th>
                    </tr>
                    @foreach ($data as $key => $item)
                    <tr>
                        <td class="text-center">{{$data->firstItem() + $key}}</td>
                        <td>{{$item->nama}}</td>
                        <td>
                            <a href="/bidang/program/kegiatan/{{$program->id}}/sub/{{$item->id}}"
                                class="btn btn-xs btn-flat btn-primary" data-toggle="tooltip" data-placement="top"
                                title="Data Kegiatan"><strong>{{$item->subkegiatan->count()}} Sub
                                    Kegiatan</strong></a>
                        </td>
                        <td>
                            <a href="/bidang/program/kegiatan/{{$program->id}}/edit/{{$item->id}}"
                                class="btn btn-xs btn-flat btn-success"><i class="fa fa-edit"></i></a>
                            <a href="/bidang/program/kegiatan/{{$program->id}}/delete/{{$item->id}}"
                                onclick="return confirm('Yakin ingin di hapus');"
                                class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                  </tbody></table>
                </div>
                <!-- /.box-body -->
              </div>
        </div>
    </div>
    
</section>


@endsection
@push('js')

@endpush

