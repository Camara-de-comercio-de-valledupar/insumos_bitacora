<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    protected $table = 'evidencias';
    protected $fillable = ['nombre', 'ruta', 'evidenciable_id', 'evidenciable_type'];
    public $timestamps = false;

    public function evidenciable()
    {
        return $this->morphTo();
    }
}
