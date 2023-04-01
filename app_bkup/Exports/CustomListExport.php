<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomListExport implements FromArray, WithHeadings, WithBatchInserts, WithChunkReading
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    private $myArray;

    private $myHeadings;

    public function __construct($myArray, $myHeadings)
    {
        $this->myArray = $myArray;
        $this->myHeadings = $myHeadings;
    }

    public function array(): array
    {
        return $this->myArray;
    }

    public function headings(): array
    {
        return $this->myHeadings;
    }

    public function chunkSize(): int
    {
        return 200;
    }

    public function batchSize(): int
    {
    }
}
