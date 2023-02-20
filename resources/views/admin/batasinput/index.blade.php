@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Data Batas Input Pelaporan RFK</h3>
    
              <div class="box-tools">
                <a href="/admin/batas_input/add" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th class="text-center">No</th>
                  <th>Tahun</th>
                  <th>Angkas</th>
                  <th>Januari</th>
                  <th>Februari</th>
                  <th>Maret</th>
                  <th>April</th>
                  <th>Mei</th>
                  <th>Juni</th>
                  <th>Juli</th>
                  <th>Agustus</th>
                  <th>September</th>
                  <th>Oktober</th>
                  <th>November</th>
                  <th>Desember</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($data as $key => $item)
                <tr style="font-size:12px">
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$item->tahun}}</td>
                    <td>{{\Carbon\Carbon::parse($item->angkas)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->januari)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->februari)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->maret)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->april)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->mei)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->juni)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->juli)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->agustus)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->september)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->oktober)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->november)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->desember)->format('d-m-Y')}}</td>
                    <td>
                        <a href="/admin/batas_input/edit/{{$item->id}}" class="btn btn-xs btn-success btn-flat"><i
                                class="fa fa-edit"></i></a>
                        <a href="/admin/batas_input/delete/{{$item->id}}" onclick="return confirm('Yakin ingin di hapus');" class="btn btn-xs btn-danger btn-flat"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                
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

