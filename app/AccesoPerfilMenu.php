<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class AccesoPerfilMenu extends Model
{
    //
    use SoftDeletes;
    protected $table = "acceso_perfil_menu";

    protected $dates = ['deleted_at'];

    static public  function menuAcceso($perfilId,$menuId){

        $query = DB::table('acceso_perfil_menu')
                ->where('acceso','=','1')
                ->where('menu_id','=',$menuId)
                ->where('perfil_id','=',$perfilId)
                ;

        return $query;
        
    }

    
}
