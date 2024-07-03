@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  
  <a href="/admin/laporan" class="btn bg-purple btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
  
  <div class="row">
    <div class="col-md-12">
      <!-- Block buttons -->
      <div class="box">
        <div class="box-body table-responsive">
          <table class="table table-bordered table-condensed">
            <tbody>
              <tr style="font-size:10px;" class="bg-purple">
                <th style="width: 10px">#</th>
                <th  style="text-align: center">Kode Rekening</th>
                <th  style="text-align: center">Uraian Kegiatan</th>
                <th style="text-align: center">DPA</th>
                <th style="text-align: center">PPTK</th>
                <th>Aksi</th>
              </tr>
              

              
              @foreach ($data as $key => $item)

              <tr style="font-size:12px;font-weight:bold;">
                <td style="width: 10px;">{{$key + 1}}</td>
                <td width="100px"> {{$item->kode_rekening}} </td>
                <td width="400px"> {{$item->nama}} </td>
                <td width="100px" style="text-align: right"> {{number_format($item->dpa)}} </td>
                <td width="200px"style="text-align: center"> {{$item->pptk == null ? '' : $item->pptk->nama_pptk}}<br/> {{$item->pptk == null ? '': $item->pptk->nip_pptk}} </td>
                <td style="text-align: center"> 
                    @if ($item->status_kirim == 1)
                    <a href="/admin/uraian/{{$item->id}}/kembalikan" class="btn btn-xs btn-danger" onclick="return confirm('Kembalikan?');> <i class="fa fa-close"></i> Kembalikan</a> 
                    @endif
                </td>
              </tr>
              
              @endforeach
              
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@push('js')

@endpush
