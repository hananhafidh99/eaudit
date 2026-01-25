@extends('template')
@section('content')
<style>
#mytable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#mytable td, #mytable th {
  border: 1px solid #ddd;
  padding: 8px;
}

#mytable tr:nth-child(even){background-color: #f2f2f2;}

#mytable tr:hover {background-color: #ddd;}

#mytable th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
        <h5 class="card-header">Daftar Surat Tugas dan SPPD</h5>
        <div class="card-body">
            <form action="{{ url('arsip/cari') }}" method="post" class="mb-4">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label class="form-label" for="nama_obrik">Obrik</label>
                        <input type="text" class="form-control" name="nama_obrik" id="nama_obrik"
                            placeholder="Cari Obrik...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="nama_jenispengawasan">Jenis Pengawasan</label>
                        <input type="text" name="nama_jenispengawasan" id="nama_jenispengawasan" class="form-control"
                            placeholder="Cari Jenis Pengawasan...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="bulan">Bulan</label>
                        <select name="tanggalAwalPenugasan" id="bulan" class="form-select select2">
                            <option value="">Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100" type="submit">Cari Data</button>
                    </div>
                </div>
            </form>

            <table id="mytable"  style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Surat</th>
                    <th>Tanggal</th>
                    <th>Pegawai</th>
                    <th>Jenis Pengawasan</th>
                    <th>Obrik</th>
                    <th>Unduh ST dan SPPD</th>
                    <th>Unduh Bukti Penerimaan</th>
                </tr>
            </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @forelse ($data['data'] as $index => $v)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td style="padding-top: -50px">{{ '700.1.1/' . $v['noSurat'] . '/03/' . \Carbon\Carbon::parse($v['tanggalAwalPenugasan'])->format('Y') }}  <br><br> {{Carbon\Carbon::parse($v['tanggalTerbitPenugasan'])->translatedFormat('d F Y')}}
                                </td>

                        </td>

                                <td>
                                    {{ Carbon\Carbon::parse($v['tanggalAwalPenugasan'])->translatedFormat('d F Y') }} <br>
                                    <small class="text-muted">s/d</small> <br>
                                    {{ Carbon\Carbon::parse($v['tanggalAkhirPenugasan'])->translatedFormat('d F Y') }}
                                </td>
                                <td>
                                    @php
                                        $namapegawai_list = is_array($v['daftar_pegawai']) ? $v['daftar_pegawai'] : explode('@@', $v['daftar_pegawai']);
                                    @endphp
                                    <ol>
                                        @foreach ($namapegawai_list as $item)
                                            <li> {{ $item }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>{{ $v['nama_jenispengawasan'] }}</td>
                                <td>{{ $v['nama_obrik'] }}</td>
                                <td>
                                        <a href="{{ url('surat_dalamKota/ST/' . $v['id']) }}"
                                            class="btn btn-sm btn-outline-danger mb-2" target="_blank" title="Surat Tugas">
                                            <i class="bx bxs-file-pdf"></i> ST
                                        </a>
                                        <a href="{{ url('surat_dalamKota/SD/' . $v['id']) }}"
                                            class="btn btn-sm btn-outline-danger mb-2" target="_blank" title="Surat Dinas">
                                            <i class="bx bxs-file-pdf"></i> SD
                                        </a>
                                        <a href="{{ url('surat_dalamKota/sppd/' . $v['id']) }}"
                                            class="btn btn-sm btn-outline-danger" target="_blank" title="SPPD">
                                            <i class="bx bxs-file-pdf"></i> SPPD
                                        </a>
                                </td>
                                <td>
                                    <a href="{{ url('surat_dalamKota/buktipenerimaan/' . $v['id']) }}"
                                        class="btn btn-sm btn-outline-primary" target="_blank" title="Bukti Penerimaan">
                                        <i class="bx bx-receipt"></i> Bukti
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Only init select2 if it exists and logic requires it.
            // Assuming theme bootstrap-5 if available, else bootstrap4 or default
            if ($('.select2').length > 0) {
                $('.select2').select2({
                    theme: 'bootstrap-5', // Assuming Sneat uses BS5 theme for select2
                    width: '100%'
                });
            }
        });
    </script>
@endsection
