<style type="text/css">
    .page {
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
        margin: 0;
    }

    .table1 {
        background: #fff;
        padding: 0px 0px 0px 5px;
        border-collapse: collapse;
        table-layout: fixed;
        word-wrap: break-word;
    }

    .table1 tr,
    .table1 td,
    .table1 th {
        border: table-cell;
        border: 1px solid #444;
    }

    tr,
    td,
    th {
        vertical-align: top !important;
    }

    #surat {
        width: auto;
        position: relative;
        margin: 0 0 0 60%;
    }

    .tglsurat {
        width: auto;
        position: relative;
        margin: 0 0 0 60%;
    }

    #right {
        border-right: none !important;
    }

    #left {
        border-left: none !important;
    }

    .isi {
        height: 300px !important;
    }

    .disp {
        text-align: center;
        padding: 1.5rem 0;
        margin-bottom: .5rem;
    }

    .logo {
        width: 90px;
        height: 90px;
        z-index: -1;
        float: left;
    }

    .logodisp {
        width: 110px;
        height: 110px;
        margin: 10 10 10 10;
        position: absolute;
        left: 50px;
        top: 25px;
        z-index: -1;
    }

    #lead {
        width: auto;
        position: relative;
        margin: 5px 0 0 75%;
    }

    .lead {
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: -10px;
    }

    .tgh {
        text-align: center;
    }

    .rata {
        text-align: justify;
    }

    #nama {
        font-size: 2.1rem;
        margin-bottom: -1rem;
    }

    #alamat {
        font-size: 16px;
    }

    .up {
        text-transform: uppercase;
        margin: 0;
        line-height: 2.2rem;
        font-size: 1.5rem;
    }

    .status {
        margin: 0;
        font-size: 1.3rem;
        margin-bottom: .5rem;
    }

    #lbr {
        font-size: 20px;
        font-weight: bold;
    }

    .separator1 {
        height: 1px;
        background: #717171;
        border-bottom: 1px solid #313030;
    }

    .separator2 {
        height: 1.5px;
        background: #717171;
        margin-top: -20px;
        border-bottom: 5px solid #313030;
    }

    .jdl {
        margin-top: -15px;
        font-size: 14pt !important;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
        }

        /* ... the rest of the rules ... */
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }

        nav {
            display: block;
        }

        .table1 {
            line-height: 1.3;
            align: center;
            font-size: 12pt;
            color: #212121;
            table-layout: fixed;
            word-wrap: break-word;
        }

        .table1 tr,
        .table1 td,
        .table1 th {
            width: 350px;
            border: table-cell;
            border: 1px solid #444;
            padding: 0px 5px 5px 5px !important;

        }

        .table1 td:first-child {
            width: 20px;
        }

        tr,
        td,
        th {
            vertical-align: top !important;
        }

        #lbr {
            font-size: 20pt;
        }

        .isi {
            height: 100px !important;
        }

        .tgh {
            text-align: center;
        }

        .rata {
            text-align: justify;
        }

        .disp {
            text-align: center;
            margin-top: -25px;
        }

        .logodisp {
            position: absolute;
            left: 50px;
            top: 25px;
            z-index: -1;

            width: 50px;
            height: 50px;
            margin: .5rem 0 0 .5rem;
        }

        #surat {
            width: auto;
            position: relative;
            margin: 0 0 0 60%;
        }

        .tglsurat {
            width: auto;
            position: relative;
            margin: 0 0 0 50%;
        }

        #lead {
            width: auto;
            position: relative;
            margin: -15px 0 0 60%;
        }

        .lead {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: -10px;
        }

        #nama {
            font-size: 20pt !important;
            font-weight: bold;
            text-transform: uppercase;
            margin: -10px 0 -20px 0;
        }

        .up {
            margin-top: 10px;
            text-align: center;
            font-size: 16pt !important;
            font-weight: bold;
        }

        .status {
            font-size: 12pt !important;
            font-weight: normal;
            margin-bottom: -.1rem;
        }

        #alamat {
            margin-top: -15px;
            font-size: 10pt;
        }

        .jdl {
            margin-top: -15px;
            font-size: 14pt !important;
        }

        #lbr {
            font-size: 17px;
            font-weight: bold;
        }

        .separator {
            border-bottom: 5px solid #616161;
            margin-top: -20px;
        }

        #tujuan {
            width: 100px;
            max-width: 350px;
        }

    }
</style>

<body onload="window.print()">

    @php
        $namapegawai = $penugasan['detail_petugas'];
    @endphp

    @foreach ($namapegawai as $k => $v)

        @if ($v['Hari'] > 0)

            <div class="page">
                <div id="colres">
                    <div class="disp">
                        @php
                            $f = session('brand_logo');
                        @endphp
                        @if (isset($f))
                            <img class="logo" src="{{ asset('storage/logo/' . $f) }}" />
                            <h6 class="up">{{ $data['instansi'] }}</h6>
                            <h5 class="up" id="nama">{{ $data['skpd'] }}</h5><br />
                            <h6 class="status">{{ $data['alamat'] }}</h6><span id="alamat">{{ $data['website'] }} E-mail:
                                <u>{{ $data['email'] }}</u> Kode Pos {{ $data['kodepos'] }}</span>
                        @endif
                    </div>
                    <div class="separator2"></div>
                    <div class="separator1"></div>
                    <div id='surat'><br>
                        <table border='0'>
                            <tr>
                                <td>Lembar ke &emsp;</td>
                                <td> : </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Kode No. &emsp;</td>
                                <td> : </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Nomor &emsp;</td>
                                <td> : </td>
                                <td>{{ $data['nomorsurat'] . $penugasan['noSurat'] . '/03' . '/' . date('Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    <h6 class="up">SURAT PERINTAH PERJALANAN DINAS</h6>
                    <div>
                        <table class="table1" id="tbl" style="align:center">
                            <tbody>
                                <tr>
                                    <td class="tgh" width="20px">1</td>
                                    <td width="300px">Pejabat Pembuat Komitmen</td>
                                    <td>{{ session('nama_pemimpin') }}</td>
                                </tr>
                                <tr>
                                    <td class="tgh">2</td>
                                    <td>Nama/NIP pegawai yang diperintah</td>
                                    <td>{{ $v['namapegawai'] }} <br> {{ $v['nip'] }}</td>
                                </tr>
                                <tr style="border-bottom: none;border-top: none;">
                                    <td class="tgh" rowspan="3">3</td>
                                    <td style="border-bottom: none;border-top: none;">a. Pangkat dan Golongan</td>
                                    <td style="border-bottom: none;border-top: none;">a. {{ $v['pangkat'] }}
                                <tr style="border-bottom: none;border-top: none;">
                                    <td style="border-bottom: none;border-top: none;">b. Jabatan</td>
                                    <td style="border-bottom: none;border-top: none;">b. {{ $v['jabatan'] }} </td>
                                </tr>
                                <tr style="border-bottom: none;border-top: none;">
                                    <td style="border-bottom: none;border-top: none;">c. Tingkat menurut peraturan Perjalanan
                                        Dinas</td>
                                    <td style="border-bottom: none;border-top: none;">c. Perjalanan Dinas Dalam Daerah</td>
                                </tr>
                                <tr>
                                    <td class="tgh">4</td>
                                    <td>Maksud Perjalanan</td>
                                    <td style="max-width: 500px"> Perjalanan Dinas {{ $penugasan['nama_jenispengawasan'] }} ke
                                        {{ $penugasan['nama_obrik'] }} </td>
                                </tr>
                                <tr>
                                    <td class="tgh">5</td>
                                    <td>Alat angkutan yang dipergunakan</td>
                                    <td>Kendaraan Roda Empat</td>
                                </tr>
                                <tr>
                                    <td class="tgh">6</td>
                                    <td>a. Tempat berangkat<br>b. Tempat tujuan</td>
                                    <td>Inspektorat Daerah Kab. Sragen<br> {{ $penugasan['nama_obrik'] }}</td>
                                </tr>
                                <tr>
                                    <td class="tgh">7</td>
                                    <td>a. Lamanya Perjalanan Dinas<br>b. Tanggal berangkat <br> c. Tanggal harus kembali</td>
                                    <td>{{ $v['Hari'] }}
                                        hari<br>{{ Carbon\Carbon::parse($v['tanggalPemeriksaanAwal'])->translatedFormat('l, d F Y') }}<br>{{ Carbon\Carbon::parse($v['tanggalPemeriksaanAwal'])->addDays($v['Hari'] - 1)->translatedFormat('l, d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tgh">8</td>
                                    <td>Pengikut &emsp; Nama</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="tgh">9</td>
                                    <td>Pembebanan Anggaran :<br>a. Instansi<br>b. Mata Anggaran</td>
                                    <td><br>Inspektorat Daerah Kab. Sragen<br>{{ $penugasan['kegiatan'] }}</td>
                                </tr>
                                <tr>
                                    <td class="tgh">10</td>
                                    <td>Keterangan lain-lain</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br>
                    <div class="tglsurat">
                        <table>
                            <tr>
                                <td>Dikeluarkan di</td>
                                <td> :</td>
                                <td> Sragen</td>
                            </tr>
                            <tr>
                                <td>Pada tanggal</td>
                                <td>:</td>
                                <td>{{ Carbon\Carbon::parse($penugasan['tanggalTerbitPenugasan'])->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                        </table>
                    </div><br>
                    <div class="namainspektur" style="margin-left:360px;margin-top:3px">
                        Inspektur Daerah <br>
                        Kabupaten Sragen
                        <br><br><br><br><br>
                    </div>

                    <div class="tddinspektur" style="margin-left: 360px">
                        {{ session('nama_pemimpin') }} <br>
                    </div>
                    <div class="tddinspektur" style="margin-left: 360px">
                        {{explode('/', session('pangkat_pemimpin'))[0]}}<br>
                    </div>
                    <div class="tddinspektur" style="margin-left: 360px">
                        NIP. {{session('nip_pemimpin')}}<br>
                    </div>


                    </tbody>
                    </table>
                </div>


            </div>
            </div>
        @endif
    @endforeach
</body>