<?php

use App\AccesoPerfilMenu;
use App\Dfilejs_menu AS DetalleFile;
use App\Menu;
use App\Perfil;
use App\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

function actionRouteName(){

    //nos retorna el path de la ruta dinamica
    $action = Request::path();


    return $action;
}

function menudata(){

    $user = Auth::user();
    $idPerfil = $user->perfil_id;

    $data = array();
    $id = 0;

    $menu = Menu::data()->get();

    foreach ($menu as $attr) {
        $id = $attr -> id;
        $slug = $attr->slug == ''?'#':$attr->slug;
        $acceso = AccesoPerfilMenu::menuAcceso($idPerfil,$id)->first();

        $dataSub = submenudata($id);

        if(!empty($acceso)){
            $data[] = array('id'=>$id,
                            'slug'=>$slug,
                            'icono'=>$attr->icono,
                            'nombre'=>$attr->nombre,
                            'sub'=>$dataSub);
        }
            

    }

    return $data;

}

function submenudata($idMenu){

    $data = array();

    $user = Auth::user();
    $idPerfil = $user->perfil_id;
    
    $subMenu = Menu::submenu($idMenu)->get();

    if(!empty($subMenu)){
        foreach ($subMenu as $attr) {
            $id = $attr -> id;
            $slug = $attr->slug;
            $acceso = AccesoPerfilMenu::menuAcceso($idPerfil,$id)->first();

            if(!empty($acceso)){
                $data[] = array('idSub' => $id,
                                'nombre' => $attr->nombre,
                                'nombreLargo' => $attr->nombre_largo,
                                'slug'=>$slug);
            }
        }
    }

    return $data;

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