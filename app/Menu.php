<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = 'menu';
    protected $primaryKey = 'id';

    public function scopeData($query){

        return $query->where('padre','0');
    }

    public function scopeSubMenu($query,$idMenu){

        return $query->where('padre',$idMenu);
    }

}
