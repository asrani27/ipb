<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="en-us" http-equiv="Content-Language" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title></title>
    <style>
        @page {
            margin-top: 80px;
            margin-left: 50px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 0px;
            font-family: 'Times New Roman';
            font-size: 16px;
            /** Extra personal styles **/
            /* background-color: #03a9f4;
            color: white;
            text-align: center; 
            line-height: 35px;*/
        }

        

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 8px;
            font-family: Arial, Helvetica, sans-serif;
            /** Extra personal styles **/
            /* background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px; */
        }
        .page_break { page-break-before: always; }
    </style>
</head>

<body>
    <header>
        
        {{-- <p><span class="auto-style1"><strong>LAPORAN DATA PERMOHONAN </strong></span></p> --}}
    </header>
    <footer>
        <hr>
        <p>Tanggal Cetak : {{\Carbon\Carbon::now()->format('d-m-Y H:i:s')}}
        </p>
    </footer>
    
    <main>
        <table border="0" width="100%">
            <tr>
                <td style="border: 0px;font-family:'Times New Roman; font-size:16px" align="left" width="60%">
                    Perihal : Permohonan <br/>
                    <h2><u>KRK/KKPR</u></h2>
                </td>
                <td style="border: 0px;" valign="top" align="left" width="40%">
                    <span style="font-size: 16px;font-family:'times new roman">
                    Kepada,<br/>
                    Yth. Walikota Banjarmasin<br/>
                    Cq. Kepala Dinas Pekerjaan Umum <br/> dan Penataan Ruang<br><br>di<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>BANJARMASIN</u></b>
                    </span><br />
                </td>
            </tr>
        </table>
        <table cellpadding="3" cellspacing="0" width="100%" style="font-size: 16px;font-family:'times new roman">
            Yang bertandatangan di bawah ini :
            <tbody>
                <tr>
                    <td colspan="2">Yang bertandatangan di bawah ini :</td>
                </tr>
                <tr>
                    <td width="16%">Nama</td>
                    <td>: {{$data->nama}}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>: {{$data->pekerjaan}}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{$data->alamat}}, RT {{$data->rt }}, RW {{$data->rw}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kecamatan : {{$data->kecamatan}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kelurahan : {{$data->kelurahan}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Telepon : {{$data->telepon}}</td>
                </tr>
                <br/>
                <tr>
                    <td colspan="2">Dalam hal ini bertindak dan atas nama  {{$data->atas_nama}}<br/>
                    Dengan ini mengajukan permohonan untuk mendapatkan pelayanan sebagaimana tersebut di atas terhadap 
                    sebidang tanah yang terletak di <br>
                    </td>
                </tr>
                <br/>
                <tr>
                    <td>Jalan</td>
                    <td>: {{$data->jalan}}</td>
                </tr>
                <tr>
                    <td>Kelurahan</td>
                    <td>: {{$data->kelurahan2}}</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>: {{$data->kecamatan2}}</td>
                </tr>
                <tr>
                    <td>Luas Tanah</td>
                    <td>: {{$data->luas_tanah}}</td>
                </tr>
                <tr>
                    <td>Status Tanah</td>
                    <td>: {{$data->status_tanah}}</td>
                </tr>
                <tr>
                    <td width="16%">Jenis Peruntukan</td>
                    <td>: {{$data->jenis_peruntukan}}</td>
                </tr>
                <br/>
                <tr>
                    <td colspan="2">
                    Sebagaimana kelengkapan bahan permohonan bersama ini di lampirkan <br/>
                    1. Fotocopy KTP <br/>
                    2. Fotocopy Lunas PBB Tahun Berjalan <br/>
                    3. Fotocopy sertifikat/ surat-surat tanah tersebut <br/>
                    4. Surat pernyataan tidak ada masalah atas tanah tersebut <br/>
                    5. Gambar Rencana (Site PLan, Denah, Tampak Depan) <br/>
                    6. NPWP (bila ada) <br/>
                    7. Titik Koordinat <br/><br/>

                    Kami menyatakan pula bahwa bahan-bahan dan keterangan yang disampaikan tersebut diatas adalah benar,
                    dapat dipertanggungjawabkan dan saya bersedia mentaati dan mematuhi segala yang di tetapkan.
                    </td>
                </tr>
            </tbody>
        </table>
        <br />
        <table width="100%" border="0">
            <tr style="border: 0px;">
                <td width="70%" style="border: 0px;font-size:16px;font-family:'Times New Roman'"></td>
                <td width="30%" style="border: 0px;font-size:16px;font-family:'Times New Roman';text-align:center">
                    Pemohon / Kuasa Pemohon,<br/><br/><br/><br/>
                    {{$data->nama}}

                </td>
            </tr>
        </table>

        {{-- <div class="page_break">
            LAMPIRAN 1 : KTP<br/>
            <img src="http://localhost:8000/storage/krk/3/LAMPIRAN1_3.jpeg" width="10px"/>
        </div>
        <div class="page_break">
            LAMPIRAN 2 : LUNAS PBB TAHUN BERJALAN<br/>
        </div>
        <div class="page_break">
            LAMPIRAN 3 : SERTIFIKAT/SURAT-SURAT TANAH<br/>
        </div>
        <div class="page_break">
            LAMPIRAN 4 : SURAT PERNYATAAN TIDAK ADA MASALAH ATAS TANAH TERSEBUT<br/>
        </div>
        <div class="page_break">
            LAMPIRAN 5 : GAMBAR RENCANA(SITE PLAN,DENAH,TAMPAK DEPAN)<br/>
        </div>
        <div class="page_break">
            LAMPIRAN 6 : NPWP<br/>
        </div> --}}
    </main>
</body>

</html>