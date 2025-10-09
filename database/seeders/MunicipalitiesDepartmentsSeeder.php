<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class MunicipalitiesDepartmentsSeeder extends Seeder
{
    public function run(): void
    {
        $csvPath = database_path('seeders/departamentos_zona_norte_nicaragua.csv');
        if (!is_file($csvPath)) {
            throw new \RuntimeException("CSV not found at: {$csvPath}");
        }
        
        $now = now();

        // Helper to stream CSV as LazyCollection of associative rows
        $readCsv = function (string $path): LazyCollection {
            return LazyCollection::make(function () use ($path) {
                $handle = fopen($path, 'r');
                if (!$handle) {
                    throw new \RuntimeException("Cannot open CSV: {$path}");
                }
                $header = null;
                while (($data = fgetcsv($handle, 0, ',')) !== false) {
                    if ($header === null) {
                        $header = $data;
                        continue;
                    }
                    if (!$data || $header === null || count($data) !== count($header)) {
                        continue; // skip malformed/empty lines
                    }
                    yield array_combine($header, $data);
                }
                fclose($handle);
            });
        };

        // 1) Upsert Departments
        $deptNames = [];
        $readCsv($csvPath)->each(function ($row) use (&$deptNames) {
            $dep = isset($row['Departamento']) ? trim($row['Departamento']) : '';
            if ($dep !== '') {
                $deptNames[$dep] = true; // unique set
            }
        });

        $deptPayload = [];
        foreach (array_keys($deptNames) as $name) {
            $deptPayload[] = [
                'name' => $name,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        if (!empty($deptPayload)) {
            DB::table('departments')->upsert($deptPayload, ['name'], ['updated_at']);
        }

        // Build name => id map
        $deptIdMap = DB::table('departments')
            ->whereIn('name', array_keys($deptNames))
            ->pluck('id', 'name')
            ->all();

        // 2) Upsert Municipalities in chunks
        $batch = [];
        $batchSize = 500;

        $flush = function () use (&$batch, $batchSize) {
            if (!empty($batch)) {
                DB::table('municipalities')->upsert($batch, ['department_id', 'name'], ['updated_at']);
                $batch = [];
            }
        };

        $readCsv($csvPath)->each(function ($row) use (&$batch, $batchSize, $flush, $deptIdMap, $now) {
            $dep = isset($row['Departamento']) ? trim($row['Departamento']) : '';
            $mun = isset($row['Municipio']) ? trim($row['Municipio']) : '';
            if ($dep === '' || $mun === '') {
                return; // skip incomplete rows
            }
            $departmentId = $deptIdMap[$dep] ?? null;
            if (!$departmentId) {
                return; // safety: skip if department didn't map
            }
            $batch[] = [
                'department_id' => $departmentId,
                'name' => $mun,
                'created_at' => $now,
                'updated_at' => $now,
            ];
            if (count($batch) >= $batchSize) {
                $flush();
            }
        });

        $flush();
    }
}