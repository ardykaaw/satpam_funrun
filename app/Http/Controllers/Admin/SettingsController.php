<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $registrationOpen = Settings::get('registration_open', '1') === '1';
        
        return view('admin.settings.index', compact('registrationOpen'));
    }

    public function updateRegistrationStatus(Request $request)
    {
        $request->validate([
            'registration_open' => 'required|boolean',
        ]);

        Settings::set('registration_open', $request->registration_open ? '1' : '0');

        $status = $request->registration_open ? 'dibuka' : 'ditutup';
        
        return redirect()->route('admin.settings.index')
            ->with('success', "Pendaftaran berhasil {$status}.");
    }
}

