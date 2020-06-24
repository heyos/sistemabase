<?php

use App\AccesoPerfilMenu;
use App\Dfilejs_menu AS DetalleFile;
use App\Menu;
use App\Perfil;
use App\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

function menudata(){

    $user = Auth::user();
    $idPerfil = $user->perfil_id;

    $data = array();
    $id = 0;

    if(!session()->has('menudata')){

        $menu = Menu::data()->get();

        foreach ($menu as $attr) {
            $id = $attr -> id;
            $slug = $attr->slug == ''?'#':$attr->slug;
            $acceso = AccesoPerfilMenu::menuAcceso($idPerfil,$id)->first();

            $dataSub = submenudata($id,$idPerfil);

            if(!empty($acceso)){
                $data[] = array('id'=>$id,
                                'slug'=>$slug,
                                'icono'=>$attr->icono,
                                'nombre'=>$attr->nombre,
                                'sub'=>$dataSub);
            }
        }

        session(['menudata'=>$data]);
    }else{
        $data = session('menudata');
    }

        

    return $data;

}

function submenudata($idMenu,$idPerfil){

    $data = array();

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
    
    $files = DetalleFile::scriptsModel($idMenu)->get();
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

//*************************************************************
// FUNCIONES PARA VALIDAR ACCESOS DINAMICOS A LAS RUTAS
//************************************************************

//nos retorna el path de la ruta dinamica
function actionPath(){

    $action = Request::path();

    $slug = $action;
    $data = array();
    if(strpos($action,'/') !== false){
        $data = explode('/',$action);
        $slug = $data[0];

    }

    return $slug;

}

//retorna el menu de navegacion activo
function activeMenu(){

    $slug = actionPath();
    $parts = array();

    if(empty($slug)){
        $perfil = Auth::user()->perfil;
        $page_default = $perfil->page_default;
        $parts = explode('.',$page_default);
        $slug = $parts[1];
    }

    $menu = Menu::dataMenu($slug)->first();
    $idMenuPadre = $menu->padre;
    $idMenu = $menu->id;
    $padre = '';
    $hijo = '';

    $datos = array();

    if($idMenuPadre != 0){
        $padre = $idMenuPadre;
        $hijo = $idMenu;
    }else{
        $padre = $idMenu;
    }

    $datos = array('padre' => $padre,
                    'hijo' => $hijo);

    return $datos;
}

//verifica que la ruta sea valida para el acceso segun el perfil
function verifyAccessRoute($slug){

    $response = false;
    
    $menu = Menu::dataMenu($slug)->first();

    if(!empty($menu)){
        $idMenu = $menu->id;
        $perfil = Auth::user()->perfil_id;

        $acceso = AccesoPerfilMenu::menuAcceso($perfil,$idMenu)->first();

        if(!empty($acceso)){
            $response =  true;
        }
    }
        
    return $response;
}

//obtener los permisos otorgados para esta ruta segun el perfil
function permisos($slug,$action){

    $menu = Menu::dataMenu($slug)->first();
    $permisos = array();
    $mantenimiento = "";
    $respuesta = false;
        
    if(!empty($menu)){
        $idMenu = $menu->id;
        $user = Auth::user();
        $perfil = $user->perfil_id;
        
        $acceso = AccesoPerfilMenu::menuAcceso($perfil,$idMenu)->first();

        if(!empty($acceso)){

            $mantenimiento = $acceso->mantenimiento;

            if(!empty($mantenimiento)){

                $permisos = explode(',',$mantenimiento);

                if(in_array($action,$permisos)){
                   $respuesta =  true;
                }                
                
            }
            
        }
    }

    return $respuesta;

}

//********************************************************************************

//*****************************************************
//PERFIL
//*****************************************************

function listPerfil(){

    $lista = Perfil::all(['id','nombre']);

    return $lista;
}