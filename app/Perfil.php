<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
    use SoftDeletes;
    //
    protected $table = 'perfil';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 'is_root',
    ];

    protected $dates = ['deleted_at'];
    
    public function scopeInfoPerfil($query,$id){
        return $query -> where('id',$id);
    }

    public function users(){

        return $this->hasMany(User::class,'perfil_id');
    }

    public function pageInicio(){
        return $this->belongsTo(Menu::class,'page_default','vista_blade');
    }

    public function accesosPerfil(){
        return $this->hasMany(AccesoPerfilMenu::class,'perfil_id');
    }
}
