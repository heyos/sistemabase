<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
    use SoftDeletes;
    //
    protected $table = 'Perfil';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 'page_default', 'is_root',
    ];

    
    public function scopeInfoPerfil($query,$id){
        return $query -> where('id',$id);
    }

    public function users(){

        return $this->hasMany(User::class,'perfil_id');
    }
}
