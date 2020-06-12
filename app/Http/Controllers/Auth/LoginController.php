<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Perfil;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {

        $success = true;
        $message = 'Ingreso exitoso, espere un momento estamos cargando los modulos.';
        $page = 'home';
        $pageInfo = '';
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            $success = false;
            $message = "Error en el inicio de sesion";
        }else{
            $perfil = $user->perfil_id;

            $datosPerfil = Perfil::infoPerfil($perfil)->first();
            $pageInfo = $datosPerfil->page_default;
            $arr = explode('.',$pageInfo);
            $page = $arr[1];

        }

        return response()->json([
            'success'=>$success,
            'message'=>$message,
            'page'=> $page
        ]);
        
    }
    
}
