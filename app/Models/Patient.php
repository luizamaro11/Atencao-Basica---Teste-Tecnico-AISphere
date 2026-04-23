<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model que representa um Paciente no sistema PrimaryCare.
 * Utiliza SoftDeletes para exclusão lógica, preservando o histórico no banco de dados.
 */
class Patient extends Model
{
    use HasFactory, SoftDeletes;

    /** Campos que podem ser preenchidos via mass assignment. */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'profile_image',
        'created_by_id',
    ];

    /** Cast automático do campo de data de nascimento para objeto Carbon. */
    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Relacionamento: paciente pertence a um usuário cadastrador.
     * Permite rastrear quem registrou cada paciente no sistema.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
