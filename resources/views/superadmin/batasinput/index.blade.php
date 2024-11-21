@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="box box-primary">
          <div class="box-header">
            <i class="fa fa-institution"></i><h3 class="box-title">Data SKPD</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Jenis RFK</th>
                <th>Mulai</th>
                <th>Sampai</th>
                <th>is Aktif?</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->mulai}}</td>
                <td>{{$item->sampai}}</td>
                <td>{{$item->is_aktif == 1 ? 'Y':'T'}}
                 
                  @if ($item->is_aktif != 1)
                      
                  <a href="/superadmin/pengaturan/batasinput/setaktif/{{$item->id}}" class="btn btn-xs btn-success">aktifkan</a>
                  @endif
                </td>
                <td>
                    <a href="/superadmin/pengaturan/batasinput/edit/{{$item->id}}" class="btn btn-xs btn-success"><i
                            class="fa fa-edit"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        
    </div>
</div>
@endsection
@push('js')

@endpush
