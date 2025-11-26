<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BarcodeScanController extends Controller
{
    /**
     * Display the barcode scan page
     */
    public function index()
    {
        // Get last 50 participants who picked up race pack
        $pickedUpRegistrations = Registration::where('race_pack_picked_up', true)
            ->orderByDesc('race_pack_picked_up_at')
            ->limit(50)
            ->get();

        return view('admin.barcode-scan.index', [
            'pickedUpRegistrations' => $pickedUpRegistrations,
        ]);
    }

    /**
     * Lookup registration by barcode/registration number
     */
    public function lookup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Format kode tidak valid.',
            ], 400);
        }

        $code = trim($request->input('code'));

        // Find registration by registration_number
        $registration = Registration::where('registration_number', $code)
            ->where('status', 'approved')
            ->first();

        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran tidak ditemukan atau belum disetujui.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'registration' => [
                'id' => $registration->id,
                'registration_number' => $registration->registration_number,
                'full_name' => $registration->full_name,
                'category' => $registration->category,
                'email' => $registration->email,
                'phone' => $registration->phone,
                'race_pack_picked_up' => $registration->race_pack_picked_up,
                'race_pack_picked_up_at' => $registration->race_pack_picked_up_at 
                    ? $registration->race_pack_picked_up_at->format('d F Y H:i') . ' WITA'
                    : null,
            ],
        ]);
    }

    /**
     * Confirm race pack pickup
     */
    public function confirmPickup(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        // Check if already picked up
        if ($registration->race_pack_picked_up) {
            return response()->json([
                'success' => false,
                'message' => 'Race pack sudah diambil sebelumnya pada ' . 
                    $registration->race_pack_picked_up_at->format('d F Y H:i') . ' WITA.',
            ], 400);
        }

        // Check if registration is approved
        if ($registration->status !== 'approved') {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran belum disetujui.',
            ], 400);
        }

        // Update pickup status with timezone Asia/Makassar
        $registration->update([
            'race_pack_picked_up' => true,
            'race_pack_picked_up_at' => Carbon::now('Asia/Makassar'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Race pack berhasil dikonfirmasi diambil.',
            'registration' => [
                'id' => $registration->id,
                'registration_number' => $registration->registration_number,
                'full_name' => $registration->full_name,
                'race_pack_picked_up_at' => $registration->race_pack_picked_up_at->format('d F Y H:i') . ' WITA',
            ],
        ]);
    }
}
