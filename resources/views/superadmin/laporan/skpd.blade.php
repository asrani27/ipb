@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="box box-primary">
          <div class="box-header">
            <i class="fa fa-file-o"></i><h3 class="box-title">Data SKPD yang mengirim Laporan</h3>
          </div>
          
            <div class="box-body">
                <table class="table table-border">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>SKPD</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($skpd as $key=> $item)
                        
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->nama}}</td>
                      <td>{{$item->laporan == null ? '' : 'diterima'}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
            
        </div>
        
    </div>
</div>


@endsection
@push('js')

@endpush
