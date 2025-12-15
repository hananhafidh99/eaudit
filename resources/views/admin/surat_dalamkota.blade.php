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
      background-color:coral;
      color: white;
    }
    </style>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <h5>Daftar Surat Tugas dan SPPD </h5>

        <div class="d-flex justify-content-end "><a href="{{ url('surat_dalamKota_create') }}" class="btn btn-success mb-3">Tambah Penugasan</a>
        </div>

        <style type="text/css">
            .pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}
            .pagination>li{display:inline}
            .pagination>li>a,.pagination>li>span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:green;text-decoration:none;background-color:#fff;border:1px solid #ddd}
            .pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px}
         .pagination>li:last-child>a,.pagination>li:last-child>span{border-top-right-radius:4px;border-bottom-right-radius:4px}
         .pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover{z-index:2;color:#23527c;background-color:#eee;border-color:#ddd}
         .pagination>.active>a,.pagination>.active>a:focus,.pagination>.active>a:hover,.pagination>.active>span,.pagination>.active>span:focus,.pagination>.active>span:hover{z-index:3;color:#fff;cursor:default;background-color:#33b35a;border-color:#33b35a}
         .pagination>.disabled>a,.pagination>.disabled>a:focus,.pagination>.disabled>a:hover,.pagination>.disabled>span,.pagination>.disabled>span:focus,.pagination>.disabled>span:hover{color:#777;cursor:not-allowed;background-color:#fff;border-color:#ddd}
        </style>

        <div class="table-responsive">
            <table class="table" style="max-width: 100%;">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="10%" style="margin-left: 10%">No Surat</th>
                    <th width="10%">Tanggal</th>
                    <th width="10%">Petugas</th>
                    <th width="20%">Jenis Pengawasan</th>
                    <th width="20%">Obrik</th>
                    <th width="10%">Unduh ST dan SPPD</th>
                    <th width="10%">Unduh Surat Dinas</th>
                    <th width="10%">Aksi</th>
                  </tr>
                </thead>
                 <tbody>
                    @foreach ($data['data'] as $i => $v)
                    <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $v['noSurat'] }}</td>
                    <td>{{ $v['tanggal'] }}</td>
                    <td>
                        @php
                            $v['pegawai'] = explode('@@',$v['pegawai']);
                        @endphp
                        <ol>
                            @foreach ($v['pegawai'] as $k => $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ol>
                    </td>
                    <td>{{ $v['jenisPengawasan'] }}</td>
                    <td>{{ $v['obrik'] }}</td>
                    <td scope="row">
                        <a href="{{ url('surat_dalamKota/ST/'.$v['id']) }}"  target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                        <a href="{{ url('surat_dalamKota/suratDinas/'.$v['id']) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                        <a href="{{ url('surat_dalamKota/sppd/'.$v['id']) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                        <a href="{{ url('surat_dalamKota/buktipenerimaan/'.$v['id']) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                    </td>
                    <td>
                        <a href="{{ url('surat_dalamKota/SD/'.$v['id']) }}"  target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                    </td>
                    <td scope="row">
                        <a href="{{ url('surat_dalamKota/'.$v['id'].'/edit') }}"  class="btn btn-warning"> <i class="fas fa-eye"></i></a>
                        <a href="{{ url('perjalananDalam/suratDinas/'.$v['id']) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                    </tr>
                <?php $i++; ?>
                @endforeach
                </tbody>
                </table>
                @if ($data['links'])
                <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end" style="margin-top: 20px">
                        @foreach ($data['links'] as $item)
                        <li class="page-item {{ $item['active']?'active':'' }}"><a class="page-link" href="{{ $item['url2'] }}">{!! $item['label'] !!}</a></li>
                        @endforeach
                </ul>
            </nav>
            @endif



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
