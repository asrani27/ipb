@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            @include('bidang.subkegiatan.deskripsi')
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Sub Kegiatan</h3>
        
                  <div class="box-tools">
                    <a href="/bidang/perubahan/program/kegiatan/{{$program->id}}" class="btn btn-sm bg-gray btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding text-sm">
                  <table class="table table-hover">
                    <tbody>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Subkegiatan</th>
                      <th>Uraian</th>
                    </tr>
                    @foreach ($data as $key => $item)
                    <tr>
                        <td class="text-center">{{$data->firstItem() + $key}}</td>
                        <td>{{$item->nama}}</td>
                        <td>

                            <a href="/bidang/perubahan/program/kegiatan/{{$program->id}}/sub/{{$kegiatan_id}}/uraian/{{$item->id}}"
                                class="btn btn-xs btn-flat btn-primary"><strong>{{$item->uraianperubahan->count()}} Uraian</strong></a>

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

