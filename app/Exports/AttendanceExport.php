<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class AttendanceExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function array(): array
    {
        $dates = $this->request['date'] ? explode(' - ', $this->request['date']) : [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')];
        $attendance = \App\Models\Attendance::query()->with('user')
        ->when($this->request['date'], function ($query, $dates) {
            return $query->whereBetween('date', explode(' - ', $dates));
        })
        ->when($this->request['status'], function ($query, $status) {
            return $query->where('status', $status);
        })
        ->latest()->get();
        
        $data = [];
        $i = 1;
        foreach($attendance as $item){
            $data[] = [
                'No' => $i++,
                'Employee ID' => $item->user->employee_id,
                'Name' => $item->user->name,
                'Date' => $item->date,
                'Absen In' => $item->time_in,
                'Max Absen In' => $item->max_time_in,
                'Absen Out' => $item->time_out,
                'Status' => $item->status,
                'Description' => $item->description,
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'No',
            'Employee ID',
            'Name',
            'Date',
            'Absen In',
            'Max Absen In',
            'Absen Out',
            'Status',
            'Description',
        ];
    }

    public function styles($sheet)
    {
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => 'FFFFFF',
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ],
            'fill' => [
                // background color to blue
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '181C3C',
                ],
            ],
        ]);
    }
}
