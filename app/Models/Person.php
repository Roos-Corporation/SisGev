<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf',
        'first_name',
        'last_name',
        'accounting',
        'date_of_birth',
        'gender',
        'status'
    ];
}
