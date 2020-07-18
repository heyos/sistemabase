<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilFormRequest;
use App\Menu;
use App\Perfil;
use DataTables;
use Illuminate\Http\Request;

class PerfilController extends Controller
{

    public function getData(Request $request){

        $slug = $request->slug;
        $perfil = Perfil::with('pageInicio')->get();
        
        return DataTables::of($perfil)
                ->addIndexColumn()
                ->addColumn('page_inicio',function($perfil){

                    $page = '';

                    if(!empty($perfil->pageInicio)){
                        $page = $perfil->pageInicio->nombre;
                    }

                    return $page;

                })
                ->addColumn('isRoot',function($perfil){

                    $isRoot = $perfil->is_root == '1' ? '<span class="badge badge-success">Si</span>':'<span class="badge badge-danger">No</span>' ;
                    // $isRoot = $perfil->accesosPerfil;

                    return $isRoot;

                })
                ->addColumn('action',function($perfil) use($slug){

                    $btn = '<div class="btn-group">';
                    $id = $perfil->id;

                    if(permisos($slug,'edit')){
                        $btn .= '<a href="'.$id.'" data-accion="edit" class="btn btn-info btn-sm"
                                    title="Editar">
                                    <i class="fa fa-edit"></i>
                                </a> ';

                        $btn .= '<a href="'.$id.'" data-accion="start" class="btn btn-success btn-sm"
                                    title="Escoger pagina de inicio">
                                    <i class="fa fa-play"></i>
                                </a> ';
                    }

                    if(permisos($slug,'delete')){
                        $btn .= '<a href="'.$id.'" data-accion="delete" class="btn btn-secondary btn-sm"
                                    title="Eliminar">
                                    <i class="fa fa-trash"></i>
                                </a>';
                    }

                    $btn .="</div>";

                    return $btn;
                })
                ->rawColumns(['page_inicio','isRoot','action'])
                ->make(true);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerfilFormRequest $request)
    {
        $slug = $request->slug;
        $accion = $request->accion;
        $respuesta =  false;
        $message = 'No se puede ejecutar la aplicacion';

        $isRoot  = empty($request->is_root) ? '0':'1';

        $permiso = permisos($slug,$accion);

        if($permiso){

            Perfil::create([
                'nombre'=>$request->nombre,
                'is_root'=>$isRoot
            ]);

            $respuesta = true;
            $message = "Registro guardado exitosamente. value ";

        }else{
            $message = 'No tiene los permisos suficientes para completar esta accion';
        }

        return response()->json([
            'respuesta'=>$respuesta,
            'message'=>$message
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $respuesta = false;
        $message = 'Error en cosulta, no se encontro el registro';

        $data = Perfil::find($id);
        
        if(!empty($data)){
            $respuesta = true;
            $message = "Exito";
        }

        return response()->json([
            'respuesta'=>$respuesta,
            'data'=>$data,
            'message'=>$message
        ]);

    }

    public function showPages($id){
        $respuesta = false;
        $message = '';

        $accesos = Perfil::where('id',$id)->with('accesosPerfil')->first();

        $data = [];

        if(count($accesos->accesosPerfil) > 0){
            $respuesta =  true;
            foreach ($accesos->accesosPerfil as $acceso) {
                
                $idMenu = $acceso->menu_id;
                $where = array(['slug','<>',''],['visible','=','1'],['id','=',$idMenu]);

                $menu = Menu::dataCustomColumns($where)->first();

                if(!empty($menu)){
                    $data[] = array('vista'=>$menu->vista_blade,'nombre'=>$menu->nombre);
                }
            }
        }else{
            $message = "Aun no se le ha concedido permisos para establecer una vista de inicio.";
        }

            

        return response()->json([
            'respuesta'=>$respuesta,
            'info'=>$accesos->nombre,
            'default'=>$accesos->page_default,
            'data'=>$data,
            'message'=>$message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilFormRequest $request, $id)
    {
        $slug = $request->slug;
        $respuesta = false;
        $message = 'Error en consulta, no se encontro el registro.';

        $data = [];

        $permiso = permisos($slug,'edit');

        if($permiso){

            $perfil = Perfil::find($id);

            if(!empty($perfil)){
                
                if($request->accion == 'edit'){

                    $isRoot  = empty($request->is_root) ? '0':'1';

                    $perfil->nombre = $request->nombre;
                    $perfil->is_root = $isRoot;

                }elseif ($request->accion=='start') {
                    $perfil->page_default = $request->page_default;
                }

                $perfil->save();

                $respuesta = true;
                $message = "Registro actualizado exitosamente.".$request->accion;
            }

        }else{
            $message = 'No tiene los permisos suficientes para completar esta accion';
        }

        return response()->json([
                'respuesta'=>$respuesta,
                'message'=>$message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $slug = $request->slug;
        
        $respuesta =  false;
        $message = 'No se puede ejecutar la aplicacion';

        $permiso = permisos($slug,'delete');

        if($permiso){

            $perfil = Perfil::find($id);

            if(!empty($perfil)){
                $perfil->delete();

                $respuesta = true;
                $message = "Registro eliminado exitosamente.";
            }else{
                $message = "Registro no existe, no se completo la accion.";
            }

        }else{
            $message = 'No tiene los permisos suficientes para completar esta accion';
        }

        return response()->json([
            'respuesta'=>$respuesta,
            'message'=>$message
        ]);
    }
}
