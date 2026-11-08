<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


   namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    // Les champs que l'on autorise à être remplis en masse
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
        'quantity',
        'unit',
        'price_per_unit',
        'status',
    ];

    /**
     * Un produit appartient à un utilisateur (l'agriculteur).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); //
}
}
