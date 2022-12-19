@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
   <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-list"></i> Edit Bidang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/bidang/edit/{{$data->id}}" method="post">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Bidang</label>
                  <div class="col-sm-8">
                    <input type="text" name="nama" value="{{$data->nama}}" class="form-control" required>
                  </div>
                  <div class="col-sm-2">
                    <button type="submit" class="btn bg-primary btn-flat btn-block"><i class="fa fa-send"></i> Update</button>
                  </div>
                </div>
                
              </div>
              
            </form>
          </div>
    </div>
   </div>
    
</section>


@endsection
@push('js')

@endpush

