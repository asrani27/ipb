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
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Subkegiatan</h3>
    
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
                  <th>Subkegiatan</th>
                  <th>PPTK</th>
                </tr>
                <form method="post" action="/admin/datatarik/pptk">
                  @csrf
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$item->tahun}}</td>
                    <td>
                      {{$item->nama}}<br/>
                      {{-- <small>kegiatan : [{{$item->kegiatan->id}}] {{$item->kegiatan->nama}}</small><br/>
                      <small>Program : [{{$item->kegiatan->program->id}}] {{$item->kegiatan->program->nama}}</small><br/> --}}
                      <small>SKPD : [{{$item->skpd->nama}}]</small><br/>

                    </td>
                    <td>
                      <select name="pptk_id[]">
                        <option value="">-</option>
                      @foreach ($pptk as $item2)
                          <option value="{{$item2->id}}" {{$item2->id == $item->pptk_id ? 'selected':''}}>{{$item2->nip_pptk}} - {{$item2->nama_pptk}}</option>
                      @endforeach
                      </select>
                    </td>
                    <input type="hidden" name="subkegiatan_id[]" value="{{$item->id}}">
                </tr>
                @endforeach
                <tr>
                  <td colspan='4'>
                    <button type="submit" class="btn btn-block btn-primary">UPDATE PPTK</button>
                  </td>
                </tr>
                </form>
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

