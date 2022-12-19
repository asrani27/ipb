@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Program</h3>
    
              <div class="box-tools">
                <a href="/bidang/program/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus-circle"></i> Tambah Program</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th class="text-center">No</th>
                  <th>Tahun</th>
                  <th>Program</th>
                  <th>Kegiatan</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$data->firstItem() + $key}}</td>
                    <td>{{$item->tahun}}</td>
                    <td>{{$item->nama}}</td>
                    <td>
                        <a href="/bidang/program/kegiatan/{{$item->id}}"
                            class="btn btn-xs btn-flat bg-purple" data-toggle="tooltip" data-placement="top"
                            title="Data Kegiatan"><strong>{{$item->kegiatan->count()}} Kegiatan</strong></a>
                    </td>
                    <td>
                        <a href="/bidang/program/edit/{{$item->id}}" class="btn btn-xs btn-flat  btn-success"><i class="fa fa-edit"></i></a>
                        <a href="/bidang/program/delete/{{$item->id}}"
                            onclick="return confirm('Yakin ingin di hapus');"
                            class="btn btn-xs btn-flat  btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
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

