@extends('template')

@section('title')
User Data - User Control
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-database"></i>
                        User Data - Pengaturan Akses Data
                    </h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>Panduan Penggunaan:</strong>
                                <ul class="mb-0 mt-2">
                                    <li><strong>Semua Data:</strong> User dapat mengakses semua jenis temuan</li>
                                    <li><strong>Akses Terbatas:</strong> User hanya dapat mengakses jenis temuan yang dipilih</li>
                                    <li><strong>Status Aktif/Nonaktif:</strong> Mengontrol apakah user dapat mengakses sistem atau tidak</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="userDataTable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama User</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Status Akses</th>
                                    <th>Tipe Akses</th>
                                    <th>Catatan</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->id == auth()->id())
                                        <span class="badge badge-info badge-sm ml-1">You</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        @switch($user->role ?? 'user')
                                            @case('admin')
                                                <span class="badge badge-danger">Admin</span>
                                                @break
                                            @case('pemeriksa')
                                                <span class="badge badge-warning">Pemeriksa</span>
                                                @break
                                            @case('obrik')
                                                <span class="badge badge-info">Obrik</span>
                                                @break
                                            @default
                                                <span class="badge badge-secondary">User</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox"
                                                   class="custom-control-input access-toggle"
                                                   id="access{{ $user->id }}"
                                                   data-user-id="{{ $user->id }}"
                                                   {{ $user->userDataAccess && $user->userDataAccess->is_active ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="access{{ $user->id }}">
                                                <span class="access-status">
                                                    {{ $user->userDataAccess && $user->userDataAccess->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->userDataAccess)
                                            @if($user->userDataAccess->access_type === 'all')
                                                <span class="badge badge-primary">Semua Data</span>
                                            @else
                                                <span class="badge badge-warning">
                                                    Terbatas ({{ count(json_decode($user->userDataAccess->jenis_temuan_ids ?? '[]')) }} jenis)
                                                </span>
                                            @endif
                                        @else
                                            <span class="badge badge-secondary">Belum Diatur</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>
                                            {{ $user->userDataAccess->notes ?? '-' }}
                                        </small>
                                    </td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-sm btn-primary"
                                                onclick="editAccess({{ $user->id }})"
                                                title="Edit Akses Data">
                                            <i class="fas fa-edit"></i> Edit Akses
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Access Modal -->
<div class="modal fade" id="editAccessModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Akses Data User</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="accessForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="editUserId" name="user_id">

                    <div class="form-group">
                        <label><strong>User:</strong></label>
                        <p id="editUserInfo" class="mb-0"></p>
                    </div>

                    <div class="form-group">
                        <label for="accessType">Tipe Akses <span class="text-danger">*</span></label>
                        <select class="form-control" id="accessType" name="access_type" required>
                            <option value="all">Semua Data - User dapat mengakses semua jenis temuan</option>
                            <option value="specific">Akses Terbatas - Pilih jenis temuan tertentu</option>
                        </select>
                    </div>

                    <div class="form-group" id="jenisTemuanSection" style="display: none;">
                        <label>Jenis Temuan yang Dapat Diakses</label>
                        <div class="row">
                            @foreach($jenisTemuans as $jenis)
                            <div class="col-md-6 col-lg-4 mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                           class="custom-control-input jenis-temuan-check"
                                           id="jenis{{ $jenis->id }}"
                                           name="jenis_temuan_ids[]"
                                           value="{{ $jenis->id }}">
                                    <label class="custom-control-label" for="jenis{{ $jenis->id }}">
                                        <small>{{ $jenis->nama_temuan }}</small>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAllJenis()">
                                <i class="fas fa-check-square"></i> Pilih Semua
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="deselectAllJenis()">
                                <i class="fas fa-square"></i> Hapus Semua
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes">Catatan (Opsional)</label>
                        <textarea class="form-control"
                                  id="notes"
                                  name="notes"
                                  rows="3"
                                  placeholder="Catatan tentang akses pengguna ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#userDataTable').DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "pageLength": 25,
        "order": [[1, 'asc']]
    });

    // Access toggle handler
    $('.access-toggle').on('change', function() {
        const userId = $(this).data('user-id');
        const isActive = $(this).is(':checked');
        const toggle = $(this);
        const statusSpan = toggle.siblings('label').find('.access-status');

        // Show loading
        toggle.prop('disabled', true);

        $.post('/adminTL/user-control/toggle-user-access/' + userId, {
            _token: $('meta[name="csrf-token"]').attr('content')
        })
        .done(function(response) {
            if (response.success) {
                statusSpan.text(isActive ? 'Aktif' : 'Nonaktif');

                // Show success message
                showAlert('success', response.message);
            } else {
                // Revert toggle
                toggle.prop('checked', !isActive);
                showAlert('error', response.message);
            }
        })
        .fail(function() {
            // Revert toggle
            toggle.prop('checked', !isActive);
            showAlert('error', 'Terjadi kesalahan saat mengubah status akses');
        })
        .always(function() {
            toggle.prop('disabled', false);
        });
    });

    // Access type change handler
    $('#accessType').on('change', function() {
        if ($(this).val() === 'specific') {
            $('#jenisTemuanSection').show();
        } else {
            $('#jenisTemuanSection').hide();
            $('.jenis-temuan-check').prop('checked', false);
        }
    });

    // Access form submission
    $('#accessForm').on('submit', function(e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.post('/adminTL/user-control/update-user-data-access', formData)
        .done(function(response) {
            if (response.success) {
                $('#editAccessModal').modal('hide');
                showAlert('success', response.message);
                // Reload page after short delay
                setTimeout(function() {
                    location.reload();
                }, 1500);
            } else {
                showAlert('error', response.message);
            }
        })
        .fail(function() {
            showAlert('error', 'Terjadi kesalahan saat menyimpan pengaturan akses');
        });
    });
});

function editAccess(userId) {
    // Find user data
    const users = @json($users);
    const user = users.find(u => u.id === userId);

    if (!user) {
        showAlert('error', 'Data user tidak ditemukan');
        return;
    }

    // Reset form
    $('#accessForm')[0].reset();
    $('#editUserId').val(userId);
    $('#editUserInfo').html('<strong>' + user.name + '</strong> (' + user.username + ')');

    // Set current access data
    if (user.user_data_access) {
        $('#accessType').val(user.user_data_access.access_type);
        $('#notes').val(user.user_data_access.notes || '');

        if (user.user_data_access.access_type === 'specific') {
            $('#jenisTemuanSection').show();

            // Check specific jenis temuan
            const allowedIds = JSON.parse(user.user_data_access.jenis_temuan_ids || '[]');
            allowedIds.forEach(function(id) {
                $('#jenis' + id).prop('checked', true);
            });
        } else {
            $('#jenisTemuanSection').hide();
        }
    } else {
        $('#accessType').val('all');
        $('#jenisTemuanSection').hide();
    }

    $('#editAccessModal').modal('show');
}

function selectAllJenis() {
    $('.jenis-temuan-check').prop('checked', true);
}

function deselectAllJenis() {
    $('.jenis-temuan-check').prop('checked', false);
}

function showAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            ${message}
        </div>
    `;

    $('.card-body').prepend(alertHtml);

    // Auto dismiss after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);
}
</script>
@endsection
