@extends('layouts.app')
@push('css')

<link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-clipboard"></i> Tambah SubKegiatan</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="/admin/datatarik/subkegiatan/{{$tahun}}/add" method="post">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">SubKegiatan Baru</label>
              <div class="col-sm-10">
                <select class="form-control select2" name="subkegiatan_id" required>
                  <option value="">-pilih-</option>
                  @foreach ($subkegiatan as $item)
                  <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary btn-flat btn-block"><i class="fa fa-send"></i>
                  Simpan</button>
                <a href="/admin/kegiatan" class="btn bg-gray btn-flat btn-block"><i class="fa fa-arrow-left"></i>
                  Kembali</a>
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


<script src="/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    })
</script>
@endpush