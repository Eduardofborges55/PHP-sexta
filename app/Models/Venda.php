<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venda extends Model
{
 protected $table = 'vendas';
 protected $primaryKey = 'id';


    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    public function ingresso(): BelongsTo
    {
        return $this->belongsTo(ingressos::class);
    }
    public $timestamps = false;
}
?>
