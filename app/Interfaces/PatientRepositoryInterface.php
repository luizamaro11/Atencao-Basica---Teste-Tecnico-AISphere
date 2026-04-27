<?php

namespace App\Interfaces;

use App\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Contrato que define as operações de acesso ao banco de dados para Pacientes.
 * Garante a Inversão de Dependência (SOLID - letra D).
 */
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
