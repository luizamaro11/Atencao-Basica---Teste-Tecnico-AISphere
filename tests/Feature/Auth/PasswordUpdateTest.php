<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('password can be updated', function () {
    $user = User::factory()->create();

    // 'Nova@Senha123' satisfaz todas as regras: 8+ chars, maiúscula, minúscula, número, símbolo
    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->put('/password', [
            'current_password'      => 'password',
            'password'              => 'Nova@Senha123',
            'password_confirmation' => 'Nova@Senha123',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->assertTrue(Hash::check('Nova@Senha123', $user->refresh()->password));
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->put('/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasErrorsIn('updatePassword', 'current_password')
        ->assertRedirect('/profile');
});
