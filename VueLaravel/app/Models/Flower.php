<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flower extends Model
{
    protected $table = 'flowers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'type',
        'price',
    ];
    use HasFactory;
}
