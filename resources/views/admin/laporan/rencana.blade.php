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
                <th style="width: 10px">#</th>
                <th  style="text-align: center">Sub Kegiatan</th>
                <th style="text-align: center">DPA</th>
              </tr>
              

              @php
              $keg = 1;
              $subkeg = 1;
              @endphp
              @foreach ($data as $key => $item)

              <tr style="font-size:10px;font-weight:bold;" class="bg-danger">
                <td></td>
                <td style="width: 10px;"></td>
                <td width="400px">{{$item->nama}}</td>
                <td></td>
              </tr>

                @foreach ($item->kegiatan as $item2)

                <tr style="font-size:10px;" class="bg-warning">
                  <td></td>
                  <td></td>
                  <td width="200px">{{$item2->nama}}</td>
                  <td></td>
                </tr>

                  @foreach ($datasubkegiatan->where('kegiatan_id', $item2->id) as $item3)
                  @if ($item3->status_kirim == null)
                  <tr style="font-size:10px; background-color:#d3f1f9">
                  @else
                  <tr style="font-size:10px;">
                  @endif
                    <td>
                      @if ($item3->kirim_angkas == 1)
                      <a href="/admin/laporan/rencana/batal/{{$item3->id}}" onclick="return confirm('Yakin Ingin Di Batalkan?');"><i class="fa fa-times-circle text-danger"></i></a>
                      @endif
                    </td>
                    <td>{{$subkeg++}}</td>
                    <td width="200px">{{$item3->nama}}</td>
                    <td style="text-align: right;">{{number_format($item3->kolom3)}}</td>
                  </tr>
                  @endforeach
                @endforeach
              @endforeach
              <tr style="font-size:10px; background-color:#e7e4e6">
                <td></td>
                <td></td>
                <td>JUMLAH</td>
                <td style="text-align: right">{{number_format($datasubkegiatan->sum('kolom3'))}}</td>
               </td>
               
              </tr>
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
