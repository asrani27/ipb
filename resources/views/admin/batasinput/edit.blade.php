@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
   <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Edit</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/batas_input/edit/{{$data->id}}" method="post">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
                  <div class="col-sm-10">
                        <select name="tahun" class="form-control" readonly>
                            <option value="">-pilih-</option>
                            <option value="2023" {{$data->tahun == '2023' ? 'selected':''}}>2023</option>
                            <option value="2024" {{$data->tahun == '2024' ? 'selected':''}}>2024</option>
                            <option value="2025" {{$data->tahun == '2025' ? 'selected':''}}>2025</option>
                        </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Angkas</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="angkas" required value="{{$data->angkas}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Januari</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="januari" required value="{{$data->januari}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Februari</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="februari" required value="{{$data->februari}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Maret</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="maret" required value="{{$data->maret}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">April</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="april" required value="{{$data->april}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Mei</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="mei" required value="{{$data->mei}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Juni</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="juni" required value="{{$data->juni}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Juli</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="juli" required value="{{$data->juli}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Agustus</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="agustus" required value="{{$data->agustus}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">September</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="september" required value="{{$data->september}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Oktober</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="oktober" required value="{{$data->oktober}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">November</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="november" required value="{{$data->november}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Desember</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="desember" required value="{{$data->desember}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-flat btn-block"><i class="fa fa-send"></i> Simpan</button>
                    <a href="/admin/perioderfk" class="btn bg-gray btn-flat btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
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

