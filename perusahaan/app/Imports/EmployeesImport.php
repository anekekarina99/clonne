<?php

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EmployeesImport implements ToModel, WithChunkReading
{
    use Importable;

    public function model(array $row)
    {
        return new Employee([
            'name' => $row[0],
            'email' => $row[1],
            'company_id' => $row[2]
        ]);
    }

    public function chunkSize(): int
    {
        return 10; // Chunk per 10 rows
    }
}
