@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    
  <div class="row">

    <div class="col-md-12">
        <a href="/bidang/beranda" class="btn btn-flat btn-primary"><i class="fa fa-arrow-left"></i>  KEMBALI</a><br/><br/>
      <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-clipboard"></i> Sub Kegiatan : {{$subkegiatan->nama}}</h3>
          </div>
          <div class="box-body table-responsive no-padding text-sm">
            <table class="table table-hover">
              <tbody>
              <tr>
                <th class="text-center">No</th>
                <th>Uraian Kegiatan</th>
                <th style="text-align: right">DPA</th>
                <th style="text-align: right">Total Angkas (12 bulan)</th>
              </tr>
              @php
                  $no =1;
              @endphp
              @foreach ($data as $key => $item)
              @if ($item->dpa != $item->angkas)
              <tr style="background-color: rgba(251, 225, 225, 0.705)">
              @else
              <tr>
              @endif
                  <td class="text-center">{{$no++}}</td>
                  <td>{{$item->nama}}<br/>{{$item->keterangan}}</td>
                  <td style="text-align: right">{{number_format($item->dpa)}}</td>
                  <td style="text-align: right">{{number_format($item->angkas)}}</td>
              </tr>
              @endforeach
              <tfoot>
                <tr>
                    <td></td>
                    <td>Total</td>
                    <td style="text-align: right">{{number_format($data->sum('dpa'))}}</td>
                    <td style="text-align: right">{{number_format($data->sum('angkas'))}}</td>
                </tr>
              </tfoot>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
    
  </div>
  
</section>


@endsection
@push('js')

@endpush
