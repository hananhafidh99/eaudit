<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => true,
            'data' => $announcements
        ]);
    }
}
