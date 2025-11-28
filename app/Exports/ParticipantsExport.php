<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, WithCustomStartCell, WithEvents
{
    protected $searchKeyword;

    public function __construct($searchKeyword = null)
    {
        $this->searchKeyword = $searchKeyword;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Include both approved and rejected registrations
        $query = Registration::whereIn('status', ['approved', 'rejected']);

        if ($this->searchKeyword) {
            $search = trim($this->searchKeyword);
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('kta_number', 'like', "%{$search}%");
            });
        }

        return $query->orderByDesc('created_at')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No. Pendaftaran',
            'Nama Lengkap',
            'Nama di Bib',
            'Email',
            'Telepon',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Kategori',
            'Tipe Kategori',
            'No. KTA',
            'Harga Unik',
            'Ukuran Jersey',
            'Golongan Darah',
            'Alamat',
            'Kota',
            'Status',
            'Alasan Penolakan (Jika Ditolak)',
            'Tanggal Disetujui/Ditolak',
        ];
    }

    /**
     * @param Registration $participant
     * @return array
     */
    public function map($participant): array
    {
        $status = ucfirst($participant->status);
        $rejectionReason = '';
        
        // If rejected and category is satpam, show admin_notes as reason
        if ($participant->status === 'rejected' && $participant->category_type === 'satpam') {
            $rejectionReason = $participant->admin_notes ?? 'Tidak disebutkan';
        } elseif ($participant->status === 'rejected') {
            $rejectionReason = $participant->admin_notes ?? 'Tidak disebutkan';
        }
        
        $dateColumn = $participant->approved_at 
            ? $participant->approved_at->format('d/m/Y H:i') 
            : ($participant->rejected_at 
                ? $participant->rejected_at->format('d/m/Y H:i') 
                : '-');
        
        return [
            $participant->registration_number ?? '-',
            $participant->full_name,
            $participant->bib_name ?? '-',
            $participant->email,
            $participant->phone,
            $participant->birth_date ? $participant->birth_date->format('d/m/Y') : '-',
            $participant->gender ?? '-',
            $participant->category,
            $participant->category_type ? ($participant->category_type === 'satpam' ? 'Korps Satpam' : 'Umum') : '-',
            $participant->kta_number ?? '-',
            $participant->unique_price_code ? 'Rp ' . number_format($participant->unique_price_code, 0, ',', '.') : '-',
            $participant->jersey_size ?? '-',
            $participant->blood_type ?? '-',
            $participant->address ?? '-',
            $participant->city ?? '-',
            $status,
            $rejectionReason,
            $dateColumn,
        ];
    }

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'A6';
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Set column widths
                $sheet->getColumnDimension('A')->setWidth(18);
                $sheet->getColumnDimension('B')->setWidth(25);
                $sheet->getColumnDimension('C')->setWidth(20);
                $sheet->getColumnDimension('D')->setWidth(30);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(15);
                $sheet->getColumnDimension('G')->setWidth(15);
                $sheet->getColumnDimension('H')->setWidth(25);
                $sheet->getColumnDimension('I')->setWidth(15);
                $sheet->getColumnDimension('J')->setWidth(15);
                $sheet->getColumnDimension('K')->setWidth(18);
                $sheet->getColumnDimension('L')->setWidth(15);
                $sheet->getColumnDimension('M')->setWidth(15);
                $sheet->getColumnDimension('N')->setWidth(40);
                $sheet->getColumnDimension('O')->setWidth(20);
                $sheet->getColumnDimension('P')->setWidth(15);
                $sheet->getColumnDimension('Q')->setWidth(40);
                $sheet->getColumnDimension('R')->setWidth(20);

                // Header dengan judul
                $sheet->setCellValue('A1', 'SATPAM FUN RUN 5K');
                $sheet->setCellValue('A2', 'DAFTAR PESERTA TERKONFIRMASI');
                
                // Style untuk judul
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 18,
                        'color' => ['rgb' => 'EEDF9D'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => '665D6C'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Merge cells untuk judul
                $sheet->mergeCells('A1:R1');
                $sheet->mergeCells('A2:R2');

                // Set row height untuk header
                $sheet->getRowDimension(1)->setRowHeight(30);
                $sheet->getRowDimension(2)->setRowHeight(25);
                $sheet->getRowDimension(6)->setRowHeight(30);

                // Style untuk header tabel (row 6)
                $headerRange = 'A6:R6';
                $sheet->getStyle($headerRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 11,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '282061'], // Warna primary project
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'FFFFFF'],
                        ],
                    ],
                ]);

                // Style untuk data rows
                $lastRow = $sheet->getHighestRow();
                if ($lastRow > 6) {
                    $dataRange = 'A7:R' . $lastRow;
                    $sheet->getStyle($dataRange)->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => 'E0E0E0'],
                            ],
                        ],
                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                            'wrapText' => true,
                        ],
                    ]);

                    // Alternating row colors
                    for ($row = 7; $row <= $lastRow; $row++) {
                        if ($row % 2 == 0) {
                            $sheet->getStyle('A' . $row . ':O' . $row)->applyFromArray([
                                'fill' => [
                                    'fillType' => Fill::FILL_SOLID,
                                    'startColor' => ['rgb' => 'F8F9FA'],
                                ],
                            ]);
                        }
                    }
                }

                // Center alignment untuk kolom tertentu
                $centerColumns = ['A', 'E', 'F', 'G', 'I', 'J', 'K', 'L', 'M', 'P'];
                foreach ($centerColumns as $col) {
                    if ($lastRow > 6) {
                        $sheet->getStyle($col . '7:' . $col . $lastRow)->applyFromArray([
                            'alignment' => [
                                'horizontal' => Alignment::HORIZONTAL_CENTER,
                            ],
                        ]);
                    }
                }

                // Footer info
                $footerRow = $lastRow + 2;
                $sheet->setCellValue('A' . $footerRow, 'Dicetak pada: ' . date('d/m/Y H:i:s'));
                if ($this->searchKeyword) {
                    $sheet->setCellValue('A' . ($footerRow + 1), 'Filter pencarian: ' . $this->searchKeyword);
                }
                $sheet->getStyle('A' . $footerRow . ':A' . ($footerRow + 1))->applyFromArray([
                    'font' => [
                        'size' => 9,
                        'italic' => true,
                        'color' => ['rgb' => '6C7A91'],
                    ],
                ]);
            },
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            6 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '7C6BFF']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Peserta Terkonfirmasi';
    }
}

