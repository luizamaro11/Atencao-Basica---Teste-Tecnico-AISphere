<?php

namespace App\Interfaces;

use App\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PatientRepositoryInterface
{
    /** Retorna a listagem paginada de pacientes, com suporte a busca textual. */
    public function getAllPaginated(string $search = null, int $perPage = 10): LengthAwarePaginator;

    /** Busca um paciente pelo seu ID. Retorna null se não encontrado. */
    public function findById(int $id): ?Patient;

    /** Cria e persiste um novo paciente no banco de dados. */
    public function create(array $data): Patient;

    /** Atualiza os dados de um paciente existente. */
    public function update(Patient $patient, array $data): bool;

    /** Remove o paciente do banco de dados (soft delete). */
    public function delete(Patient $patient): bool;
}
