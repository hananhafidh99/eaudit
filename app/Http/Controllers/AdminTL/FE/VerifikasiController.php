<?php

namespace App\Http\Controllers\AdminTL\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengawasan;
use App\Models\DataDukung;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VerifikasiController extends Controller
{
    /**
     * Display verification data list (Legacy - redirect to rekomendasi)
     */
    public function index()
    {
        return redirect()->route('adminTL.verifikasi.rekomendasi');
    }

    /**
     * Display verification data list for Rekomendasi
     */
    public function indexRekomendasi()
    {
        try {
            // Get data with status 'Belum Jadi' or 'Di Proses' for Rekomendasi type
            $data = Pengawasan::whereIn('status_LHP', ['Belum Jadi', 'Di Proses'])
                ->with([
                    'dataDukung' => function ($query) {
                        $query->orderBy('created_at', 'desc');
                    }
                ])
                ->where(function ($query) {
                    // Filter untuk data yang terkait dengan rekomendasi
                    $query->where('jenis', 'LIKE', '%rekomendasi%')
                        ->orWhere('tipe', 'LIKE', '%rekomendasi%')
                        ->orWhereHas('dataDukung', function ($q) {
                        $q->whereNull('id_jenis_temuan');
                    });
                })
                ->orderBy('updated_at', 'desc')
                ->paginate(10);

            $pageType = 'rekomendasi';
            $pageTitle = 'Verifikasi Data - Rekomendasi';

            return view('AdminTL.verifikasi.index', compact('data', 'pageType', 'pageTitle'));
        } catch (\Exception $e) {
            Log::error('Error loading verification rekomendasi data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Gagal memuat data verifikasi rekomendasi');
        }
    }

    /**
     * Display verification data list for Temuan dan Rekomendasi
     */
    public function indexTemuan()
    {
        try {
            // Get data with status 'Belum Jadi' or 'Di Proses' for Temuan dan Rekomendasi type
            $data = Pengawasan::whereIn('status_LHP', ['Belum Jadi', 'Di Proses'])
                ->with([
                    'dataDukung' => function ($query) {
                        $query->orderBy('created_at', 'desc');
                    }
                ])
                ->where(function ($query) {
                    // Filter untuk data yang terkait dengan temuan dan rekomendasi
                    $query->where('jenis', 'LIKE', '%temuan%')
                        ->orWhere('tipe', 'LIKE', '%temuan%')
                        ->orWhereHas('dataDukung', function ($q) {
                        $q->whereNotNull('id_jenis_temuan');
                    });
                })
                ->orderBy('updated_at', 'desc')
                ->paginate(10);

            $pageType = 'temuan';
            $pageTitle = 'Verifikasi Data - Temuan dan Rekomendasi';

            return view('AdminTL.verifikasi.index', compact('data', 'pageType', 'pageTitle'));
        } catch (\Exception $e) {
            Log::error('Error loading verification temuan data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Gagal memuat data verifikasi temuan');
        }
    }

    /**
     * Show detail verification data with files
     */
    public function show($type, $id)
    {
        // Perlu di sesuaikan dengan controller editrekom yang ketika admin mengupload data dukung
        try {
            $pengawasan = Pengawasan::with([
                'dataDukung' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ])->findOrFail($id);

            // Only show data with status 'Belum Jadi' or 'Di Proses'
            if (!in_array($pengawasan->status_LHP, ['Belum Jadi', 'Di Proses'])) {
                $redirectRoute = $type === 'rekomendasi' ? 'adminTL.verifikasi.rekomendasi' : 'adminTL.verifikasi.temuan';
                return redirect()->route($redirectRoute)
                    ->with('error', 'Data ini tidak tersedia untuk verifikasi');
            }

            $pageType = $type;
            $pageTitle = $type === 'rekomendasi' ? 'Detail Verifikasi - Rekomendasi' : 'Detail Verifikasi - Temuan dan Rekomendasi';

            return view('AdminTL.verifikasi.show', compact('pengawasan', 'pageType', 'pageTitle'));
        } catch (\Exception $e) {
            Log::error('Error loading verification detail', [
                'type' => $type,
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            $redirectRoute = $type === 'rekomendasi' ? 'adminTL.verifikasi.rekomendasi' : 'adminTL.verifikasi.temuan';
            return redirect()->route($redirectRoute)
                ->with('error', 'Data tidak ditemukan');
        }
    }

    /**
     * Update status with reason
     */
    public function updateStatus(Request $request, $type, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status_LHP' => 'required|in:Di Proses,Diterima,Ditolak',
                'alasan_verifikasi' => 'required|string|max:1000'
            ], [
                'status_LHP.required' => 'Status harus dipilih',
                'status_LHP.in' => 'Status tidak valid',
                'alasan_verifikasi.required' => 'Alasan verifikasi harus diisi',
                'alasan_verifikasi.max' => 'Alasan verifikasi maksimal 1000 karakter'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $pengawasan = Pengawasan::findOrFail($id);

            // Validate current status
            if (!in_array($pengawasan->status_LHP, ['Belum Jadi', 'Di Proses'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Status saat ini tidak dapat diubah'
                ], 400);
            }

            // Validate status transition
            $validTransitions = [
                'Belum Jadi' => ['Di Proses'],
                'Di Proses' => ['Diterima', 'Ditolak']
            ];

            $currentStatus = $pengawasan->status_LHP;
            $newStatus = $request->status_LHP;

            if (!in_array($newStatus, $validTransitions[$currentStatus])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transisi status tidak valid dari ' . $currentStatus . ' ke ' . $newStatus
                ], 400);
            }

            // Update status with reason
            $updated = DB::table('pengawasans')
                ->where('id', $id)
                ->update([
                    'status_LHP' => $newStatus,
                    'alasan_verifikasi' => $request->alasan_verifikasi,
                    'tgl_verifikasi' => now(),
                    'updated_at' => now()
                ]);

            if ($updated) {
                Log::info('Status verifikasi berhasil diupdate', [
                    'id_pengawasan' => $id,
                    'old_status' => $currentStatus,
                    'new_status' => $newStatus,
                    'alasan' => $request->alasan_verifikasi,
                    'user' => auth()->user()->name ?? 'Unknown'
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Status berhasil diupdate ke ' . $newStatus,
                    'data' => [
                        'status_LHP' => $newStatus,
                        'alasan_verifikasi' => $request->alasan_verifikasi,
                        'tgl_verifikasi' => now()->format('d/m/Y H:i:s')
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status'
            ], 500);

        } catch (\Exception $e) {
            Log::error('Error updating verification status', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    /**
     * Get available status options for current status
     */
    public function getStatusOptions($type, $id)
    {
        try {
            $pengawasan = Pengawasan::findOrFail($id);

            $statusOptions = [
                'Belum Jadi' => [
                    ['value' => 'Di Proses', 'label' => 'Di Proses']
                ],
                'Di Proses' => [
                    ['value' => 'Diterima', 'label' => 'Diterima'],
                    ['value' => 'Ditolak', 'label' => 'Ditolak']
                ]
            ];

            $options = $statusOptions[$pengawasan->status_LHP] ?? [];

            return response()->json([
                'success' => true,
                'current_status' => $pengawasan->status_LHP,
                'options' => $options
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading status options'
            ], 500);
        }
    }
}
