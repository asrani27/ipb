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
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$data->firstItem() + $key}}</td>
                    <td>{{$item->tahun}}</td>
                    <td>{{$item->nama}}</td>
                    <td>
                        <a href="/bidang/perubahan/program/kegiatan/{{$item->id}}"
                            class="btn btn-xs btn-flat bg-purple" data-toggle="tooltip" data-placement="top"
                            title="Data Kegiatan"><strong>{{$item->kegiatan->count()}} Kegiatan</strong></a>
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

