<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        //
        $slug = $request->slug;
        $user = User::all();

        return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('perfil',function($user){

                    return $user->perfil->nombre;

                })
                ->addColumn('action',function($user) use($slug){

                    $btn = '<div class="btn-group">';
                    $user_id = $user->id;

                    if(permisos($slug,'edit')){
                        $btn .= '<a href="'.$user_id.'" data-accion="edit" class="btn btn-info btn-sm"
                                    title="Editar">
                                    <i class="fa fa-edit"></i>
                                </a> ';
                    }

                    if(permisos($slug,'delete')){
                        $btn .= '<a href="'.$user_id.'" data-accion="delete" class="btn btn-secondary btn-sm"
                                    title="Eliminar">
                                    <i class="fa fa-trash"></i>
                                </a>';
                    }

                    $btn .="</div>";

                    return $btn;
                })
                ->rawColumns(['perfil','action'])
                ->make(true);
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
    public function store(UserFormRequest $request)
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
        
        $respuesta = false;
        $message = 'Error en consulta, no se encontro el registro.';
        $user = User::find($id);

        if(!empty($user)){
            $respuesta = true;
            $message = "Exito";
        }

        return response()->json([
                'respuesta'=>$respuesta,
                'data'=>$user,
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
    public function update(UserFormRequest $request, $id)
    {
        //
        $slug = $request->slug;
        $respuesta = false;
        $message = 'Error en consulta, no se encontro el registro.';

        $data = [];

        $permiso = permisos($slug,'edit');

        if($permiso){

            $user = User::find($id);

            if(!empty($user)){
                $data = [
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'perfil_id'=>$request->perfil_id
                ];

                if(!empty($request->password)){
                    $data['password'] = Hash::make($request->password);
                }

                $user->update($data);

                $respuesta = true;
                $message = "Registro actualizado exitosamente.";
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

            $user = User::find($id);

            if(!empty($user)){
                $user->delete();

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
