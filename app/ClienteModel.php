<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id', 'nombres','apellidos','telefono','saldo'
    ];
}
