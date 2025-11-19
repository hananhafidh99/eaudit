<style type="text/css">
    .page {
        font-size: 12pt;
        width: 210mm;
        min-height: 297mm;
        padding-right: 10mm;
        padding-left: 10mm;
        padding-top: 10mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        background: white;
    }

    @page {
        size: A4;
        margin: 0px;
    }

    table{
        border-collapse: collapse;

    }
    .table1 {
        width: 100%;
        background: #fff;
        padding: 20px;
        border-collapse: collapse;
    }
    .table1 tr, .table1 td, .table1 th {
        border: table-cell;
        border: 1px  solid #444;
    }
    .table3 {
        width: 100%;
        background: #fff;
        padding: 20px;
        border-collapse: collapse;
    }
    .table3 tr, .table3 td, .table3 th {
        border: table-cell;
    }
    tr,td,th {
        vertical-align: top;
    }

    .table2 tr, .table2 td , .table2 th{
        border: 0px!important;
    }
    .ttd{
        height: 50px;
    }

    @media print{
        html, body {
            font-size: 12pt;
            width: 215.9mm;
            height: 330.2mm;
        }
        .page {
            margin: 0px;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after:always;

        }

        nav {
            display: none;
        }
        .table1 {
           align:center;
           font-size: 12pt;
           color: #212121;
       }
       .table1 tr, .table1 td , .table1 th{
        border: table-cell;
        border: 1px  solid #444;
        padding: 2px 2px 2px 2px!important;

    }
    .table3 {
           align:center;
           font-size: 12pt;
           color: #212121;
       }
       .table3 tr, .table3 td , .table3 th{
        border: table-cell;
        padding: 2px 2px 2px 2px!important;

    }
    tr,td,th {
       line-height:1.0;
       vertical-align: top;
   }
   .table2 tr, .table2 td , .table2 th{
    border: 0px!important;
}

td .fix {
    width: 200px;
}
}
</style><html>
<head>
    {{-- <title><?php echo 'SPPD' . ' ' . $st->obrik->nama; ?></title> --}}
</head>
<body onload="window.print()">
    <div class="page">
        <table class="table3" style="align:center">
            <tbody>
                <tr>
                    <td width="50%"></td>
                    <td style="text-align:center;" width="50%">
                        <table class="table2">
                            <tr>
                                <td></td><td>SPPD No.</td><td>: {{ "700.1.1/".$penugasan['noSurat']."/03"."/". Carbon\Carbon::parse($penugasan['tanggalAwalPenugasan'])->translatedFormat('Y') }} </td>
                            </tr>
                            <tr>
                                <td></td><td>Berangkat dari</td><td></td>
                            </tr>
                            <tr>
                                <td></td><td>(Tempat Kedudukan)</td><td>: Sragen</td>
                            </tr>
                            <tr>
                                <td></td><td>Pada tanggal</td><td>: {{ Carbon\Carbon::parse($penugasan['tanggalAwalPenugasan'])->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td></td><td>Ke</td><td style="text-align: justify">:{{ $penugasan['nama_obrik'] }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
    </table>
    <table class="table1" id="tbl" style="align:center; margin-top:15px">
        <tbody>
                <tr>
                    <td width="50%">
                        <table class="table2" >
                            <tr>
                                <td>II.</td><td >Tiba di</td><td> : </td><td style="text-align: justify">{{ $penugasan['nama_obrik'] }}</td>
                            </tr>
                            <tr>
                                <td></td><td>Pada tanggal</td><td> : </td><td>
                                </td>
                            </tr>
                            <tr>
                                <td></td><td class="ttd">Kepala</td><td>:</td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align:center" width="300px">
                        <table class="table2">
                            <tr>
                                <td>Berangkat dari</td><td>: </td><td style="text-align: justify">{{ $penugasan['nama_obrik'] }}</td>
                            </tr>
                            <tr>
                                <td>Ke</td><td>: </td><td>Inspektorat Daerah Kab. Sragen</td>
                            </tr>
                            <tr>
                                <td>Pada tanggal</td><td>: </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="ttd">Kepala</td><td>:</td>
                            </tr>

                        </table>
                         <br><br>
                    </td>
                </tr>
                <tr>
                    <td width="300px">
                        <table class="table2">
                            <tr>
                                <td>III.</td><td>Tiba di</td><td>:</td>
                            </tr>
                            <tr>
                                <td></td><td>Pada tanggal</td><td>:</td>
                            </tr>
                            <tr>
                                <td></td><td class="ttd">Kepala</td><td>:</td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align:center" width="300px">
                        <table class="table2">
                            <tr>
                                <td>Berangkat dari</td><td>:</td>
                            </tr>
                            <tr>
                                <td>Ke</td><td>:</td>
                            </tr>
                            <tr>
                                <td>Pada tanggal</td><td>:</td>
                            </tr>
                            <tr>
                                <td class="ttd">Kepala</td><td>:</td>
                            </tr>

                        </table>
                         <br><br>
                    </td>
                </tr>
                <tr>
                    <td width="300px">
                        <table class="table2">
                            <tr>
                                <td>IV.</td><td>Tiba di</td><td>:</td>
                            </tr>
                            <tr>
                                <td></td><td>Pada tanggal</td><td>:</td>
                            </tr>
                            <tr>
                                <td></td><td class="ttd">Kepala</td><td>:</td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align:center" width="300px">
                        <table class="table2">
                            <tr>
                                <td>Berangkat dari</td><td>:</td>
                            </tr>
                            <tr>
                                <td>Ke</td><td>:</td>
                            </tr>
                            <tr>
                                <td>Pada tanggal</td><td>:</td>
                            </tr>
                            <tr>
                                <td class="ttd">Kepala</td><td>:</td>
                            </tr>

                        </table>
                         <br><br>
                    </td>
                </tr>
                <tr>
                    <td width="300px" style="text-align:center"></td>
                    <td style="text-align:center" width="200px">
                        <table class="table2">
                          <tr>
                                <td>V.</td><td>Tiba kembali di</td><td>:Sragen</td>
                            </tr>
                            <tr>
                                <td></td><td>Pada tanggal</td><td>: {{ Carbon\Carbon::parse($penugasan['tanggalAkhirPenugasan'])->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                              <td></td>
                                <td style="text-align:justify" colspan="2">Telah diperiksa dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.<br>
                                </td>
                            </tr>
                        </table>



                        <div class="namainspektur" style="margin-right:110px;margin-top:10px">
                            Inspektur Daerah <br>
                            &nbsp;Kabupaten Sragen
                            <br><br><br><br><br>
                        </div>
                            {{ session('nama_pemimpin') }} <br>
                            <div class="pangkat" style="margin-left: -80px">
                                {{ explode('/',session('pangkat_pemimpin'))[0]}}<br>
                            </div>
                            <div class="nip" style="margin-left: -40px">
                                NIP.{{ session('nip_pemimpin') }} <br>
                            </div>

                         <br>
                    </td>
                </tr>
                <tr >
                    <td colspan="2">
                    <table class="table2">
                        <tr >
                        <td>VI.</td><td> Catatan Lain-lain :</td>
                        </tr>
                    </table>
                    </td>
                </tr>
                <tr >
                    <td colspan="2">
                    <table class="table2">
                        <tr>
                            <td>VII.</td><td> Perhatian :</td>
                        </tr>
                        <tr>
                            <td></td><td style="text-align:justify">Pejabat yang menerbitkan SPPD, Pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta Bendaharawan bertanggungjawab berdasarkan Peraturan-peraturan Keuangan Negara apabila negara mendapatkan  rugi akibat kesalahan, kealpaannya.</td>
                        </tr>
                    </table>
                    </td>
                </tr>
                </table></tbody></div>
    </div>

</body>
