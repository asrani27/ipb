@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Realisasi</h3>
    
              {{-- <div class="box-tools">
                <a href="/bidang/program/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus-circle"></i> Tambah Program</a>
              </div> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body text-sm">
                <dl>
                <dd><strong>TAHUN :</strong> {{$tahun}}</dd>
                <dd><strong>PROGRAM :</strong> {{$program->nama}}</dd>
                <dd><strong>KEGIATAN :</strong> {{$kegiatan->nama}}</dd>
                <dd><strong>SUBKEGIATAN :</strong> {{$subkegiatan->nama}}</dd>
                <dd><strong>JENIS RFK :</strong> {{$jenis}}</dd>
                </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title ">Uraian</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-condensed">
              <tbody>
              <tr style="font-size:12px;" class="bg-purple">
                <th style="width: 10px">#</th>
                <th>Uraian</th>
                <th>DPA</th>
                <th>RFK</th>
                <th>Jan</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Apr</th>
                <th>Mei</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Augt</th>
                <th>Sept</th>
                <th>Okt</th>
                <th>Nov</th>
                <th>Des</th>
                <th>Jumlah</th>
              </tr>
              @foreach ($data as $key => $item)
                  
              <tr style="font-size:10px;">
                <td style="width: 10px">{{$key + 1}}</td>
                <td width="200px">{{$item->nama}}<br/>
                {{$item->keterangan}}
                </td>
                <td>{{number_format($item->dpa)}}</td>
                <td>
                Renc.Keuangan <br/>
                Real Keuangan <br/>
                Renc.Fisik <br/>
                Real Fisik  
                </td>
                <td style="text-align: right;">
                  {{number_format($item->p_januari_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="januari"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_januari_keuangan}}">{{number_format($item->r_januari_keuangan)}} </a><br/>
                  {{round($item->p_januari_fisik,2)}}% <br/>
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="januari"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_januari_fisik}}">{{round($item->r_januari_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_februari_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="februari"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_februari_keuangan}}">{{number_format($item->r_februari_keuangan)}} </a><br/>
                  {{round($item->p_februari_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="februari"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_februari_fisik}}">{{round($item->r_februari_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_maret_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="maret"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_maret_keuangan}}">{{number_format($item->r_maret_keuangan)}} </a><br/>
                  {{round($item->p_maret_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="maret"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_maret_fisik}}">{{round($item->r_maret_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_april_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="april"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_april_keuangan}}">{{number_format($item->r_april_keuangan)}} </a><br/>
                  {{round($item->p_april_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="april"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_april_fisik}}">{{round($item->r_april_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_mei_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="mei"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_mei_keuangan}}">{{number_format($item->r_mei_keuangan)}} </a><br/>
                  {{round($item->p_mei_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="mei"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_mei_fisik}}">{{round($item->r_mei_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_juni_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="juni"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_juni_keuangan}}">{{number_format($item->r_juni_keuangan)}} </a><br/>
                  {{round($item->p_juni_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="juni"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_juni_fisik}}">{{round($item->r_juni_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_juli_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="juli"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_juli_keuangan}}">{{number_format($item->r_juli_keuangan)}} </a><br/>
                  {{round($item->p_juli_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="juli"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_juli_fisik}}">{{round($item->r_juli_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_agustus_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="agustus"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_agustus_keuangan}}">{{number_format($item->r_agustus_keuangan)}} </a><br/>
                  {{round($item->p_agustus_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="agustus"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_agustus_fisik}}">{{round($item->r_agustus_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_september_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="september"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_september_keuangan}}">{{number_format($item->r_september_keuangan)}} </a><br/>
                  {{round($item->p_september_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="september"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_september_fisik}}">{{round($item->r_september_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_oktober_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="oktober"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_oktober_keuangan}}">{{number_format($item->r_oktober_keuangan)}} </a><br/>
                  {{round($item->p_oktober_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="oktober"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_oktober_fisik}}">{{round($item->r_oktober_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_november_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="november"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_november_keuangan}}">{{number_format($item->r_november_keuangan)}} </a><br/>
                  {{round($item->p_november_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="november"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_november_fisik}}">{{round($item->r_november_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->p_desember_keuangan)}} <br/>
                  <a href="#" class="edit-realisasi" data-id="{{$item->id}}" data-bulan="desember"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_desember_keuangan}}">{{number_format($item->r_desember_keuangan)}} </a><br/>
                  {{round($item->p_desember_fisik,2)}}% <br/>
                  
                  <a href="#" class="edit-realisasifisik" data-id="{{$item->id}}" data-bulan="desember"  data-uraian="{{$item->nama}}" data-rencrealisasi="{{$item->p_desember_fisik}}">{{round($item->r_desember_fisik,2)}}% </a>
                </td>
                <td style="text-align: right">
                  {{number_format($item->jumlah_renc_keuangan)}} <br/>
                 {{number_format($item->jumlah_real_keuangan)}} <br/>
                  {{round($item->jumlah_renc_fisik,2)}}% <br/>
                  {{round($item->jumlah_real_fisik,2)}}%
                </td>
              </tr>
              @endforeach
              <tr style="font-size: 10px">
                <td></td>
                <td>Total Rencana Keuangan</td>
                <td>{{number_format($data->sum('dpa'))}}</td>
                <td></td>
                <td style="text-align: right">{{number_format($data->sum('p_januari_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_februari_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_maret_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_april_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_mei_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_juni_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_juli_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_agustus_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_september_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_oktober_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_november_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('p_desember_keuangan'))}}</td>
                <td style="text-align: right">{{number_format($data->sum('jumlah_renc_keuangan'))}}</td>
              </tr>
              </tbody>
            </table>
            <a href="/bidang/realisasi/{{$tahun}}/{{$program->id}}/{{$kegiatan->id}}" class="btn bg-purple btn-block btn-sm btn-flat"><strong>Kembali</strong></a>   
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-purple">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="ion ion-clipboard"></i> Realisasi Keuangan</h4>
          </div>
          <form method="post" action="/bidang/realisasi">
          <div class="modal-body">
              @csrf
              <div class="form-group">
                  <input type="hidden" id="uraian_id" class="form-control" name="uraian_id">
              </div>
              <div class="form-group">
                  <label>Uraian</label>
                  <input type="text" id="uraian" class="form-control" name="uraian" readonly>
              </div>
              <div class="form-group">
                  <label>Bulan</label>
                  <input type="text" id="bulan" class="form-control" name="bulan" readonly>
              </div>
              <div class="form-group">
                  <label>Renc Keuangan</label>
                  <input type="text" id="renc_realisasi" class="form-control" readonly>
              </div>
              <div class="form-group">
                  <label>Realisasi Keuangan</label>
                  <input type="text" id="real_realisasi" class="form-control" name="real_realisasi">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn bg-grey pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
            <button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-editfisik">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-purple">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="ion ion-clipboard"></i> Realisasi Fisik</h4>
          </div>
          <form method="post" action="/bidang/realisasifisik">
          <div class="modal-body">
              @csrf
              <div class="form-group">
                  <input type="hidden" id="uraian_idfisik" class="form-control" name="uraian_id">
              </div>
              <div class="form-group">
                  <label>Uraian</label>
                  <input type="text" id="uraianfisik" class="form-control" name="uraian" readonly>
              </div>
              <div class="form-group">
                  <label>Bulan</label>
                  <input type="text" id="bulanfisik" class="form-control" name="bulan" readonly>
              </div>
              <div class="form-group">
                  <label>Renc Fisik</label>
                  <input type="text" id="renc_realisasifisik" class="form-control" readonly>
              </div>
              <div class="form-group">
                  <label>Realisasi Fisik</label>
                  <input type="text" id="real_realisasifisik" class="form-control" name="real_realisasi">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn bg-grey pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
            <button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
</section>


@endsection
@push('js')
<script>
  $(document).on('click', '.edit-realisasi', function() {
  $('#uraian_id').val($(this).data('id'));
  $('#bulan').val($(this).data('bulan'));
  $('#uraian').val($(this).data('uraian'));
  $('#renc_realisasi').val($(this).data('rencrealisasi'));
  $("#modal-edit").modal();
});
</script>
<script>
  $(document).on('click', '.edit-realisasifisik', function() {
  $('#uraian_idfisik').val($(this).data('id'));
  $('#bulanfisik').val($(this).data('bulan'));
  $('#uraianfisik').val($(this).data('uraian'));
  $('#renc_realisasifisik').val($(this).data('rencrealisasi'));
  $("#modal-editfisik").modal();
});
</script>
@endpush

