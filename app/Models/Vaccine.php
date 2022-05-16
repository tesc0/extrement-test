<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'sku',
        'arrival',
        'amount',
        'user_id'
    ];
}
