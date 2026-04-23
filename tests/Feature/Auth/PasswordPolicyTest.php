<?php

/**
 * Testes de Feature — Política de Senhas (PasswordPolicyTest)
 *
 * Cobre as regras centralizadas em AppServiceProvider::boot() via Password::defaults():
 *  - Mínimo 8 caracteres
 *  - Máximo 64 caracteres
 *  - Letras maiúsculas e minúsculas (mixedCase)
 *  - Pelo menos 1 número (numbers)
 *  - Pelo menos 1 caractere especial (symbols)
 *
 * Os três endpoints testados são:
 *  - POST /register          → RegisteredUserController
 *  - POST /reset-password    → NewPasswordController
 *  - PUT  /password          → PasswordController (perfil)
 */

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

// ---------------------------------------------------------------------------
// Helpers
// ---------------------------------------------------------------------------

/**
 * Senha válida que satisfaz todas as regras do Password::defaults():
 * comprimento 8+, maiúscula, minúscula, número, símbolo.
 */
function validPassword(): string
{
    return 'Senha@123';
}

// ---------------------------------------------------------------------------
// 1. REGISTRO (/register) — POST
// ---------------------------------------------------------------------------

describe('Registro — regras de senha', function () {

    it('aceita uma senha válida no registro', function () {
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => validPassword(),
            'password_confirmation' => validPassword(),
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('dashboard', absolute: false));

        $this->assertAuthenticated();
    });

    it('rejeita senha sem maiúscula no registro', function () {
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => 'senha@123',        // sem maiúscula
            'password_confirmation' => 'senha@123',
        ])->assertSessionHasErrors('password');

        $this->assertGuest();
    });

    it('rejeita senha sem minúscula no registro', function () {
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => 'SENHA@123',        // sem minúscula
            'password_confirmation' => 'SENHA@123',
        ])->assertSessionHasErrors('password');

        $this->assertGuest();
    });

    it('rejeita senha sem número no registro', function () {
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => 'Senha@abc',        // sem número
            'password_confirmation' => 'Senha@abc',
        ])->assertSessionHasErrors('password');

        $this->assertGuest();
    });

    it('rejeita senha sem símbolo especial no registro', function () {
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => 'SenhaABC123',      // sem símbolo
            'password_confirmation' => 'SenhaABC123',
        ])->assertSessionHasErrors('password');

        $this->assertGuest();
    });

    it('rejeita senha com menos de 8 caracteres no registro', function () {
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => 'S@1a',             // apenas 4 chars
            'password_confirmation' => 'S@1a',
        ])->assertSessionHasErrors('password');

        $this->assertGuest();
    });

    it('rejeita senha com mais de 64 caracteres no registro', function () {
        $senha = 'Aa1@' . str_repeat('x', 61); // 65 chars
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => $senha,
            'password_confirmation' => $senha,
        ])->assertSessionHasErrors('password');

        $this->assertGuest();
    });

    it('rejeita quando a confirmação não confere no registro', function () {
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => validPassword(),
            'password_confirmation' => 'OutraSenha@456',
        ])->assertSessionHasErrors('password');

        $this->assertGuest();
    });

    it('rejeita senha em branco no registro', function () {
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => '',
            'password_confirmation' => '',
        ])->assertSessionHasErrors('password');

        $this->assertGuest();
    });

    it('aceita exatamente 8 caracteres válidos no registro (limite mínimo)', function () {
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => 'Aa1@abcd',         // exatamente 8
            'password_confirmation' => 'Aa1@abcd',
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('dashboard', absolute: false));

        $this->assertAuthenticated();
    });

    it('aceita exatamente 64 caracteres válidos no registro (limite máximo)', function () {
        $senha = 'Aa1@' . str_repeat('b', 60); // 64 chars
        $this->post('/register', [
            'name'                  => 'Usuário Teste',
            'email'                 => 'usuario@teste.com',
            'password'              => $senha,
            'password_confirmation' => $senha,
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('dashboard', absolute: false));

        $this->assertAuthenticated();
    });
});

// ---------------------------------------------------------------------------
// 2. REDEFINIÇÃO DE SENHA (/reset-password) — POST
// ---------------------------------------------------------------------------

describe('Redefinição de Senha — regras de senha', function () {

    /**
     * Solicita token de redefinição e retorna ($user, $token).
     */
    function requestResetToken(): array
    {
        Notification::fake();
        $user = User::factory()->create();
        app('Illuminate\Contracts\Auth\PasswordBroker')->sendResetLink(['email' => $user->email]);

        $token = null;
        Notification::assertSentTo($user, ResetPassword::class, function ($n) use (&$token) {
            $token = $n->token;
            return true;
        });

        return [$user, $token];
    }

    it('aceita uma senha válida no reset', function () {
        [$user, $token] = requestResetToken();

        $this->post('/reset-password', [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => validPassword(),
            'password_confirmation' => validPassword(),
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('login'));
    });

    it('rejeita senha sem maiúscula no reset', function () {
        [$user, $token] = requestResetToken();

        $this->post('/reset-password', [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => 'senha@123',
            'password_confirmation' => 'senha@123',
        ])->assertSessionHasErrors('password');
    });

    it('rejeita senha sem minúscula no reset', function () {
        [$user, $token] = requestResetToken();

        $this->post('/reset-password', [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => 'SENHA@123',
            'password_confirmation' => 'SENHA@123',
        ])->assertSessionHasErrors('password');
    });

    it('rejeita senha sem número no reset', function () {
        [$user, $token] = requestResetToken();

        $this->post('/reset-password', [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => 'Senha@abc',
            'password_confirmation' => 'Senha@abc',
        ])->assertSessionHasErrors('password');
    });

    it('rejeita senha sem símbolo especial no reset', function () {
        [$user, $token] = requestResetToken();

        $this->post('/reset-password', [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => 'SenhaABC123',
            'password_confirmation' => 'SenhaABC123',
        ])->assertSessionHasErrors('password');
    });

    it('rejeita senha com menos de 8 caracteres no reset', function () {
        [$user, $token] = requestResetToken();

        $this->post('/reset-password', [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => 'S@1a',
            'password_confirmation' => 'S@1a',
        ])->assertSessionHasErrors('password');
    });

    it('rejeita senha com mais de 64 caracteres no reset', function () {
        [$user, $token] = requestResetToken();
        $senha = 'Aa1@' . str_repeat('x', 61);

        $this->post('/reset-password', [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => $senha,
            'password_confirmation' => $senha,
        ])->assertSessionHasErrors('password');
    });

    it('rejeita quando a confirmação não confere no reset', function () {
        [$user, $token] = requestResetToken();

        $this->post('/reset-password', [
            'token'                 => $token,
            'email'                 => $user->email,
            'password'              => validPassword(),
            'password_confirmation' => 'OutraSenha@456',
        ])->assertSessionHasErrors('password');
    });
});

// ---------------------------------------------------------------------------
// 3. ATUALIZAÇÃO DE SENHA NO PERFIL (/password) — PUT
// ---------------------------------------------------------------------------

describe('Atualização de Senha (Perfil) — regras de senha', function () {

    it('aceita uma senha válida na atualização do perfil', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'password',    // senha padrão do factory
                'password'              => validPassword(),
                'password_confirmation' => validPassword(),
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertTrue(Hash::check(validPassword(), $user->refresh()->password));
    });

    it('rejeita senha sem maiúscula na atualização do perfil', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'password',
                'password'              => 'senha@123',
                'password_confirmation' => 'senha@123',
            ])
            ->assertSessionHasErrorsIn('updatePassword', 'password');
    });

    it('rejeita senha sem minúscula na atualização do perfil', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'password',
                'password'              => 'SENHA@123',
                'password_confirmation' => 'SENHA@123',
            ])
            ->assertSessionHasErrorsIn('updatePassword', 'password');
    });

    it('rejeita senha sem número na atualização do perfil', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'password',
                'password'              => 'Senha@abc',
                'password_confirmation' => 'Senha@abc',
            ])
            ->assertSessionHasErrorsIn('updatePassword', 'password');
    });

    it('rejeita senha sem símbolo especial na atualização do perfil', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'password',
                'password'              => 'SenhaABC123',
                'password_confirmation' => 'SenhaABC123',
            ])
            ->assertSessionHasErrorsIn('updatePassword', 'password');
    });

    it('rejeita senha com menos de 8 caracteres na atualização do perfil', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'password',
                'password'              => 'S@1a',
                'password_confirmation' => 'S@1a',
            ])
            ->assertSessionHasErrorsIn('updatePassword', 'password');
    });

    it('rejeita senha com mais de 64 caracteres na atualização do perfil', function () {
        $user = User::factory()->create();
        $senha = 'Aa1@' . str_repeat('x', 61);

        $this->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'password',
                'password'              => $senha,
                'password_confirmation' => $senha,
            ])
            ->assertSessionHasErrorsIn('updatePassword', 'password');
    });

    it('rejeita quando a confirmação não confere na atualização do perfil', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'password',
                'password'              => validPassword(),
                'password_confirmation' => 'OutraSenha@456',
            ])
            ->assertSessionHasErrorsIn('updatePassword', 'password');
    });

    it('rejeita quando a senha atual está incorreta', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'senha-errada',
                'password'              => validPassword(),
                'password_confirmation' => validPassword(),
            ])
            ->assertSessionHasErrorsIn('updatePassword', 'current_password');
    });

    it('não altera a senha quando a validação falha', function () {
        $user = User::factory()->create();
        $senhaOriginal = 'password'; // senha padrão do factory

        $this->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => $senhaOriginal,
                'password'              => 'fraca',        // falha em múltiplas regras
                'password_confirmation' => 'fraca',
            ])
            ->assertSessionHasErrorsIn('updatePassword', 'password');

        // A senha no banco NÃO deve ter mudado
        $this->assertTrue(Hash::check($senhaOriginal, $user->refresh()->password));
    });
});
