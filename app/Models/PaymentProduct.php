<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProduct extends Model
{
    use HasFactory;

    protected $table = 'payment_products'; // Nombre real de la tabla
    protected $primaryKey = 'id';

    protected $fillable = [
        'idFertilizer',
        'idUser',
        'idClient',
        'amount',
        'subtotal',
        'image',
        'state',
        'observations',
        'updated_by',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'idClient', 'id');
    }
     public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Fertilizer::class, 'idFertilizer', 'id');
    }
}
