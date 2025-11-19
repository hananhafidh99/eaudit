@extends('admin.template')
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
      background-color:deepskyblue;
      color: white;
    }
    </style>
    <h5>Bukti Penerimaan</h5>

    <table id="mytable"  style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                {{-- <th>No Surat</th> --}}
                <th>Tanggal</th>
                <th>Pegawai</th>
                <th>Jenis Pengawasan</th>
                <th>Obrik</th>
                {{-- <th>Kegiatan</th> --}}
                <th>Biaya</th>
                <th>Unduh Bukti Penerimaan</th>
                <th>Unduh A2</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0" id="tbody">
            @foreach ($penugasan as $index => $v)
                <tr>
                    <td >{{ $index + $penugasan->firstItem() }}</td>
                    {{-- <td style="padding-top: -50px" >{{ "094/".$v->noSurat."/03"."/".session('tahun') }} <br><br> {{Carbon\Carbon::parse($v->tanggalterbitSurat)->translatedFormat('d F Y')}}</td> --}}
                    <td class="kolom">{{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('d M Y') }} s/d {{ Carbon\Carbon::parse($v->TanggalAkhir)->translatedFormat('d M Y') }}</td>
                    <td width="300px"><ol style="margin-left: -15px">
                        @foreach ($v->surat()->get()->sortBy('id_peran') as $item)
                <li>
                 <?php echo isset($item->pegawai->nama_karyawan)?$item->pegawai->nama_karyawan:' ' ?>
                </li>
                @endforeach
                </ol></td>
                <td><?php echo isset($v->jenis->nama)?$v->jenis->nama:' ' ?></td>
                <td><?php echo isset($v->obrik->nama)?$v->obrik->nama:' ' ?></td>
                <td>
                    {{ number_format($v->hitung) }}

                    </td>
                    <td><a href="{{ url('berkas/bukti/'.$v->id) }}" target="_blank"><i  class="far fa-file-pdf fa-2x" style="margin-left: 20px"></i></a></td>
                    <td>
                        <a href="{{ url('berkas/A2/'.$v->id) }}" target="_blank"><i  class="far fa-file-pdf fa-2x" style="margin-left: 20px"></i></a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>

        {{-- <table id="mytable"  style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Surat</th>
                    <th>Tanggal</th>
                    <th>Pegawai</th>
                    <th>Jenis Pengawasan</th>
                    <th>Obrik</th>
                    <th>Kegiatan</th>
                    <th>Biaya</th>
                    <th>Unduh Bukti Penerimaan</th>
                    <th>Unduh A2</th>
                </tr>
            </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($penugasan as $index => $v)
          <tr>
              <td>{{ $index + $penugasan->firstItem() }}</td>
              <td>{{ "094/".$v->noSurat."/03"."/".session('tahun') }} <br><br> {{Carbon\Carbon::parse($v->tanggalterbitSurat)->translatedFormat('d F Y')}}</td>
              <td class="kolom">{{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('d M Y') }} s/d {{ Carbon\Carbon::parse($v->TanggalAkhir)->translatedFormat('d M Y') }}</td>
              <td width="300px"><ol style="margin-left: -15px">
               @foreach ($v->surat()->get()->sortBy('id_peran') as $item)
                <li>
                 <?php echo isset($item->pegawai->nama_karyawan)?$item->pegawai->nama_karyawan:' ' ?>
                </li>
                @endforeach
                </ol></td>
              <td><?php echo isset($v->jenis->nama)?$v->jenis->nama:' ' ?></td>
              <td><?php echo isset($v->obrik->nama)?$v->obrik->nama:' ' ?></td>
              <td> <?php echo isset($v->anggaran)?$v->anggaran->kegiatan:'Tidak ada kegiatan' ?></td>
              <td>
              {{ number_format($v->hitung) }}

              </td>
              <td><a href="{{ url('berkas/bukti/'.$v->id) }}" target="_blank"><i  class="far fa-file-pdf fa-2x" style="margin-left: 20px"></i></a></td>
              <td>
                  <a href="{{ url('berkas/A2/'.$v->id) }}" target="_blank"><i  class="far fa-file-pdf fa-2x" style="margin-left: 20px"></i></a>
              </td>
              @endforeach
          </tr>
        </tbody>
      </table> --}}
      <div class="d-flex mt-3 mr-5 justify-content-end">{{ $penugasan->links() }}</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
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
    });
        </script>
@endsection
