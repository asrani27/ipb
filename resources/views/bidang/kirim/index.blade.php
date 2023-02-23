@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-clipboard"></i> Status Data Kirim</h3>
          </div>
          <div class="box-body table-responsive text-sm">
            Catatan : <br/>
            <i class="fa fa-send"></i> = Tombol Untuk mengirim Data<br/>
            <i class="fa fa-check"></i> = Data Terkirim
            <table class="table table-hover">
              <tbody>
              <tr>
                <th class="text-center" rowspan=2>No</th>
                <th rowspan=2 style="text-align: center">Sub Kegiatan</th>
                <th colspan=13 style="text-align: center">Status Kirim Data ke Admin SKPD (Angkas Dan Lap RFK bulan)</th>
              </tr>
              <tr>
                <th>Angkas</th>
                <th>Jan</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Apr</th>
                <th>Mei</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Agu</th>
                <th>Sep</th>
                <th>Okt</th>
                <th>Nov</th>
                <th>Des</th>
              </tr>
              @php
                  $no =1;
              @endphp
              @foreach ($data as $key => $item)
              <tr>
                  <td class="text-center">{{$no++}}</td>
                  <td>{{$item->nama}}</td>
                  
                  @if ($item->kirim_angkas == null)
                  <td>
                    {{-- <a href="/bidang/kirim_angkas/{{$item->id}}" onclick="return confirm('Yakin ingin di kirim, setelah di kirim data tidak bisa diubah kecuali saat RFK perubahan?');"><i class="fa fa-send"></i></a> --}}
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_januari == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_februari == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_maret == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_april == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_mei == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_juni == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_juli == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_agustus == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_september == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_oktober == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_november == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
                  
                  @if ($item->kirim_rfk_desember == null)
                  <td>
                  </td>
                  @else
                  <td><i class="fa fa-check"></i></td>
                  @endif
              </tr>
              @endforeach
              
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Kirim Data Sekaligus</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
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
