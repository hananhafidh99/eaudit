<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>REKAPITULASI PENILAIAN PERJALANAN DINAS</title>
    <style type="text/css">
        .page {
            width: 215.9mm;
            min-height: 355.6mm;
            padding: 10mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            background: white;
            page-break-after: always;
        }
        table,
        td,
        th {
            vertical-align: top !important;
            text-align: justify;
        }
        h1 {
            text-align: center;
        }
        @page {
            size: legal;
            margin: 20mm auto;

        }
    </style>
</head>
<body>
    @for ($bulan = 1; $bulan <= 12; $bulan++)
        <div class="page">
            @if ($bulan == 1)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN JANUARI Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 2)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN FEBRUARI Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 3)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN MARET Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 4)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN APRIL Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 5)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN MEI Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 6)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN JUNI Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 7)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN JULI Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 8)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN AGUSTUS Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 9)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN SEPTEMBER Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 10)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN OKTOBER Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 11)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN NOVEMBER Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 12)
                <h1> REKAPITULASI PENILAIAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN DESEMBER Tahun {{ session('tahun') }}</h3>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Pemeriksaan</th>
                        <th>Kegiatan Pemeriksaan</th>
                        <th>Obrik Pemeriksaan</th>
                        <th>Anggaran Pemeriksaan</th>
                        <th>Tanggal Pemeriksaan</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $x = 0; ?>
                    @foreach ($penugasan[$bulan] as $k => $v)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $v->jenis_pengawasans_nama }}</td>
                            <td><?php echo isset($v->kegiatan) ? $v->kegiatan : 'Tidak Memiliki anggaran'; ?></td>
                            <td>{{ $v->obriks_nama }}</td>
                            <?php
                            // try {
                            //     $x += $mPenugasan->find($v->id)->hitung;
                            // } catch (\Throwable $th) {
                            //     $x += 0;
                            // }
                            $x+=$v->total;
                            ?>
                            <td>Rp. {{number_format($v->total) }}</td>
                            @if (date('m', strtotime($v->Tanggalsurat)) == date('m', strtotime($v->TanggalAkhir)))
                                <td>{{ date('d', strtotime($v->Tanggalsurat)).' s/d '.Carbon\Carbon::parse($v->TanggalAkhir)->translatedFormat('d F Y') }}
                                </td>
                            @else
                                <td>{{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('d F') .'s/d'.Carbon\Carbon::parse($v->TanggalAkhir)->translatedFormat('d F Y') }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">Total</td>
                        <td>Rp. {{ number_format($x) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endfor

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
