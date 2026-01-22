<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
        .page {
            width: 210mm;
            min-height: 297mm;
                padding-right: 12mm;
                padding-left: 11mm;
                padding-top: 12mm;
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
                    word-wrap:break-word;
                }
               .table1 tr, .table1 td, .table1 th {
                    border: table-cell;
                    border: 1px  solid #444;
                }
                tr,td,th {
                    vertical-align: top!important;
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
                    height: 300px!important;
                }
                .disp {
                    text-align: center;
                    padding: 1.5rem 0;
                    margin-bottom: .5rem;
                }
                .logo{
                    width: 110px;
                    height: 110px;
                    z-index: -1;
                    float : left;
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
                    height:1px;
                    background:#717171;
                    border-bottom:1px solid #313030;
                }

                .separator2 {
                    height:1.5px;
                    background:#717171;
                    margin-top: -20px;
                    border-bottom:3px solid #313030;
                }
                .jdl {
                        margin-top: -15px;
                        font-size: 14pt!important;
                    }
                    .judul {
            font-size: 16pt;
            font-weight: bold;
            margin-top: 15px;
        }

                    @media print {
      html, body {
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
                        line-height:1.3;
                        align:center;
                        font-size: 12pt;
                        color: #212121;
                        table-layout: fixed;
                        word-wrap:break-word;
                    }
                    .table1 tr, .table1 td , .table1 th{
                        border: table-cell;
                        border: 1px  solid #444;
                        padding: 0px 0px 5px 5px!important;

                    }
                    .table1 td:first-child {
                        width: 20px;
                    }
                    tr,td,th {
                        vertical-align: top!important;
                    }
                    #lbr {
                        font-size: 20pt;
                    }
                    .isi {
                        height: 100px!important;
                    }
                    .tgh {
                        text-align: center;
                    }
                    .rata {
                        text-align: justify;
                    }
                    .disp {
                        text-align: center;
                        margin-top: -20px;
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
                        font-size: 20pt!important;
                        font-weight: bold;
                        text-transform: uppercase;
                        margin: -10px 0 -20px 0;
                    }
                    .up {
                        margin-top: 10px;
                        text-align: center;
                        font-size: 16pt!important;
                        font-weight: bold;
                    }
                    .status {
                        font-size: 12pt!important;
                        font-weight: normal;
                        margin-bottom: -.1rem;
                    }
                    #alamat {
                        margin-top: -25px;
                        font-size: 10pt;
                    }
                    .jdl {
                        margin-top: -15px;
                        font-size: 14pt!important;
                    }
                    #lbr {
                        font-size: 17px;
                        font-weight: bold;
                    }
                    .separator {
                        border-bottom: 5px solid #616161;
                        margin-top: -20px;
                    }

                    .judul {
                font-size: 14pt;
                font-weight: bold;
                margin-bottom: 0px;
                margin-top: 5px;
                margin-left: 85px;
            }

            .nomor {
                font-size: 12pt;
                font-weight: bold;
                margin-left: 85px;
            }

            #namapegawai{
                line-height: 20px;
                margin-top: 10px;
                max-width: 350px;
            }
            #nipegawai{
                line-height: 20px;
                width: 180px;
                max-width: 250px;
            }
            #peran{
                line-height: 20px;
                width: 200px;
                max-width: 250px;
            }
            .ttd {
                text-align: center;
            }

                }
            </style>
</head>

<body onload="window.print()">
    <div class="page">
        <div id="colres" >
      @php
          $f = session('brand_logo');
      @endphp
            <div class="disp" >
            <img class="logo" style="width: 90px;height:90px;margin-top:15px; margin-left:20px" src="{{ asset('storage/logo/'.$data['logo']) }}" />
                <h6 class="up">{{ $data['instansi'] }} </h6>
                <h5 class="up" id="nama">{{ $data['skpd'] }}</h5><br />
                <h6 class="status">{{ $data['alamat'] }} Telp/Fax {{ $data['telp'] }}</h6><span
                    id="alamat">{{ $data['website'] }} E-mail: <u><a href="">{{ $data['email'] }}</a></u> Kode
                    Pos: {{ $data['kodepos'] }}</span>
            </div>
            <div class="separator2"></div><div class="separator1"></div><div id='surat'></div>

            <center>
                <p></p>
                <u>
                    <p class="judul">SURAT PERINTAH TUGAS</p>
                </u>
                <p class="nomor">No. {{ $data['nomorsurat'].$penugasan['noSurat'] . '/03' . '/'. Carbon\Carbon::parse($penugasan['tanggalAwalPenugasan'])->translatedFormat('Y') }} </p>
            </center>

            <p style="text-indent: 3cm";>Inspektur Daerah Kabupaten Sragen memberikan tugas kepada :
                <div>
                   <table class="table1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th class="text-center">NAMA</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">PERAN</th>
                            </tr>
                        </thead>
<tbody>
                                @php
                                // $namapegawai = explode('@@',$penugasan['daftar_pegawai']);
                                   $namapegawai = $penugasan['detail_petugas'];
                                @endphp
                                @foreach ($namapegawai as $k => $v)
                                    <tr>
                                    <td style='text-align:center;'>{{ $k + 1 }}</td>
                                <td id="namapegawai" style="width: 300px " >{{ $v['namapegawai'] }}</td>
                                    <td id="nipegawai" style="text-align:center">{{ $v['nip'] }}</td>
                                    <td id="peran"> {{ $v['peran'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    <table border='0' valign='bottom' style="margin-top: 10px">
                        <tr>
                            <td style='width:180px' >Untuk melakukan</td>
                            <td> : </td>
                            <td class='rata'>
                            {{ $penugasan['nama_jenispengawasan'] }} ke {{ $penugasan['nama_obrik'] }}
                             </td>
                        </tr>
                        <tr>
                            <td style='width:100px'>Tanggal </td>
                            <td> : </td>
                            <td>
                              @if (date('d m',strtotime($penugasan['tanggalAwalPenugasan'])) == date('d m',strtotime($penugasan['tanggalAkhirPenugasan'])))
                              {{ Carbon\Carbon::parse($penugasan['tanggalAwalPenugasan'])->translatedFormat('d F Y') }}
                              @else
                              {{ Carbon\Carbon::parse($penugasan['tanggalAwalPenugasan'])->translatedFormat('d F') }} s/d
                              {{ Carbon\Carbon::parse($penugasan['tanggalAkhirPenugasan'])->translatedFormat('d F Y') }}
                              @endif
                            </td>

                        </tr>
                    </table>
                    <div>
                        <p style='margin-top:10px'>Demikian untuk dilaksanakan dengan penuh tanggung jawab</p>
                        <div>
                            <table class="ttd" align="right">
                                <tr>
                                    {{-- <td>
                                        INSPEKTUR DAERAH <br>
                                        KABUPATEN SRAGEN <br>
                                        <br><br><br>
                                    </td> --}}
                                    <div class="namainspektur" style="margin-left: 440px">
                                        Sragen,{{ Carbon\Carbon::parse($penugasan['tanggalTerbitPenugasan'])->translatedFormat('d F Y') }} <br>
                                        Plt. Inspektur Daerah <br>
                                        Kabupaten Sragen <br>
                                        <br><br><br>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="tddinspektur" style="margin-left: 440px;">
                                     <u>{{ session('nama_pemimpin') }} <br></u>
                                        {{ explode('/',session('pangkat_pemimpin'))[0]}}<br>
                                    NIP.{{ session('nip_pemimpin') }} <br>
                                    </div>
                                </tr>
                            </table>
                        </div>
                        {{-- <div style="height: 280px;">
			<p> TEMBUSAN :
                <ol style="margin-left: -10px">
                <li>Bupati Sragen</li>
                </ol>
            </P>

            </div> --}}

                    </div>
                </div>
            <!-- Optional JavaScript; choose one of the two! -->
            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>
            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->



</body>

</html>
