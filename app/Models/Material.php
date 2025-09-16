<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Material extends Model
{
    protected $fillable = [
        'name', 'image', 'description', 'clasification', 'aptitude', 'type_category'
    ];
}
