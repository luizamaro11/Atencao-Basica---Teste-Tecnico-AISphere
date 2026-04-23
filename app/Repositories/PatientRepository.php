<?php

namespace App\Repositories;

use App\Interfaces\PatientRepositoryInterface;
use App\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PatientRepository implements PatientRepositoryInterface
{
    /**
     * Retorna a listagem paginada de pacientes.
     * Aplica filtro de busca por nome ou e-mail, se informado.
     */
    public function getAllPaginated(string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Patient::with('createdBy')->latest();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /** Busca um paciente específico pelo ID. */
    public function findById(int $id): ?Patient
    {
        return Patient::find($id);
    }

    /** Persiste um novo paciente no banco de dados. */
    public function create(array $data): Patient
    {
        return Patient::create($data);
    }

    /** Atualiza os campos de um paciente existente. */
    public function update(Patient $patient, array $data): bool
    {
        return $patient->update($data);
    }

    /** Executa o soft delete do paciente (mantém o registro no banco). */
    public function delete(Patient $patient): bool
    {
        return $patient->delete();
    }
}
