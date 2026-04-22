<?php

namespace App\Interfaces;

use App\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PatientRepositoryInterface
{
    public function getAllPaginated(string $search = null, int $perPage = 10): LengthAwarePaginator;
    public function findById(int $id): ?Patient;
    public function create(array $data): Patient;
    public function update(Patient $patient, array $data): bool;
    public function delete(Patient $patient): bool;
}
