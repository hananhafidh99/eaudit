<table>
    <thead>
        <tr>
            <th colspan="7" style="text-align: center; font-weight: bold; font-size: 14px;">
                REKAPITULASI PENILAIAN PERJALANAN DINAS {{ $tahun }}
            </th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center; font-weight: bold; font-size: 14px;">
                @if($isYearly)
                    {{ strtoupper($bulan) }}
                @else
                    BULAN {{ $bulan }}
                @endif
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
        @php
            $no = 1;
            $months = [
                1 => 'JANUARI',
                2 => 'FEBRUARI',
                3 => 'MARET',
                4 => 'APRIL',
                5 => 'MEI',
                6 => 'JUNI',
                7 => 'JULI',
                8 => 'AGUSTUS',
                9 => 'SEPTEMBER',
                10 => 'OKTOBER',
                11 => 'NOVEMBER',
                12 => 'DESEMBER'
            ];

            // If Yearly, iterate 1-12. If Monthly, just iterate the single group present.
            // Actually, if Monthly, $groupedData might have key X.
            // Let's unify: If Yearly, loop 1..12.
            // If Monthly, groupedData has 1 key. Loop that.
        @endphp

        @if($isYearly)
            @foreach($months as $monthIndex => $monthName)
                @if(isset($groupedData[$monthIndex]))
                    <tr>
                        <td colspan="7"
                            style="font-weight: bold; background-color: #f0f0f0; border: 1px solid #000000; text-align: left; padding-left: 10px;">
                            BULAN {{ $monthName }}
                        </td>
                    </tr>
                    @foreach($groupedData[$monthIndex] as $item)
                        <tr>
                            <td style="border: 1px solid #000000; text-align: center;">{{ $no++ }}</td>
                            <td style="border: 1px solid #000000; text-align: left;">{{ $item->noSurat }}</td>
                            <td style="border: 1px solid #000000; text-align: left;">{{ $item->jenisPemeriksaan }}</td>
                            <td style="border: 1px solid #000000; text-align: left;">{{ $item->kegiatan }}</td>
                            <td style="border: 1px solid #000000; text-align: left;">{{ $item->obrik }}</td>
                            <td style="border: 1px solid #000000; text-align: left;">{{ $item->anggaran }}</td>
                            <td style="border: 1px solid #000000; text-align: center;">{{ $item->tanggal }}</td>
                        </tr>
                    @endforeach
                @else
                    <!-- Optional: Show empty month header or skip? User said "Hingga Desember".
                                    If I skip empty months, it's safer for layout cleanliness.
                                    However, sorting is guaranteed by 1..12 loop.
                                    If user wants "Januari... Februari... ... Desember" structure regardless of data,
                                    I should uncomment below. But usually "Rekap" skips empty.
                                    For now, I only show if data exists, BUT loop order 1..12 ensures Jan comes before Feb.
                               -->
                @endif
            @endforeach
        @else
            <!-- Monthly View (Single Group) -->
            @foreach($groupedData as $monthIndex => $items)
                @foreach($items as $item)
                    <tr>
                        <td style="border: 1px solid #000000; text-align: center;">{{ $no++ }}</td>
                        <td style="border: 1px solid #000000; text-align: left;">{{ $item->noSurat }}</td>
                        <td style="border: 1px solid #000000; text-align: left;">{{ $item->jenisPemeriksaan }}</td>
                        <td style="border: 1px solid #000000; text-align: left;">{{ $item->kegiatan }}</td>
                        <td style="border: 1px solid #000000; text-align: left;">{{ $item->obrik }}</td>
                        <td style="border: 1px solid #000000; text-align: left;">{{ $item->anggaran }}</td>
                        <td style="border: 1px solid #000000; text-align: center;">{{ $item->tanggal }}</td>
                    </tr>
                @endforeach
            @endforeach
        @endif
    </tbody>

</table>