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

}
