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
<h5>Daftar Surat Tugas dan SPPD
        <form action="{{ url('arsip/cari') }}" method="post">
            @csrf
            @method('post')
            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Obrik</label>
                    <input type="text" class="form-control" name="nama_obrik" >
                </div>
                <div class="col-3 mt-3">
                    <label for="">Jenis Pengawasan</label>
                    <input type="text" name="nama_jenispengawasan" class="form-control" >
                </div>
                <div class="col-3 mt-3">
                    <label for="">Bulan</label>
                    <select name="tanggalAwalPenugasan" id="bulan" class="form-control mt-2 filter">
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
               <div class="col-3 mt-3">
                    <label for="">Sub Kegiatan</label>

                </div>
            </div>

            <button class="btn btn-info mt-3" type="submit">SUBMIT</button>
        </form>

    </h5>


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
            <tbody class="table-border-bottom-0">
                <?php $no = 1; ?>
                @foreach ($data['data'] as $index => $v)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ '700.1.1/' . $v['noSurat'] . '/03' . '/' . date('Y') }}</td>
                        <td class="kolom">{{ Carbon\Carbon::parse($v['tanggalAwalPenugasan'])->translatedFormat('d M Y') }} s/d {{ Carbon\Carbon::parse($v['tanggalAkhirPenugasan'])->translatedFormat('d M Y') }}</td>
                            @php
                                // $namapegawai = explode('@@',$penugasan['daftar_pegawai']);
                                   $namapegawai = $v['daftar_pegawai'];
                                   $v['daftar_pegawai'] = explode('@@',$v['daftar_pegawai']);
                            @endphp
                            <td>
                                <ol>
                                @foreach ($v['daftar_pegawai'] as $k => $item)
                                <li>{{ $item }}</li>
                                @endforeach
                                </ol>
                            </td>
                        <td>{{ $v['nama_jenispengawasan'] }}</td>
                        <td>{{ $v['nama_obrik'] }}</td>
                        <td scope="row">
                            <a href="{{ url('surat_dalamKota/ST/'.$v['id']) }}"  target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                            <a href="{{ url('surat_dalamKota/SD/'.$v['id']) }}"  target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                        <a href="{{ url('surat_dalamKota/sppd/'.$v['id']) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                    </td>
                    <td>
                        <a href="{{ url('surat_dalamKota/buktipenerimaan/'.$v['id']) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#obrik").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Obrik"
            });
            $("#jenis_pengawasan").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Jenis Pengawasan"
            });
            $("#bulan").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Bulan"
            });
            $("#tahun23").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Bulan"
            });
            $("#tahun").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Anggaran Kegiatan"
            });
            $("#id_irban").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Irban "
            });
        });
    </script>
@endsection
