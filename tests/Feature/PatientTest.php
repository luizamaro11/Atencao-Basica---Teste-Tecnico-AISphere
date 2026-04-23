<?php

use App\Models\Patient;
use App\Models\User;

// ============================================================
// Testes de autorização e listagem de pacientes
// ============================================================

test('a página de listagem é exibida para usuários autenticados', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/patients');

    $response->assertOk();
    $response->assertSee('Pacientes');
});

test('usuários não autenticados são redirecionados para o login', function () {
    $response = $this->get('/patients');

    $response->assertRedirect('/login');
});

// ============================================================
// Testes de criação de paciente
// ============================================================

test('usuário autenticado pode cadastrar um novo paciente', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post('/patients', [
            'name'       => 'João da Silva',
            'email'      => 'joao@example.com',
            'phone'      => '11999999999',
            'birth_date' => '1990-01-01',
        ]);

    $response->assertRedirect('/patients');
    $response->assertSessionHas('success', 'Paciente cadastrado com sucesso!');

    // Verifica que o registro foi criado no banco de dados
    $this->assertDatabaseHas('patients', [
        'name'          => 'João da Silva',
        'email'         => 'joao@example.com',
        'created_by_id' => $user->id,
    ]);
});

test('não é possível cadastrar paciente com e-mail já existente', function () {
    $user = User::factory()->create();
    Patient::factory()->create(['email' => 'joao@example.com']);

    $response = $this
        ->actingAs($user)
        ->post('/patients', [
            'name'  => 'João Clone',
            'email' => 'joao@example.com',
        ]);

    $response->assertSessionHasErrors(['email']);
    
    // Confirma que o registro duplicado não foi inserido
    $this->assertDatabaseMissing('patients', [
        'name' => 'João Clone',
    ]);
});

// ============================================================
// Testes de atualização de paciente
// ============================================================

test('usuário autenticado pode atualizar os dados de um paciente', function () {
    $user    = User::factory()->create();
    $patient = Patient::factory()->create(['name' => 'Nome Antigo', 'created_by_id' => $user->id]);

    $response = $this
        ->actingAs($user)
        ->put('/patients/' . $patient->id, [
            'name'  => 'Nome Novo',
            'email' => 'novo@example.com',
            'phone' => '11888888888',
        ]);

    $response->assertRedirect('/patients');
    $response->assertSessionHas('success');

    // Verifica que os novos dados foram persistidos corretamente
    $this->assertDatabaseHas('patients', [
        'id'    => $patient->id,
        'name'  => 'Nome Novo',
        'email' => 'novo@example.com',
    ]);
});

// ============================================================
// Testes de exclusão de paciente (soft delete)
// ============================================================

test('usuário autenticado pode excluir um paciente (soft delete)', function () {
    $user    = User::factory()->create();
    $patient = Patient::factory()->create(['created_by_id' => $user->id]);

    $response = $this
        ->actingAs($user)
        ->delete('/patients/' . $patient->id);

    $response->assertRedirect('/patients');
    $response->assertSessionHas('success');

    // Verifica que o soft delete foi aplicado (deleted_at preenchido, registro mantido)
    $this->assertSoftDeleted('patients', [
        'id' => $patient->id,
    ]);
});
