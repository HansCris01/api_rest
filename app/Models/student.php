<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class student extends Model
{
    use HasFactory;
    protected $table='students';
    protected $primarykey="id";
    protected $fillable=[
    'id',
    'first_name',
    'last_name',
    'email',
    'phone',
    'birth_date',
    'enrollment_date',
    'status',
    ];
}
