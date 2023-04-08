@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Data PPTK</h3>
    
              <div class="box-tools">
                <a href="/admin/pptk/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus"></i> Tambah PPTK</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th class="text-center">No</th>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Bidang</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$item->nip_pptk}}</td>
                    <td>{{$item->nama_pptk}}</td>
                    <td>{{$item->bidang->nama}}</td>
                    <td>
                        @if ($item->user == null)
                        <a href="/admin/pptk/createuser/{{$item->id}}" class="btn btn-xs btn-primary btn-flat"><i
                                class="fa fa-key"></i> Buat
                            User</a>
                        @endif
                        
                        <a href="/admin/pptk/edit/{{$item->id}}" class="btn btn-xs btn-success btn-flat"><i
                                class="fa fa-edit"></i></a>
                        <a href="/admin/pptk/delete/{{$item->id}}"
                            onclick="return confirm('Yakin ingin di hapus');" class="btn btn-xs btn-danger btn-flat"><i
                                class="fa fa-trash"></i></a>

                        @if ($item->user == null)
                        @else
                        <a href="/admin/pptk/resetpass/{{$item->id}}" class="btn btn-xs bg-gray btn-flat"><i
                                class="fa fa-key"></i> Reset Pass</a>

                        @endif

                        <a href="/admin/pptk/subkegiatan/{{$item->id}}" class="btn btn-xs bg-purple btn-flat"><i
                          class="fa fa-list"></i> Sub Kegiatan</a>
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

