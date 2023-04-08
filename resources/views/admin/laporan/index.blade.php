@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-clipboard"></i> Status Laporan RFK SKPD</h3>
          </div>
          <div class="box-body table-responsive text-sm">
            <table class="table table-hover">
              <tbody>
              <tr class='bg-purple'>
                <th class="text-center" rowspan=2>No</th>
                <th rowspan=2 style="text-align: center">TAHUN</th>
                <th colspan=13 style="text-align: center">Laporan RFK (bulan)</th>
              </tr>
              <tr class='bg-purple'>
                <th>Rencana</th>
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
              <tr>
                <td>1</td>
                <td>2023</td>
                <td>
                  <a href="/admin/laporan/rencana/2023" class='btn btn-flat btn-xs bg-purple'>Rencana</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/januari" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/februari" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/maret" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/april" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/mei" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/juni" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/juli" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/agustus" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/september" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/oktober" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/november" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2023/desember" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
              </tr>
              </tbody>
              
            </table>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
    {{-- <a href="/admin/laporan/2022" class="btn btn-primary"><strong>2022</strong></a>
    <a href="/admin/laporan/2023" class="btn btn-primary"><strong>2023</strong></a> --}}
  </div>
</section>

@endsection
@push('js')

@endpush
