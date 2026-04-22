<?php

use App\Models\Patient;
use App\Models\User;

test('patients list page is displayed to authenticated users', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/patients');

    $response->assertOk();
    $response->assertSee('Pacientes');
});

test('unauthenticated users cannot view patients list', function () {
    $response = $this->get('/patients');

    $response->assertRedirect('/login');
});

test('authenticated users can create a patient', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post('/patients', [
            'name' => 'João da Silva',
            'email' => 'joao@example.com',
            'phone' => '11999999999',
            'birth_date' => '1990-01-01',
        ]);

    $response->assertRedirect('/patients');
    $response->assertSessionHas('success', 'Paciente cadastrado com sucesso!');

    $this->assertDatabaseHas('patients', [
        'name' => 'João da Silva',
        'email' => 'joao@example.com',
        'created_by_id' => $user->id,
    ]);
});

test('cannot create patient with existing email', function () {
    $user = User::factory()->create();
    Patient::factory()->create(['email' => 'joao@example.com']);

    $response = $this
        ->actingAs($user)
        ->post('/patients', [
            'name' => 'João Clone',
            'email' => 'joao@example.com',
        ]);

    $response->assertSessionHasErrors(['email']);
    
    $this->assertDatabaseMissing('patients', [
        'name' => 'João Clone',
    ]);
});

test('authenticated users can update a patient', function () {
    $user = User::factory()->create();
    $patient = Patient::factory()->create(['name' => 'Old Name', 'created_by_id' => $user->id]);

    $response = $this
        ->actingAs($user)
        ->put('/patients/' . $patient->id, [
            'name' => 'New Name',
            'email' => 'new@example.com',
            'phone' => '11888888888',
        ]);

    $response->assertRedirect('/patients');
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('patients', [
        'id' => $patient->id,
        'name' => 'New Name',
        'email' => 'new@example.com',
    ]);
});

test('authenticated users can delete a patient (soft delete)', function () {
    $user = User::factory()->create();
    $patient = Patient::factory()->create(['created_by_id' => $user->id]);

    $response = $this
        ->actingAs($user)
        ->delete('/patients/' . $patient->id);

    $response->assertRedirect('/patients');
    $response->assertSessionHas('success');

    // Verifica que sofreu soft delete (deleted_at não é nulo)
    $this->assertSoftDeleted('patients', [
        'id' => $patient->id,
    ]);
});
