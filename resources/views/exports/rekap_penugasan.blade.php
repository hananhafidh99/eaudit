<table>
    <thead>
        <tr>
            <th colspan="7" style="text-align: center; font-weight: bold; font-size: 14px;">
                REKAPITULASI PENILAIAN PERJALANAN DINAS {{ $tahun }}
            </th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center; font-weight: bold; font-size: 14px;">
                BULAN {{ $bulan }}
            </th>
        </tr>
        <tr>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">NO</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">NO SURAT</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">Jenis Pemeriksaan</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">Kegiatan</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">Obrik</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">Anggaran</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $item)
            <tr>
                <td style="border: 1px solid #000000; text-align: center;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000000; text-align: left;">{{ $item->noSurat }}</td>
                <td style="border: 1px solid #000000; text-align: left;">{{ $item->jenisPemeriksaan }}</td>
                <td style="border: 1px solid #000000; text-align: left;">{{ $item->kegiatan }}</td>
                <td style="border: 1px solid #000000; text-align: left;">{{ $item->obrik }}</td>
                <td style="border: 1px solid #000000; text-align: left;">{{ $item->anggaran }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $item->tanggal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>