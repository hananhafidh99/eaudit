@extends('template')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <h5>Daftar Kelompok Penugasan </h5>
    <div class="d-flex justify-content-end"><a href="{{ url('k_penugasan_baru') }}" class="btn btn-success">Tambah Eselon</a></div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelompok Penugasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $no = 1; ?>
                @foreach ($data as $index => $v)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $v["kelompokPenugasan"] }}</td>
                        <td>
                            <div class="row">
                                <div class="col-sm-2">
                                    <a href="{{ url('k_penugasan/' . $v['id'] . '/edit') }}"
                                        class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i></a>
                                </div>
                                <div class="col-sm-2 ">
                                    <form action="{{ url('k_penugasan/' . $v['id']. '/hapus') }}" onsubmit="return confirm('apakah anda akan menghapus data ini ?')" method="POST"
                                        class="d-inline mb-3">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" name="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}")
        @endif
        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}")
        @endif
    </script>
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
        });
    </script>
@endsection

