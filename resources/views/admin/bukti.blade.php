<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Penerimaan</title>
    <link href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css') }}"
        rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('sneat-1.0.0/assets/css/style3.css') }}" />
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
    </style>
</head>

<body onload="window.print()">
    <!-- Container START -->
    <div id="colres">
        <div class="disp">
            <h2 class='judul mt-5'>DAFTAR BUKTI PENERIMAAN UANG PERJALANAN DINAS DALAM DAERAH<br>
                TAHUN ANGGARAN {{ \Carbon\Carbon::parse($penugasan['tanggalAwalPenugasan'])->format('Y') }}<br>Kode
                Rekening {{ $penugasan['norek'] }}</h2>
        </div><br>
        <div>
            <table border='0'>
                <tr>
                    <td>Diterima Dari</td>
                    <td>:</td>
                    <td>Inspektorat Kabupaten Sragen</td>
                </tr>
                <tr>
                    <td>Uang sebesar</td>
                    <td>:</td>
                    <td>Tersebut dibawah ini</td>
                </tr>
                <tr>
                    <td>Untuk &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</td>
                    <td> : </td>
                    <td> {{ $penugasan['nama_jenispengawasan'] }} ke {{ $penugasan['nama_obrik'] }}</td>
                </tr>
                <tr>
                    <td>Tanggal Mulai </td>
                    <td>:</td>
                    <td>{{ Carbon\Carbon::parse($penugasan['tanggalAwalPenugasan'])->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Tanggal Akhir</td>
                    <td>:</td>
                    <td>{{ Carbon\Carbon::parse($penugasan['tanggalAkhirPenugasan'])->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Atas nama</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div>
            <table class="table1" id="tbl" style="align:center">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>JABATAN DALAM TIM</th>
                        <th style="width:50px;">JUMLAH HARI</th>
                        <th>PERHARI</th>
                        <th>JUMLAH</th>
                        <th>NO REKENING</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // $namapegawai = explode('@@',$penugasan['daftar_pegawai']);
                        $total = 0;
                        $namapegawai = $penugasan['detail_petugas'];
                        $no = 1;
                    @endphp
                    @foreach ($namapegawai as $k => $v)

                        @if ($v['Hari'] > 0)
                            <tr>
                                <td style='text-align:center;'>{{ $no++ }}</td>
                                <td style='text-align:left;'>{{ $v['namapegawai'] }}</td>
                                <td style='text-align:left;'>{{ $v['peran'] }}</td>
                                <td style='text-align:left;'>{{ $v['Hari'] }}</td>
                                <td style='text-align:left;'>{{ $v['tarif'] }}</td>
                                <td style='text-align:left;'>{{ $v['Jumlah'] }}</td>
                                <td style='text-align:left;'>{{ $v['Rekening'] }}</td>
                            </tr>
                            @php
                                $total += ($v['Jumlah'])
                            @endphp
                        @endif
                    @endforeach
                    <tr>
                        <td></td>
                        <td colspan="4" style="text-align: center">Jumlah</td>
                        <td>{{ number_format($total) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </center>

        <div class='lt'> Terbilang {{ $penugasan['terbilang'] }}</div>
        <div id="lead" class="e">
            <p class="tgh">Sragen,
                {{ Carbon\Carbon::parse($penugasan['tanggalAkhirPenugasan'])->translatedFormat('d F Y') }}
            </p>
        </div>
        <table>
            <tr>
                <td class="tgh" colspan="4" width="350">
                    <p style="margin-left: -220px">Pengguna Anggaran</p>
                    <br><br><br>
                    <p style="margin-left: -130px">{{session('nama_pemimpin')}}</p>
                    <p style="margin-left: -155px; margin-top:-20px">NIP. {{ session('nip_pemimpin') }}</p>
                </td>
                <td class="tgh" colspan="4" width="300">
                    <p style="margin-left: -50px">PPTK</p>
                    <br><br><br>
                    <p style=" margin-left:3px">
                        {{ $penugasan['pptk_info']['pptk_nama'] }}
                    <p style="margin-left: -5px; margin-top:-15px"> NIP. {{ $penugasan['pptk_info']['pptk_nip'] }}
                    </p>
                </td>

                <td class="tgh" colspan="4" width="300">
                    <p style="margin-left: -30px ">Bendahara Pengeluaran</p> <br><br><br>
                    <p style="margin-left: -10px">{{ session('nama_bendahara') }}</p>
                    <p style="margin-left: -5px; margin-top:-15px">NIP. {{ session('nip_bendahara') }}</p>
                </td>

            </tr>
        </table>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

</html>