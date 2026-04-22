<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'profile_image',
        'created_by_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
