<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected PatientService $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    /**
     * Exibe a listagem de pacientes, com suporte a busca por termo.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $patients = $this->patientService->getPatientsList($search);

        return view('patients.index', compact('patients'));
    }

    /**
     * Exibe o formulário de cadastro de um novo paciente.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Armazena um novo paciente no banco de dados.
     */
    public function store(StorePatientRequest $request)
    {
        $this->patientService->createPatient(
            $request->validated(),
            $request->file('profile_image')
        );

        return redirect()->route('patients.index')
            ->with('success', 'Paciente cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um paciente específico.
     */
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    /**
     * Exibe o formulário de edição de um paciente.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Atualiza os dados de um paciente no banco de dados.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $this->patientService->updatePatient(
            $patient,
            $request->validated(),
            $request->file('profile_image')
        );

        return redirect()->route('patients.index')
            ->with('success', 'Paciente atualizado com sucesso!');
    }

    /**
     * Remove o paciente do sistema (soft delete).
     */
    public function destroy(Patient $patient)
    {
        $this->patientService->deletePatient($patient);

        return redirect()->route('patients.index')
            ->with('success', 'Paciente excluído com sucesso!');
    }
}
