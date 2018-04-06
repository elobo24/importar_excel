<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encargos extends Model
{
  protected $table = 'encargos';
  protected $primarykey = 'id';
  public $timestamps = false;

  protected $fillable = [
    'id','albaran','destinatario','direccion','poblacion','cp','provincia','telefono','observaciones','fecha'
  ];
}
