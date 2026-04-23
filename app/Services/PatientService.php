<?php

namespace App\Services;

use App\Interfaces\PatientRepositoryInterface;
use App\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
class PatientService
{
    protected $patientRepository;

    public function __construct(PatientRepositoryInterface $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * Retorna a lista paginada de pacientes, com suporte a busca por termo.
     */
    public function getPatientsList(string $search = null): LengthAwarePaginator
    {
        return $this->patientRepository->getAllPaginated($search, 10);
    }

    /**
     * Cria um novo paciente.
     * Realiza o upload da foto de perfil, se fornecida, e associa ao usuário autenticado.
     */
    public function createPatient(array $data, ?\Illuminate\Http\UploadedFile $profileImage): Patient
    {
        if ($profileImage) {
            // Armazena a imagem no disco 'public' dentro da pasta 'patients'
            $data['profile_image'] = $profileImage->store('patients', 'public');
        }

        // Registra o ID do usuário que está criando o paciente
        $data['created_by_id'] = auth()->id();

        return $this->patientRepository->create($data);
    }

    /**
     * Atualiza os dados de um paciente existente.
     * Substitui a foto de perfil se uma nova for enviada.
     */
    public function updatePatient(Patient $patient, array $data, ?\Illuminate\Http\UploadedFile $profileImage): bool
    {
        if ($profileImage) {
            $data['profile_image'] = $profileImage->store('patients', 'public');
            // Em um ambiente de produção, a imagem antiga deve ser removida do storage aqui.
        }

        return $this->patientRepository->update($patient, $data);
    }

    /**
     * Remove um paciente do sistema (soft delete via repositório).
     */
    public function deletePatient(Patient $patient): bool
    {
        return $this->patientRepository->delete($patient);
    }
}
