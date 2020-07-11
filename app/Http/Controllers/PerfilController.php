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

                    return $perfil->pageInicio->nombre;

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

        $permiso = permisos($slug,$accion);

        if($permiso){

            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'perfil_id'=>$request->perfil_id
            ]);

            $respuesta = true;
            $message = "Registro guardado exitosamente.";

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

        $accesos = Perfil::where('id',$id)->with('accesosPerfil')->first();

        $data = [];

        foreach ($accesos->accesosPerfil as $acceso) {
            
            $idMenu = $acceso->menu_id;
            $where = array(['slug','<>',''],['visible','=','1'],['id','=',$idMenu]);

            $menu = Menu::dataCustomColumns($where)->first();

            if(!empty($menu)){
                $data[] = array('vista'=>$menu->vista_blade,'nombre'=>$menu->nombre);
            }
        }

        return response()->json([
            'respuesta'=>$respuesta,
            'data'=>$data
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
