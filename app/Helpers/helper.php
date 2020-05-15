<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
use App\Perfil;
use App\Menu;
use App\Dfilejs_menu AS DetalleFile;

function menudata(){

    $user = Auth::user();
    $idPerfil = $user->perfil_id;

    // return $idPerfil;

    $menu = Menu::data()->get();

    return $menu;

}

function submenudata($idMenuRuta){

    $menu = Menu::where('default',1)->first();
    $idMenu = $menu->id;
    
    if($idMenuRuta != ''){
        $menu = Menu::where('id',$idMenuRuta)->first();
        
        if(!empty($menu->id)){
            $idMenu = $menu->id;
        }
    }
    
    $subMenu = Menu::submenu($idMenu)->get();

    return $subMenu;

}

function is_root(){
    $user = Auth::user();
    $idPerfil = $user->perfil_id;

    $perfil = Perfil::findOrFail($idPerfil);

    $response = 0;

    if(!empty($perfil->is_root)){
        $response = $perfil->is_root;
    }

    return $response;

}

function routeName(){

    $slug = Route::currentRouteName();

    $slug = $slug==''?'Inicio':$slug;
    $slug = strtoupper($slug);

    return $slug;
}

function filescripts($idMenu){
    
    $files = DetalleFile::scriptsModel($idMenu);
    $str = '';
    if(count($files) > 0){
        foreach ($files as $key => $script) {
            $str .= '<script src="'.asset('js/main/'.$script->descripcion).'"></script>';
        }
    }
    
    return $str;
}

function user_ref(){

    $auth = Auth::user();
    $id = $auth->id;
    $user_id = $auth->user_ref_id;

    if(empty($user_id)){
        $user_id = $id;
    }

    return $user_id;
}