@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="info-box bg-purple">
        <span class="info-box-icon"><i class="fa fa-user-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Selamat Datang Di Aplikasi RFK</span>
          <span class="info-box-number">Hi, {{Auth::user()->name}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
              <span class="progress-description">
               Anda sebagai admin dapat mengatur pembukaan dan penutupan penginputan RFK
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>5</h3>

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
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$t_program}}</h3>

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
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$t_program}}</h3>

          <p>TOTAL SUB KEGIATAN</p>
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
    <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Pengaturan Penginputan RFK</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody>
              <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
              <tr>
                <td>1</td>
                <td>Penginputan RFK Murni</td>
                <td>
                  @if ($murni==0)
                  Tutup
                  @else
                  Buka
                  @endif
                </td>
                <td>
                  @if ($murni==0)
                  <a href="/admin/beranda/murni/buka" class="btn btn-xs btn-primary" onclick="return confirm('Yakin ingin dibuka?');"><i class="fa fa-folder-open"></i>
                      BUKA</a>
                  @else
                  <a href="/admin/beranda/murni/tutup" class="btn btn-xs btn-primary" onclick="return confirm('Yakin ingin ditutup?');"><i class="fa fa-folder"></i>
                      TUTUP</a>
                  @endif
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Pergeseran</td>
                <td>
                  @if ($pergeseran==0)
                  Tutup
                  @else
                  Buka
                  @endif
                </td>
                <td>
                  @if ($pergeseran==0)
                  <a href="/admin/beranda/pergeseran/buka" class="btn btn-xs btn-primary" onclick="return confirm('Yakin ingin dibuka?');"><i class="fa fa-folder-open"></i>
                      BUKA</a>
                  @else
                  <a href="/admin/beranda/pergeseran/tutup" class="btn btn-xs btn-primary" onclick="return confirm('Yakin ingin ditutup?');"><i class="fa fa-folder"></i>
                      TUTUP</a>
                  @endif
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Perubahan</td>
                <td>
                  @if ($perubahan==0)
                  Tutup
                  @else
                  Buka
                  @endif
                </td>
                <td>
                  @if ($perubahan==0)
                  <a href="/admin/beranda/perubahan/buka" class="btn btn-xs btn-primary" onclick="return confirm('Yakin ingin dibuka?');"><i class="fa fa-folder-open"></i>
                      BUKA</a>
                  @else
                  <a href="/admin/beranda/perubahan/tutup" class="btn btn-xs btn-primary" onclick="return confirm('Yakin ingin ditutup?');"><i class="fa fa-folder"></i>
                      TUTUP</a>
                  @endif
                </td>
              </tr>
              <tr>
                <td>4</td>
                <td>Realisasi</td>
                <td>
                  @if ($realisasi==0)
                  Tutup
                  @else
                  Buka
                  @endif
                </td>
                <td>
                  @if ($realisasi==0)
                  <a href="/admin/beranda/realisasi/buka" class="btn btn-xs btn-primary" onclick="return confirm('Yakin ingin dibuka?');"><i class="fa fa-folder-open"></i>
                      BUKA</a>
                  @else
                  <a href="/admin/beranda/realisasi/tutup" class="btn btn-xs btn-primary" onclick="return confirm('Yakin ingin ditutup?');"><i class="fa fa-folder"></i>
                      TUTUP</a>
                  @endif
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        
        <!-- /.box -->
    </div>
    <div class="col-md-6">

      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i><h3 class="box-title">History RFK</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody>
            <tr>
              <th>No</th>
              <th>Tahun</th>
              <th>Nama</th>
              <th>Jenis</th>
              <th>Tanggal</th>
            </tr>
            @foreach ($log as $key => $item)
                <tr>
                  <td>{{$log->firstItem() + $key}}</td>
                  <td>{{$item->tahun}}</td>
                  <td>{{$item->nama}}
                  
                    @if ($item->nama == 'pergeseran')
                    Ke : {{$item->ke}}
                    @else
                    {{$item->ke}}
                    @endif
                  </td>
                  <td>{{$item->jenis}}</td>
                  <td>{{$item->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
          </table>
          {{$log->links()}}
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
</section>


@endsection
@push('js')

@endpush
