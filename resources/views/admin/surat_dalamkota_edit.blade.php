@extends('template')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


 <div class="alert alert-info" role="alert">
    Edit Data Penugasan
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('surat_dalamKota/'.$penugasanedit['id']) }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <input type="hidden" name="id_surat_tugas" value="{{ $penugasanedit['id'] }}">
                <div class="row">
                <div class="col-3 mt-4">
                   <label>NO SURAT</label>
                </div>
                <div class="col-2 mt-4">
                    <input type="text" value="{{ "700.1.1/" }}" class="form-control" readonly>
                 </div>
                <div class="col-5 mt-4">
                   <input type="text" name="noSurat" value="{{ old('noSurat',$penugasanedit['noSurat']) }}" class="form-control">
                </div>
                 <div class="col-2 mt-4">
                   <input type="text" value="{{ "/03"."/".session('tahun') }}" class="form-control" readonly>
                </div>
            </div>

                <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Jenis Pengawasan </label>
                </div>
                <div class="col-9 mt-3">
                    <select class="form-control"  name="id_jenis_pengawasan" id="jp">
                        <option value="">Pilih</option>
                       @foreach ($jenisPengawasan as $key => $p)
                           <option value="{{ $p['id'] }}" {{ $p['id'] == $penugasanedit['id_jenisPengawasan'] ? 'selected':'' }}>
                            {{ $p['nama_jenispengawasan'] }}
                        @endforeach
                     </select>
                </div>
            </div>

               <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Obrik </label>
                </div>
                <div class="col-9 mt-3">
                    <select class="form-control"  name="id_jenis_pengawasan" id="jp">
                        <option value="">Pilih</option>
                       @foreach ($obrik as $key => $p)
                           <option value="{{ $p['id'] }}" {{ $p['id'] == $penugasanedit['id_obrik'] ? 'selected':'' }}>
                            {{ $p['nama_obrik'] }}
                        @endforeach
                     </select>
                </div>
            </div>

            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Tanggal </label>
                </div>
                <div class="col-3 mt-3">
                    <input type="text" name="Tanggalsurat" class="form-control datepicker" value="{{ old('Tanggalsurat',$penugasanedit['tanggalAwalPenugasan']) }}">
                </div>
                <div class="col-1 mt-4">
                    <label for="">s/d</label>
                </div>
                <div class="col-5 mt-3">
                    <input type="text" name="TanggalAkhir" class="form-control datepicker" id="tp" value="{{ old('TanggalAkhir',$penugasanedit['tanggalAkhirPenugasan']) }}" >
                </div>
            </div>

            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Anggaran Kegiatan </label>
                </div>
                <div class="col-9 mt-3">
                    <select class="form-control"  name="id_anggaran" id="kegiatan">
                        <option value="">Pilih</option>
                         @foreach ($kegiatan as $key => $p)
                        <option value="{{ $p['id'] }}" {{ $p['id']==$penugasanedit['id_anggaran']?'selected':''}}>
                            {{ $p['kegiatan'] }}
                        @endforeach
                     </select>
                </div>
            </div>

            <hr>

            Tim
            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Peran </label>
                </div>
                <div class="col-4 mt-3">
                    <label for="">Pegawai </label>
                </div>
                <div class="col-5 mt-3">
                    <label for="">Tanggal Penugasan </label>
                </div>
            </div>
            <?php $no = 1; ?>
            @foreach ($peran as $item)
            @if ($item['nama_peran'] != 'Anggota')
                <div class="row">
                    <div class="col-3 mt-3">
                        <label for="">{{ $no++ }} {{ $item['nama_peran'] }} </label>
                    </div>
                    <div class="col-4 mt-3">
                        @php
                            $selectname = isset($suratTugas['tugas'][$item['id']]) ? 'ubahtugas' : 'tugas';
                        @endphp
                        @if(isset($suratTugas['tugas'][$item['id']]))
                            <input type="hidden" name="ubahtugas[{{ $suratTugas['tugas'][$item['id']]->id }}][id_peran]" value="{{ $item['id'] }}">
                        @endif
                        <select class="form-control namaPeran"
                            @if(isset($suratTugas['tugas'][$item['id']]))
                                name="ubahtugas[{{ $suratTugas['tugas'][$item['id']]->id }}][id_pegawai]"
                            @else
                                name="tugas[{{ $item['id'] }}][id_pegawai]"
                            @endif
                        >
                            <option value="">Pilih</option>
                            @foreach ($pegawai as $key => $p)
                                @if(isset($suratTugas['tugas'][$item['id']]) && $p['id'] == $suratTugas['tugas'][$item['id']]->id_pegawai)
                                    <option value="{{ $p['id'] }}" selected>{{ $p['nama_pegawai'] }}</option>
                                @else
                                    <option value="{{ $p['id'] }}">{{ $p['nama_pegawai'] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 mt-3">
                        @php
                        if (isset($suratTugas['tugas'][$item['id']])) {
                            $selectedvalue = old('ubahtugas'.'.'.$suratTugas['tugas'][$item['id']]->id.'.tanggalAwalPemeriksaan',$suratTugas['tugas'][$item['id']]->tanggalAwalPemeriksaan);
                            # code...
                        }else {
                            # code...
                            $selectedvalue = old('tugas'.'.'.$item['id'].'.tanggalAwalPemeriksaan');
                        }
                        @endphp
                        {{-- @dd($selectedvalue) --}}
                        <input type="text" @if(isset($suratTugas['tugas'][$item['id']])) name="ubahtugas[{{ $suratTugas['tugas'][$item['id']]->id }}][tanggalAwalPemeriksaan]" @else name="tugas[{{ $item['id'] }}][tanggalAwalPemeriksaan]" @endif class="form-control datepicker2" value="{{ $selectedvalue }}">
                    </div>
                    <div class="col-2 mt-3">
                        @php
                        if (isset($suratTugas['tugas'][$item['id']])) {
                            $selectedvalue = old('ubahtugas'.'.'.$suratTugas['tugas'][$item['id']]->id.'.tanggalAkhirPemeriksaan',$suratTugas['tugas'][$item['id']]->tanggalAkhirPemeriksaan);
                            # code...
                        }else {
                            # code...
                            $selectedvalue = old('tugas'.'.'.$item['id'].'.tanggalAkhirPemeriksaan');
                        }
                        @endphp
                        <input type="text" @if(isset($suratTugas['tugas'][$item['id']])) name="ubahtugas[{{ $suratTugas['tugas'][$item['id']]->id }}][tanggalAkhirPemeriksaan]" @else name="tugas[{{ $item['id'] }}][tanggalAkhirPemeriksaan]" @endif class="form-control datepicker2" value="{{ $selectedvalue }}">
                    </div>
                </div>
            @else
                @for ($i = 1; $i <= 15; $i++)
                @php
                $suratAnggota=$suratTugas['anggota'] ?? [];
                // dd($suratAnggota);
                @endphp
                <div class="row">
                    <div class="col-3 mt-3">
                        <label for="">{{ $item['nama_peran'] }} {{ $i }}</label>
                    </div>
                    <div class="col-4 mt-3">
                        {{-- @dd(`anggota[$item['id']][$i][id_pegawai]`); --}}
                        @php
                            $nametagupi='';
                            $nametagupi = (isset($suratAnggota[$i-1]) && isset($suratAnggota[$i-1]->id))
                                ? 'ubahanggota['.$suratAnggota[$i-1]->id.'][id_pegawai]'
                                : 'anggota['.$item['id'].']['.$i.'][id_pegawai]';
                        @endphp
                        <select class="form-control namaAnggota" name="{{ $nametagupi }}" >
                            <option value="">Pilih</option>
                             @foreach ($pegawai as $key => $p)
                                @if(isset($suratAnggota[$i-1]) && $p['id'] == $suratAnggota[$i-1]->id_pegawai)
                                    <option value="{{ $p['id'] }}" selected>{{ $p['nama_pegawai'] }}</option>
                                @else
                                    <option value="{{ $p['id'] }}">{{ $p['nama_pegawai'] }}</option>
                                @endif
                             @endforeach
                         </select>
                    </div>
                    <div class="col-3 mt-3">
                        @php
                        if (isset($suratAnggota[$i-1])) {
                            $selectedvalue = old('ubahanggota'.'.'.$suratAnggota[$i-1]->id.'.tanggalAwalPemeriksaan',$suratAnggota[$i-1]->tanggalAwalPemeriksaan);
                            # code...
                        }else {
                            # code...
                            $selectedvalue = old('anggota'.'.'.$item['id'].'.'.$i.'.tanggalAwalPemeriksaan');
                        }
                        $tagtglAwalupi = isset($suratAnggota[$i-1]) ? 'ubahanggota['.$suratAnggota[$i-1]->id.'][tanggalAwalPemeriksaan]' : 'anggota['.$item['id'].']['.$i.'][tanggalAwalPemeriksaan]';
                        @endphp
                        <input type="text" name="{{ $tagtglAwalupi }}" class="form-control datepicker2" value="{{ $selectedvalue }}">
                    </div>
                    <div class="col-2 mt-3">
                        @php
                        if (isset($suratAnggota[$i-1])) {
                            $selectedvalue = old('ubahanggota'.'.'.$suratAnggota[$i-1]->id.'.tanggalAkhirPemeriksaan',$suratAnggota[$i-1]->tanggalAkhirPemeriksaan);
                            # code...
                        }else {
                            # code...
                            $selectedvalue = old('anggota'.'.'.$item['id'].'.'.$i.'.tanggalAkhirPemeriksaan');
                        }

                        $tagtglAkhirupi = isset($suratAnggota[$i-1]) ? 'ubahanggota['.$suratAnggota[$i-1]->id.'][tanggalAkhirPemeriksaan]' : 'anggota['.$item['id'].']['.$i.'][tanggalAkhirPemeriksaan]';
                        @endphp
                        <input type="text" name="{{ $tagtglAkhirupi }}" class="form-control datepicker2" value="{{ $selectedvalue }}" >
                   </div>
                </div>
                @endfor
            @endif
            @endforeach
            <hr>

            <div class="row">
                <div class="col-12 mb-3">
                    <label for="">Tanggal Pembuatan Surat  </label>
                    <input type="text" name="tanggalterbitSurat" class="form-control datepicker" value="{{ $penugasanedit['tanggalTerbitPenugasan'] }}">
                </div>
            </div>

             <button class="btn btn-primary">Edit Penugasan</button>





            {{-- <button class="btn btn-danger" id="tombol">Tambah Penugasan</button> --}}









        </form>
    </div>
</div>

  <script>
            $(document).ready(function () {
                $("#jp").select2({
                    placeholder: "Please Select",
                    allowClear:true,
                });

                $("#obrik").select2({
                    placeholder: "Please Select",
                    allowClear:true,
                });


                 $("#kegiatan").select2({
                    placeholder: "Please Select",
                    allowClear:true,
                });

                 $(".namaPeran").select2({
                    placeholder: "Please Select",
                    allowClear:true,
                });

                 $(".namaAnggota").select2({
                    placeholder: "Please Select",
                    allowClear:true,
                });
                  $("#tahun").select2({
                    theme: 'bootstrap4'
                });

            });
        </script>

          <script>



            $( function() {
                $( ".datepicker" ).datepicker({
                    dateFormat: "yy-mm-dd",
                    beforeShowDay:$.datepicker.noWeekends
                    //  dateFormat: "dd-mm-yy"
                });
            } );


            $(document).ready(function () {
               $("input[name=TanggalAkhir]").on("change",function(){

                    var tanggalawal =  $("input[name=Tanggalsurat]").val();
                    var tanggalakhir =  $("input[name=TanggalAkhir]").val();
                    $(".datepicker2").datepicker('destroy');

                $( ".datepicker2" ).datepicker({
                    minDate: tanggalawal,
                    maxDate: tanggalakhir,
                     dateFormat: "yy-mm-dd"
                });

               });
             });

            $(document).ready(function () {
                    var tanggalawal =  $("input[name=Tanggalsurat]").val();
                    var tanggalakhir =  $("input[name=TanggalAkhir]").val();

                 $( ".datepicker2" ).datepicker({
                     minDate: tanggalawal,
                     maxDate: tanggalakhir,
                     beforeShowDay:$.datepicker.noWeekends,
                     dateFormat: "yy-mm-dd"
                 });


            });




  </script>

  <!-- Modal -->


  <script>

    @if(session('danger'))
        $(document).ready(function(){
    $("#myModal2").modal('show');
        });
    @endif

  </script>

@endsection
