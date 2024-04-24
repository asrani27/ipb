@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Data kelurahan</h3>
    
              <div class="box-tools">
                <a href="/admin/kelurahan/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus"></i> Tambah kelurahan</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th class="text-center">No</th>
                  <th>kelurahan</th>
                  {{-- <th>User Login</th> --}}
                  <th>Aksi</th>
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$item->nama}}</td>
                    {{-- <td>
                        @if ($item->user == null)
                        <a href="/admin/kelurahan/createuser/{{$item->id}}" class="btn btn-xs btn-warning btn-flat"><i
                                class="fa fa-key"></i> Buat
                            User</a>
                        @else
                        {{$item->user->username}}
                        @endif
                    </td> --}}
                    <td>
                        <a href="/admin/kelurahan/edit/{{$item->id}}" class="btn btn-xs btn-success btn-flat"><i
                                class="fa fa-edit"></i></a>
                        <a href="/admin/kelurahan/delete/{{$item->id}}"
                            onclick="return confirm('Yakin ingin di hapus');" class="btn btn-xs btn-danger btn-flat"><i
                                class="fa fa-trash"></i></a>

                        {{-- @if ($item->user == null)
                        @else
                        <a href="/admin/kelurahan/resetpass/{{$item->id}}" class="btn btn-xs btn-primary btn-flat"><i
                                class="fa fa-key"></i> Reset Pass</a>

                        @endif --}}
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

