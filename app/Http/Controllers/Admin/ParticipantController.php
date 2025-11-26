<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Exports\ParticipantsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ParticipantController extends Controller
{
    private const PER_PAGE_OPTIONS = [10, 20, 50, 100];

    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 20);
        if (!in_array($perPage, self::PER_PAGE_OPTIONS, true)) {
            $perPage = 20;
        }

        $participantsQuery = Registration::where('status', 'approved');

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $participantsQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $participants = $participantsQuery
            ->orderByDesc('approved_at')
            ->paginate($perPage)
            ->withQueryString();
        
        return view('admin.participants.index', [
            'participants' => $participants,
            'perPageOptions' => self::PER_PAGE_OPTIONS,
            'currentPerPage' => $perPage,
            'searchKeyword' => $request->input('search', ''),
        ]);
    }

    public function show($id)
    {
        $participant = Registration::where('status', 'approved')
            ->findOrFail($id);
        
        return view('admin.participants.show', compact('participant'));
    }

    public function export(Request $request)
    {
        $searchKeyword = $request->input('search', '');
        $filename = 'peserta-terkonfirmasi-' . date('Y-m-d-His') . '.xlsx';
        
        return Excel::download(new ParticipantsExport($searchKeyword), $filename);
    }
}

