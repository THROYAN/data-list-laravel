<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bedroom_count',
        'bathroom_count',
        'storey_count',
        'garage_count',
        'price',
    ];
}
