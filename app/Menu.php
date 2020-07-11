<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = 'menu';
    protected $primaryKey = 'id';

    public function scopeData($query){

        return $query->where('padre','0')->orderBy('order');
    }

    public function scopeSubMenu($query,$idMenu){

        return $query->where('padre',$idMenu)->orderBy('order');
    }

    public function scopeDataMenu($query,$slug){

        return $query->where('slug',$slug) ;
    }

    public function scopeDataMenuId($query,$idMenu){

        return $query->where('id',$idMenu) ;
    }

    public function scopeDataCustomColumns($query,$where){
        return $query->where($where)->orderBy('nombre');
    }

    public function perfiles(){
        return $this->hasMany(Perfil::class,'page_default','vista_blade');
    }


}
