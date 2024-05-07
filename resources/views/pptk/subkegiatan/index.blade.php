@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Angkas Sub Kegiatan</h3>
        
                  <div class="box-tools">
                    {{-- <a href="/pptk/murni/subkegiatan/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus-circle"></i> Tambah Sub Kegiatan</a> --}}
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Tahun</th>
                      <th>Jenis</th>
                      <th>Subkegiatan</th>
                      <th>Uraian</th>
                    </tr>
                    
                    @foreach ($data as $key => $item)
                    <tr>
                        <td class="text-center">{{1 + $key}}</td>
                        <td>{{$item->tahun}}</td>
                        <td>{{$status}}</td>
                        <td>{{$item->nama}}</td>
                        <td>
                            <a href="/pptk/subkegiatan/uraian/{{$item->id}}"
                              class="btn btn-xs btn-flat btn-primary"><strong>Uraian</strong></a>
                          {{-- <a href="/pptk/subkegiatan/kirim/{{$item->id}}"
                              class="btn btn-xs btn-flat btn-success"><strong> Kirim</strong></a> --}}
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

