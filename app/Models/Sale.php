<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'idUser',
        'idClient',
        'pay',
        'total',
        'state',
        'updated_by',
    ];

    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(Detail::class, 'idSale');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    // Usuario que actualizó la venta
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    

    public function client()
    {
        return $this->belongsTo(User::class, 'idClient');
    }
    
}
