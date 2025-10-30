<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ingressos extends Model
{
    protected $table = 'ingressos';
    protected $primaryKey = 'id';

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }
    public $timestamps = false;
    // created_at and updated_at são desativados
    // created at e updated at are disabled
    // created_at e updated_at = boa pratica criar!
    // created_at and updated_at = good practice to create!
}

?>