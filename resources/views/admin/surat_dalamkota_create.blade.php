@extends('template')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link href='chosen/chosen.min.css' rel='stylesheet' type='text/css'>
    <script src='chosen/chosen.jquery.min.js' type='text/javascript'></script>
    <style>
        .warning {
            font-size: 14px;
            text-align: justify;
        }
    </style>

    {{-- @if (session('Gagal'))
    {{ session('Gagal') }}
    @endif --}}

    <div class="alert alert-info" role="alert">
        Tambah Data Penugasan
    </div>
    <div class="card mb-4">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="{{ url('/perjalananDalam_kota') }}" method="post" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="row">
                    <div class="col-3 mt-4">
                        <label>No Surat</label>
                    </div>
                    <div class="col-2 mt-4">
                        <input type="text" value="{{ "700.1.1/" }}" class="form-control" readonly>
                    </div>
                    <div class="col-5 mt-4">
                        <input type="text" name="noSurat" class="form-control" value="{{ old('noSurat') }}">
                    </div>
                    <div class="col-2 mt-4">
                        <input type="text" value="{{ "/03" . "/" . session('tahun') }}" class="form-control" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 mt-3">
                        <label for="">Jenis Pengawasan </label>
                    </div>
                    <div class="col-9 mt-3">
                        <select class="form-control" name="id_jenisPengawasan" id="jp">
                            <option value="">Pilih</option>
                            @foreach ($jenisPengawasan as $key => $jp)
                                <option value="{{ $jp['id'] }}" {{ $jp['id'] == old('id_jenis_pengawasan') ? 'selected' : '' }}>
                                    {{ $jp['nama_jenispengawasan'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 mt-3">
                        <label for="">Obrik </label>
                    </div>
                    <div class="col-9 mt-3">
                        <select class="form-control" name="id_obrik" id="obrik">
                            <option value="">Pilih</option>
                            @foreach ($obrik as $key => $ob)
                                <option value="{{ $ob['id'] }}" {{ $ob['id'] == old('id_obrik') ? 'selected' : '' }}>
                                    {{ $ob['nama_obrik'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 mt-3">
                        <label for="">Tanggal </label>
                    </div>
                    <div class="col-3 mt-3">
                        <input type="text" name="tanggalAwalPenugasan" class="form-control datepicker selector" id="ta"
                            value="{{ old('tanggalAwalPenugasan') }}">
                    </div>
                    <div class="col-1 mt-4">
                        <label for="">s/d</label>
                    </div>
                    <div class="col-5 mt-3">
                        <input type="text" name="tanggalAkhirPenugasan" class="form-control datepicker selector" id="tp"
                            value="{{ old('tanggalAkhirPenugasan') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 mt-3">
                        <label for="">Anggaran Kegiatan </label>
                    </div>
                    <div class="col-9 mt-3">
                        <select class="form-control" name="id_anggaran" id="kegiatan">
                            <option value="">Pilih</option>
                            @foreach ($data as $key => $kegiatan)
                                <option value="{{ $kegiatan['id'] }}" {{ $kegiatan['id'] == old('id_kegiatan') ? 'selected' : '' }}>
                                    {{ $kegiatan['kegiatan'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr>

                Tim

                <div class="row">
                    <div class="col-2 mt-3">
                        <label for="">Peran </label>
                    </div>
                    <div class="col-5 mt-3">
                        <label for="">Pegawai </label>
                    </div>
                    <div class="col-5 mt-3">
                        <label for="">Tanggal Penugasan </label>
                    </div>
                </div>



                <hr>
                <?php $no = 1; ?>
                @foreach ($peran as $item)
                    @if ($item['nama_peran'] != 'Anggota')

                        <div class="row">
                            <div class="col-2 mt-3">
                                <label for="">{{ $no++ }} ) {{ $item['nama_peran'] }} </label>
                            </div>
                            <input type="hidden" name="tugas[{{ $item['id'] }}][dperan]" value="{{ $item['id'] }}">
                            <div class="col-5 mt-3">
                                <select class="form-control namaPeran chosen " name="tugas[{{ $item['id'] }}][id_pegawai]">
                                    <option value="">Pilih</option>
                                    <option>- Pilih Nama Pegawai -</option>
                                    @foreach ($pegawai as $key => $p)
                                        <option value="{{ $p['id'] }}" {{ $p['id'] == old('tugas.' . $item['id'] . '.id_pegawai') ? 'selected' : '' }}>{{$p['nama_pegawai'] }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3 mt-3">
                                <input type="text" name="tugas[{{ $item['id'] }}][tanggalAwalPemeriksaan]"
                                    class="form-control datepicker2"
                                    value="{{ old('tugas.' . $item['id'] . '.tanggalAwalPemeriksaan') }}">
                            </div>
                            <div class="col-2 mt-3">
                                <input type="text" name="tugas[{{ $item['id'] }}][tanggalAkhirPemeriksaan]"
                                    class="form-control datepicker2"
                                    value="{{ old('tugas.' . $item['id'] . '.tanggalAkhirPemeriksaan') }}">
                            </div>
                        </div>




                    @else
                        <div class="row">
                            <div class="col-2 mt-3">
                                <label for=""> {{ $no++ }} Anggota </label>
                            </div>
                        </div>
                        @for ($i = 1; $i <= 15; $i++)

                            <div class="row">
                                <div class="col-2 mt-3">
                                    <label for=""> {{ $item['nama_peran'] }} {{ $i }} </label>
                                </div>
                                <input type="hidden" name="anggota[{{ $item['id'] }}][{{ $i }}][dperan]" value="{{ $item['id'] }}">
                                <div class="col-5 mt-3">
                                    <select class="form-control namaAnggota" name="anggota[{{ $item['id'] }}][{{ $i }}][id_pegawai]">
                                        <option value="">Pilih</option>
                                        <option>- Pilih Nama Pegawai -</option>
                                        @foreach ($pegawai as $key => $p)
                                            <option value="{{ $p['id'] }}" {{ $p['id'] == old('anggota.' . $item['id'] . '.' . $i . '.id_pegawai') ? 'selected' : '' }}>{{ $p['nama_pegawai'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3 mt-3">
                                    <input type="text" name="anggota[{{ $item['id'] }}][{{ $i }}][tanggalAwalPemeriksaan]"
                                        class="form-control datepicker2"
                                        value="{{ old('anggota.' . $item['id'] . '.' . $i . '.tanggalAwalPemeriksaan') }}">
                                </div>
                                <div class="col-2 mt-3">
                                    <input type="text" name="anggota[{{ $item['id'] }}][{{ $i }}][tanggalAkhirPemeriksaan]"
                                        class="form-control datepicker2"
                                        value="{{ old('anggota.' . $item['id'] . '.' . $i . '.tanggalAkhirPemeriksaan') }}">
                                </div>
                            </div>
                        @endfor
                    @endif



                @endforeach

                <hr>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="">Tanggal Pembuatan Surat </label>
                        <input type="text" name="tanggalTerbitPenugasan" class="form-control datepicker"
                            value="{{ old('tanggalTerbitPenugasan') }}">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="">Kelompok Penugasan </label>
                        <select class="form-control" name="id_kelompokPenugasan" id="obrik">
                            <option value="">Pilih</option>
                            @foreach ($kelompokPenugasan as $key => $kelompokPenugasan)
                                <option value="{{ $kelompokPenugasan['id'] }}" {{ $kelompokPenugasan['id'] == old('id_kelompokPenugasan	') ? 'selected' : '' }}>
                                    {{ $kelompokPenugasan['kelompokPenugasan'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button class="btn btn-primary tambah">Tambah Penugasan</button>

                {{-- <button class="btn btn-danger" id="tombol">Tambah Penugasan</button> --}}


            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#jp").select2({
                placeholder: "Please Select",
                allowClear: true,
            });

            $("#obrik").select2({
                placeholder: "Please Select",
                allowClear: true,
            });


            $("#kegiatan").select2({
                placeholder: "Please Select",
                allowClear: true,
            });

            $(".namaPeran").select2({
                placeholder: "Please Select",
                allowClear: true,
            });

            $(".namaAnggota").select2({
                placeholder: "Please Select",
                allowClear: true,
            });
            $("#tahun").select2({
                theme: 'bootstrap4'
            });

        });
    </script>

    <script>



        $(function () {
            $(".datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                beforeShowDay: $.datepicker.noWeekends,
                changeYear: true,
                changeMonth: true,
                //  dateFormat: "dd-mm-yy"
            });

        });

        $(document).ready(function () {
            $("input[name=tanggalAkhirPenugasan]").on("change", function () {

                var tanggalawal = $("input[name=tanggalAwalPenugasan]").val();
                var tanggalakhir = $("input[name=tanggalAkhirPenugasan]").val();
                $(".datepicker2").datepicker('destroy');

                $(".datepicker2").datepicker({
                    minDate: tanggalawal,
                    maxDate: tanggalakhir,
                    dateFormat: "yy-mm-dd"
                });

            });
        });




    </script>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-center" style="text-align: justify;">
                    @if (session('warning'))
                        <?php    echo session('warning') ?>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-center" style="text-align: justify;">
                    @if (session('danger'))
                        <?php    echo session('danger') ?>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ url('suratTugasBaru') }}" method="post">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        @if(session('warning'))
            $(document).ready(function () {
                $("#myModal").modal('show');
            });
        @endif
        // $(".chosen-select").chosen({ allow_single_deselect:true });


    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".chosen").chosen({
                allow_single_deselect: true
            });
        });
    </script>




    </script>

    <script>
        $(document).ready(function () {
            // Function to check overlap
            function checkOverlap(element) {
                var id_pegawai = $(element).val();
                if (!id_pegawai) return;

                // Find dates in the same row
                var row = $(element).closest('.row');
                var tanggal_awal = row.find('input[name*="tanggalAwalPemeriksaan"]').val();
                var tanggal_akhir = row.find('input[name*="tanggalAkhirPemeriksaan"]').val();

                // If not found in row, use global dates
                if (!tanggal_awal) {
                    tanggal_awal = $('#ta').val();
                }
                if (!tanggal_akhir) {
                    tanggal_akhir = $('#tp').val();
                }

                // If dates are still empty, maybe alert user or just skip?
                // Usually global dates are required, so they might be filled.
                // But if user changes employee BEFORE dates, we might miss it.
                // Ideally we should also check when DATES change, but user asked "saat seorang pekerja di pilih".
                // So we focus on select change.

                if (tanggal_awal && tanggal_akhir) {
                    $.ajax({
                        url: '{{ url("/check-overlap") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id_pegawai: id_pegawai,
                            tanggal_awal: tanggal_awal,
                            tanggal_akhir: tanggal_akhir
                        },
                        success: function (response) {
                            if (response.status && response.data.length > 0) {
                                var message = "Pegawai ini memiliki penugasan lain pada tanggal tersebut:<br><ul style='text-align:left'>";
                                response.data.forEach(function (msg) {
                                    message += "<li>" + msg + "</li>";
                                });
                                message += "</ul>";

                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Peringatan Double Penugasan',
                                    html: message,
                                    confirmButtonText: 'OK, Lanjutkan'
                                });
                            }
                        },
                        error: function (xhr) {
                            console.error("Error checking overlap", xhr);
                        }
                    });
                }
            }

            // Event listener for changes
            // Use 'change' for select2
            $('.namaPeran, .namaAnggota').on('change', function () {
                checkOverlap(this);
            });

            // Trigger when specific row dates change
            $(document).on('change', '.datepicker2', function() {
                 var row = $(this).closest('.row');
                 var select = row.find('select.namaPeran, select.namaAnggota');
                 if (select.length > 0 && select.val()) {
                     checkOverlap(select);
                 }
            });

            // Trigger when global dates change
            $('#ta, #tp').on('change', function() {
                // Check ALL selects that have a value
                $('.namaPeran, .namaAnggota').each(function() {
                    if ($(this).val()) {
                        checkOverlap(this);
                    }
                });
            });
        });
    </script>

@endsection