<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'details';

    protected $fillable = [
        'idSale',
        'idFertilizer',
        'amout',
        'subtotal'
    ];
    public $timestamps = false;

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'idSale');
    }

    public function fertilizer()
{
    return $this->belongsTo(Fertilizer::class, 'idFertilizer');
}

}
