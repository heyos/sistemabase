<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Dfilejs_menu extends Model
{
    //
    protected $table = 'dfilejs_menu';
    protected $primaryKey = 'id';

    public static function scriptsModel($idMenu){

        $sql = DB::table('filejs AS f')
                ->join('dfilejs_menu AS d','d.file_id','=','f.id')
                ->select('f.descripcion')
                ->where('d.menu_id',$idMenu)->get();

        return $sql;               

    }
}
