<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccesoPerfilMenu extends Model
{
    //
    use SoftDeletes;
    protected $table = "acceso_perfil_menu";

    protected $dates = ['deleted_at'];

    public static function menuAcceso(){

        
    }
}
