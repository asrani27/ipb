@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Sub Kegiatan</h3>
        
                  <div class="box-tools">
                    <a href="/pptk/murni/subkegiatan/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus-circle"></i> Tambah Sub Kegiatan</a>
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
                      <th>Aksi</th>
                      <th>Status</th>
                    </tr>
                    
                    @foreach ($data as $key => $item)
                    <tr>
                        <td class="text-center">{{$data->firstItem() + $key}}</td>
                        <td>{{$item->nama}}</td>
                        <td>
                            <a href="/subkegiatan/uraian/{{$item->id}}"
                                class="btn btn-xs btn-flat btn-primary"><strong>{{$item->uraianmurni->count()}} Uraian</strong></a>
                        
                        </td>
                        <td width="15%">
                          @if ($item->kirim_angkas == null)
                            <a href="/subkegiatan/program/kegiatan/{{$program_id}}/sub/{{$kegiatan_id}}/edit/{{$item->id}}"
                                class="btn btn-xs btn-flat btn-success"><i class="fa fa-edit"></i></a>
                            <a href="/subkegiatan/program/kegiatan/{{$program_id}}/sub/{{$kegiatan_id}}/delete/{{$item->id}}"
                                onclick="return confirm('Yakin ingin di hapus');"
                                class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i>
                            </a>
                          @endif
                        </td>
                        <td>
                          @if ($item->kirim_angkas == null)
                          <a href="/subkegiatan/kirim_angkas/{{$item->id}}"
                            onclick="return confirm('Yakin ingin di kirim');"
                            class="btn btn-xs btn-flat btn-primary"><i class="fa fa-send"></i> Kirim
                          </a> 
                          @else
                              <a href="#" class="btn btn-xs btn-flat btn-success"><i class="fa fa-check"></i> Terkirim</a>
                          @endif
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

