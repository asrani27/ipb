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
            <form class="form-horizontal" action="/admin/perioderfk/edit/{{$data->id}}" method="post">
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Januari</label>
                  <div class="col-sm-10">
                    <select name="januari" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->januari == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->januari == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->januari == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Februari</label>
                  <div class="col-sm-10">
                    <select name="februari" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->februari == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->februari == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->februari == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Maret</label>
                  <div class="col-sm-10">
                    <select name="maret" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->maret == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->maret == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->maret == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">April</label>
                  <div class="col-sm-10">
                    <select name="april" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->april == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->april == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->april == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Mei</label>
                  <div class="col-sm-10">
                    <select name="mei" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->mei == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->mei == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->mei == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Juni</label>
                  <div class="col-sm-10">
                    <select name="juni" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->juni == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->juni == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->juni == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Juli</label>
                  <div class="col-sm-10">
                    <select name="juli" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->juli == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->juli == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->juli == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Agustus</label>
                  <div class="col-sm-10">
                    <select name="agustus" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->agustus == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->agustus == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->agustus == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">September</label>
                  <div class="col-sm-10">
                    <select name="september" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->september == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->september == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->september == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Oktober</label>
                  <div class="col-sm-10">
                    <select name="oktober" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->oktober == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->oktober == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->oktober == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">November</label>
                  <div class="col-sm-10">
                    <select name="november" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->november == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->november == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->november == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Desember</label>
                  <div class="col-sm-10">
                    <select name="desember" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni"  {{$data->desember == 'murni' ? 'selected':''}}>Murni</option>
                        <option value="pergeseran" {{$data->desember == 'pergeseran' ? 'selected':''}}>Pergeseran</option>
                        <option value="perubahan" {{$data->desember == 'perubahan' ? 'selected':''}}>Perubahan</option>
                    </select>
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

