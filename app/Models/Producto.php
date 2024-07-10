<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    public function categoria(): BelongsTo{
        return $this->belongsTo(Categoria::class);
    }


    public function pedidos(){
        return $this->belongsToMany(Pedido::class);
    }

}
