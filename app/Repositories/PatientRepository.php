<?php

namespace App\Repositories;

use App\Interfaces\PatientRepositoryInterface;
use App\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PatientRepository implements PatientRepositoryInterface
{
    public function getAllPaginated(string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Patient::with('createdBy')->latest();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    public function findById(int $id): ?Patient
    {
        return Patient::find($id);
    }

    public function create(array $data): Patient
    {
        return Patient::create($data);
    }

    public function update(Patient $patient, array $data): bool
    {
        return $patient->update($data);
    }

    public function delete(Patient $patient): bool
    {
        return $patient->delete();
    }
}
