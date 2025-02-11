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
                <td>2024</td>
                <td>
                  <a href="/admin/laporan/2024/januari" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/februari" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/maret" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/april" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/mei" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/juni" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/juli" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/agustus" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/september" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/oktober" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/november" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2024/desember" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>2025</td>
                <td>
                  <a href="/admin/laporan/2025/januari" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/februari" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/maret" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/april" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/mei" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/juni" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/juli" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/agustus" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/september" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/oktober" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/november" class='btn btn-flat btn-xs bg-purple'>RFK</a>
                </td>
                <td>
                  <a href="/admin/laporan/2025/desember" class='btn btn-flat btn-xs bg-purple'>RFK</a>
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