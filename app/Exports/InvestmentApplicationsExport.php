<?php

namespace App\Exports;

use App\Models\InvestmentApplication;
use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Collection;

class InvestmentApplicationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, WithDrawings, WithEvents
{
    protected $applications;
    protected $company;

    public function __construct($applications)
    {
        $this->applications = $applications instanceof Collection ? $applications : collect($applications);
        $this->company = Company::first();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->applications;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            __('admin.reference_number'),
            __('admin.applicant_type'),
            __('admin.full_name_company'),
            __('admin.national_id_cr'),
            __('admin.email'),
            __('admin.mobile_number'),
            __('admin.nationality'),
            __('admin.country_of_residence'),
            __('admin.number_of_shares'),
            __('admin.share_type'),
            __('admin.status'),
            __('admin.date_of_birth'),
            __('admin.profession'),
            __('admin.absher_mobile'),
            __('admin.submission_date'),
            __('admin.ip_address'),
        ];
    }

    /**
     * @param InvestmentApplication $application
     * @return array
     */
    public function map($application): array
    {
        return [
            $application->reference_number,
            $application->applicant_type === 'saudi_individual'
                ? __('admin.saudi_individual')
                : __('admin.company_institution'),
            $application->applicant_type === 'saudi_individual'
                ? $application->full_name
                : $application->name_per_commercial_registration,
            $application->applicant_type === 'saudi_individual'
                ? $application->national_id_residence_number
                : $application->commercial_registration_number,
            $application->email,
            $application->mobile_number,
            $application->nationality,
            $application->country_of_residence,
            number_format($application->number_of_shares),
            $application->getShareTypeLabel(),
            $application->getStatusLabel(),
            $application->date_of_birth?->format('Y-m-d') ?? '-',
            $application->profession ?? '-',
            $application->absher_registered_mobile ?? '-',
            $application->created_at->format('Y-m-d H:i:s'),
            $application->ip_address,
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '10B981'] // Green color
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],

            // All data styling
            "A1:{$highestColumn}{$highestRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],

            // Alternate row colors
            "A2:{$highestColumn}{$highestRow}" => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F9FAFB']
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return __('admin.investment_applications');
    }

    /**
     * @return array
     */
    public function drawings()
    {
        $drawings = [];

        if ($this->company && $this->company->logo && file_exists(storage_path('app/public/' . $this->company->logo))) {
            $drawing = new Drawing();
            $drawing->setName('Company Logo');
            $drawing->setDescription('Company Logo');
            $drawing->setPath(storage_path('app/public/' . $this->company->logo));
            $drawing->setHeight(60);
            $drawing->setCoordinates('A1');
            $drawing->setOffsetX(10);
            $drawing->setOffsetY(10);

            $drawings[] = $drawing;
        }

        return $drawings;
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
                $sheet->getColumnDimension('A')->setWidth(20); // Reference Number
                $sheet->getColumnDimension('B')->setWidth(15); // Applicant Type
                $sheet->getColumnDimension('C')->setWidth(25); // Name
                $sheet->getColumnDimension('D')->setWidth(20); // ID/CR
                $sheet->getColumnDimension('E')->setWidth(25); // Email
                $sheet->getColumnDimension('F')->setWidth(15); // Mobile
                $sheet->getColumnDimension('G')->setWidth(15); // Nationality
                $sheet->getColumnDimension('H')->setWidth(20); // Country
                $sheet->getColumnDimension('I')->setWidth(15); // Shares
                $sheet->getColumnDimension('J')->setWidth(15); // Status
                $sheet->getColumnDimension('K')->setWidth(15); // DOB
                $sheet->getColumnDimension('L')->setWidth(20); // Profession
                $sheet->getColumnDimension('M')->setWidth(15); // Absher Mobile
                $sheet->getColumnDimension('N')->setWidth(20); // Submission Date
                $sheet->getColumnDimension('O')->setWidth(15); // IP Address

                // Set row height for header
                $sheet->getRowDimension(1)->setRowHeight(30);

                // Add company information at the top
                if ($this->company) {
                    $sheet->insertNewRowBefore(1, 3);

                    // Company name
                    $sheet->setCellValue('A1', $this->company->getLocalizedName());
                    $sheet->mergeCells('A1:O1');
                    $sheet->getStyle('A1')->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 16,
                            'color' => ['rgb' => '1F2937']
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                    ]);

                    // Export date
                    $sheet->setCellValue('A2', __('admin.export_date') . ': ' . now()->format('Y-m-d H:i:s'));
                    $sheet->mergeCells('A2:O2');
                    $sheet->getStyle('A2')->applyFromArray([
                        'font' => [
                            'size' => 12,
                            'color' => ['rgb' => '6B7280']
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                    ]);

                    // Empty row
                    $sheet->setCellValue('A3', '');

                    // Update header row styling
                    $sheet->getStyle('A4:O4')->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 12,
                            'color' => ['rgb' => 'FFFFFF']
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => '10B981']
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                    ]);
                }

                // Auto-filter for data
                $highestRow = $sheet->getHighestRow();
                $sheet->setAutoFilter("A4:O{$highestRow}");

                // Freeze header row
                $sheet->freezePane('A5');
            },
        ];
    }
}
