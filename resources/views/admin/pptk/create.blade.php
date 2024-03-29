@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
   <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-list"></i> Tambah PPTK</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/pptk/add" method="post">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIP PPTK</label>
                  <div class="col-sm-10">
                    <input type="text" name="nip_pptk" placeholder="NIP PPTK" value="{{old('nip_pptk')}}" class="form-control" required onkeypress="return RestrictSpace()">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama PPTK</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_pptk" placeholder="Nama PPTK" value="{{old('nama_pptk')}}" class="form-control" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Bidang</label>
                  <div class="col-sm-10">
                    <select name="bidang_id" class="form-control" required>
                      <option value="">-pilih-</option>
                      @foreach ($bidang as $item)
                          <option value="{{$item->id}}" {{old('bidang_id') == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn bg-primary btn-flat btn-block"><i class="fa fa-send"></i> Simpan</button>
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
<script>
function RestrictSpace() {
  if (event.keyCode == 32) {
      return false;
  }
}
</script>
@endpush

