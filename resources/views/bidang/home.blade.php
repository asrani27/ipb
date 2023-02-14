@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-9 col-sm-6 col-xs-12">
      <div class="info-box bg-purple">
        <span class="info-box-icon"><i class="fa fa-user-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Selamat Datang Di Aplikasi RFK</span>
          <span class="info-box-number">Hi, {{Auth::user()->name}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
              <span class="progress-description">
               Anda sebagai admin bidang dapat mengelola RFK
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">

      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-send"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Status RFK</span>
          <span class="info-box-number">{{strtoupper(statusRFK())}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
              <span class="progress-description">
                <strong>{{\Carbon\Carbon::today()->format('Y')}}</strong>
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    
  </div>
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>{{$t_program}}</h3>

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
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$t_kegiatan}}</h3>

          <p>TOTAL KEGIATAN</p>
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
          <h3>{{$t_subkegiatan}}</h3>

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
          <h3>{{$t_uraian}}</h3>

          <p>TOTAL URAIAN KEGIATAN</p>
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
    <div class="col-md-9">
      <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Sub Kegiatan, Tahun : 
              <strong>{{\Carbon\Carbon::today()->format('Y')}}</strong></h3>
          </div>
          <div class="box-body table-responsive no-padding text-sm">
            <table class="table table-hover">
              <tbody>
              <tr>
                <th class="text-center">No</th>
                <th>Subkegiatan</th>
                <th>Total</th>
                <th></th>
              </tr>
              @php
                  $no =1;
              @endphp
              @foreach ($subkegiatan as $key => $item)
              <tr>
                  <td class="text-center">{{$no++}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{number_format($item->totalsubkegiatan)}}</td>
      
                  <td width="15%">
                      <a href="/bidang/detail/subkegiatan/{{$item->id}}"
                          class="btn btn-xs btn-flat btn-success"><i class="fa fa-list"></i> Detail</a>
                          
                  </td>
              </tr>
              @endforeach
              
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td>TOTAL</td>
                  <td>{{number_format($subkegiatan->sum('totalsubkegiatan'))}}</td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
    <div class="col-md-3">
      <a href="#" class="btn btn-lg btn-flat btn-block btn-primary"><i class="fa fa-send"></i>  KIRIM KE ADMIN SKPD</a>
    </div>
  </div>
  
</section>


@endsection
@push('js')

@endpush
