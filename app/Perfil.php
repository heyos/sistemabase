<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //
    protected $table = 'Perfil';
    protected $primaryKey = 'id';

    public function scopeInfoPerfil($query,$id){
        return $query -> where('id',$id);
    }
}
