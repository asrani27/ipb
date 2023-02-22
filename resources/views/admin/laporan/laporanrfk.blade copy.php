@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>{{$bidang}}</h3>

          <p>TOTAL BIDANG</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
            <h3>{{$program}}</h3>

          <p>TOTAL PROGRAM</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$subkegiatan}}</h3>

          <p>TOTAL SUB KEGIATAN</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>-</h3>

          <p>-</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-clipboard"></i> Status Laporan</h3>
          </div>
          <div class="box-body table-responsive text-sm">
            <table class="table table-hover">
              <tbody>
              <tr>
                <th class="text-center" rowspan=2>No</th>
                <th rowspan=2 style="text-align: center">Sub Kegiatan</th>
                <th colspan=13 style="text-align: center">Laporan RFK (bulan)</th>
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
                  <td>
                    @if ($item->kirim_angkas == null)
                    <i class="fa fa-minus"></i>
                    @else
                    <a href="/admin/subkegiatan/angkas/{{$item->id}}"><span class="text-green"><i class="fa fa-check"></i></span></a>
                    @endif
                    </td>
                  
              </tr>
              @endforeach
              
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
