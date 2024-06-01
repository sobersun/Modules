<?php

namespace App\Modules\Events\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'method', // Add this line
        'url',
        'model_class',
        'event',
        'model_id',
        'attribute_data',
        'extra',
        'state_id',
        'type_id',
        'created_by_id',
    ];
}
