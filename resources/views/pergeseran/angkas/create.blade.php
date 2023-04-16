@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            @include('pergeseran.angkas.deskripsi')
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Rencana Anggaran Kas</h3>
        
                  <div class="box-tools">
                    <a href="/bidang/pergeseran/program/kegiatan/{{$program->id}}/sub/{{$kegiatan->id}}/uraian/{{$subkegiatan->id}}/" class="btn btn-sm bg-gray btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
                  </div>
                </div>
                <!-- /.box-header -->
                <form class="form-horizontal" method="POST" action="/bidang/pergeseran/program/angkas/{{$program->id}}/{{$kegiatan->id}}/{{$subkegiatan->id}}/{{$uraian->id}}">
                  @csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"></label>
                      <div class="col-sm-5 text-center">
                        Rencana Keuangan
                      </div>
                      <div class="col-sm-5 text-center">
                        Rencana Fisik
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Januari</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{number_format($uraian->p_januari_keuangan, 0, ',', '.')}}" name="januari_keuangan" oninput="formatInput(this)" id="nilaijanuari">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_januari_fisik}}" name="januari_fisik" id="fisikjanuari">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Februari</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{number_format($uraian->p_februari_keuangan, 0, ',', '.')}}" name="februari_keuangan" oninput="formatInput(this)" id="nilaifebruari">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_februari_fisik}}" name="februari_fisik"  id="fisikfebruari">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Maret</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{number_format($uraian->p_maret_keuangan, 0, ',', '.')}}" name="maret_keuangan" oninput="formatInput(this)" id="nilaimaret">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_maret_fisik}}" name="maret_fisik"  id="fisikmaret">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">April</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{number_format($uraian->p_april_keuangan, 0, ',', '.')}}" name="april_keuangan" oninput="formatInput(this)" id="nilaiapril">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_april_fisik}}" name="april_fisik"  id="fisikapril">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Mei</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{number_format($uraian->p_mei_keuangan, 0, ',', '.')}}" name="mei_keuangan" oninput="formatInput(this)" id="nilaimei">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_mei_fisik}}" name="mei_fisik"  id="fisikmei">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Juni</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{number_format($uraian->p_juni_keuangan, 0, ',', '.')}}" name="juni_keuangan" oninput="formatInput(this)" id="nilaijuni">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_juni_fisik}}" name="juni_fisik"  id="fisikjuni">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Juli</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{number_format($uraian->p_juli_keuangan, 0, ',', '.')}}" name="juli_keuangan" oninput="formatInput(this)" id="nilaijuli">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_juli_fisik}}" name="juli_fisik"  id="fisikjuli">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Agustus</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" name="agustus_keuangan" value="{{number_format($uraian->p_agustus_keuangan, 0, ',', '.')}}" oninput="formatInput(this)" id="nilaiagustus">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_agustus_fisik}}" name="agustus_fisik"  id="fisikagustus">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">September</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" name="september_keuangan" value="{{number_format($uraian->p_september_keuangan, 0, ',', '.')}}"  oninput="formatInput(this)" id="nilaiseptember">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_september_fisik}}" name="september_fisik"  id="fisikseptember">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Oktober</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" name="oktober_keuangan" value="{{number_format($uraian->p_oktober_keuangan, 0, ',', '.')}}"   oninput="formatInput(this)" id="nilaioktober">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_oktober_fisik}}" name="oktober_fisik"  id="fisikoktober">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">November</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" name="november_keuangan" value="{{number_format($uraian->p_november_keuangan, 0, ',', '.')}}"  oninput="formatInput(this)" id="nilainovember">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_november_fisik}}" name="november_fisik"  id="fisiknovember">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Desember</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" name="desember_keuangan" value="{{number_format($uraian->p_desember_keuangan, 0, ',', '.')}}" oninput="formatInput(this)" id="nilaidesember">
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$uraian->p_desember_fisik}}" name="desember_fisik"  id="fisikdesember">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">SISA DPA</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{number_format($uraian->dpa, 0, ',', '.')}}" name="sisa_dpa" readonly id="sisa_dpa">
                        Pastikan sisa DPA 0
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="" name="total_persen"  id="total_persen" readonly>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">

                    <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-send"></i>  SIMPAN</button>
                    
                  </div>
                  <!-- /.box-footer -->
                </form>
                <!-- /.box-body -->
              </div>
        </div>
    </div>
    
</section>


@endsection
@push('js')
<script>
  $(document).ready(function() {
  const sisaDpaAwal = String(document.getElementById("sisa_dpa").value)
    const sisadpa = Number(sisaDpaAwal.replace(/,/g, '').replace(/\./g, ''));
    const inputs = ["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober", "november", "desember"];
    let total = 0
    inputs.map(bulan => {
      const prefix = "nilai"
      let stringValue = document.getElementById(`${prefix}${bulan}`)?.value || "0"
      const numberValue = Number(stringValue.replace(/\./g, '').replace(/,/g, ''))
      total += numberValue
    })
    
    let totalFisik = 0
    inputs.map(bulan => {
      const prefix = "fisik"
      let stringFisik = document.getElementById(`${prefix}${bulan}`)?.value || "0"
      const numberValue = Number(stringFisik)
      // console.log(`${bulan}:`, numberValue);
      totalFisik += numberValue
    })

    const result = sisadpa - total
    const stringTotalFisik = String(totalFisik.toFixed(2))

    document.getElementById("sisa_dpa").value = result;
    document.getElementById("total_persen").value = stringTotalFisik;
    
});
</script>
<script>
  const sisaDpaAwal = String(document.getElementById("sisa_dpa").value)

  const formatInput = (el) => {
    let usedValue = "0"
    const value = el.value

    if (value) {
      usedValue = value
    }

    if(usedValue.length > 1) {
      usedValue = usedValue.replace(/\D|^0+/g, "")
    }

    el.value = formatRupiah(usedValue)

    hitungFisik(el)
    hitungSisa()
  }

  const hitungFisik = (el) => {
    const sisadpa = Number(sisaDpaAwal.replace(/,/g, '').replace(/\./g, ''));
    const value = Number(String(el.value).replace(/,/g, '').replace(/\./g, ''))
    const result = (value / sisadpa * 100).toFixed(2)
    const elId = el.getAttribute('id')
    const bulan = elId.split("nilai")[1]
    const fisikEl = document.getElementById(`fisik${bulan}`)
    fisikEl.value = result
  }

  const hitungSisa = () => {
    const sisadpa = Number(sisaDpaAwal.replace(/,/g, '').replace(/\./g, ''));

    const inputs = ["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober", "november", "desember"];
    let total = 0
    let totalFisik = 0
    inputs.map(bulan => {
      const prefix = "nilai"
      let stringValue = document.getElementById(`${prefix}${bulan}`)?.value || "0"
      const numberValue = Number(stringValue.replace(/\./g, '').replace(/,/g, ''))
      
      total += numberValue
    })
    inputs.map(bulan => {
      const prefix = "fisik"
      let stringFisik = document.getElementById(`${prefix}${bulan}`)?.value || "0"
      const numberValue = Number(stringFisik)
      // console.log(`${bulan}:`, numberValue);
      totalFisik += numberValue
    })

    const result = sisadpa - total
    // console.log("sisadpa:", sisadpa)
    // console.log("total:", total)
    // console.log("result:", result)
    // console.log("totalFisik:", totalFisik)
    // const isBelowZero = result < 0
    // if (isBelowZero) {
    //   alert("Tidak boleh melebihi sisa dpa")
    //   return
    // }

    const stringResult = String(result)
    if(result < 0){
      document.getElementById("sisa_dpa").value = '- ' + formatRupiah(stringResult)
    }else{
      document.getElementById("sisa_dpa").value = formatRupiah(stringResult)
    }

    const stringTotalFisik = String(totalFisik.toFixed(2))
    console.log({stringTotalFisik});
    document.getElementById("total_persen").value = stringTotalFisik
  }

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
 
var number_string = angka.replace(/[^,\d]/g, "").toString(),
  split = number_string.split(","),
  sisa = split[0].length % 3,
  rupiah = split[0].substr(0, sisa),
  ribuan = split[0].substr(sisa).match(/\d{3}/gi);

// tambahkan titik jika yang di input sudah menjadi angka ribuan
if (ribuan) {
  separator = sisa ? "." : "";
  rupiah += separator + ribuan.join(".");
}

rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}
</script>
@endpush

