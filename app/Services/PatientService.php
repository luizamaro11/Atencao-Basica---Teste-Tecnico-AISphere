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

    public function getPatientsList(string $search = null): LengthAwarePaginator
    {
        return $this->patientRepository->getAllPaginated($search, 10);
    }

    public function createPatient(array $data, ?\Illuminate\Http\UploadedFile $profileImage): Patient
    {
        if ($profileImage) {
            $data['profile_image'] = $profileImage->store('patients', 'public');
        }

        $data['created_by_id'] = auth()->id();

        return $this->patientRepository->create($data);
    }

    public function updatePatient(Patient $patient, array $data, ?\Illuminate\Http\UploadedFile $profileImage): bool
    {
        if ($profileImage) {
            $data['profile_image'] = $profileImage->store('patients', 'public');
            // Nota: Em um ambiente real, poderíamos apagar a imagem antiga do storage aqui.
        }

        return $this->patientRepository->update($patient, $data);
    }

    public function deletePatient(Patient $patient): bool
    {
        return $this->patientRepository->delete($patient);
    }
}
