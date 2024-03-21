@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <a href="/admin/datatarik" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-arrow-left"></i> Kembali</a><br/><br/>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Kegiatan</h3>
    
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
                  <th>Kegiatan</th>
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$item->tahun}}</td>
                    <td>{{$item->nama}}<br/>
                        <small>SKPD : {{$item->skpd->nama}}</small>
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

