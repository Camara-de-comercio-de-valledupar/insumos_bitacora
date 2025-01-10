<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GastoVariado extends Model
{
    protected $table = 'gasto_variado';
    protected $fillable = ['descripción'];
    public $timestamps = false;
}
