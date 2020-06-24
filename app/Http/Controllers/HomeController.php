<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $perfil = $user->perfil;
        $page = $perfil->page_default;

        $menu = Menu::where('vista_blade',$page)->first();
        $idMenu = $menu->id;
        $blade = $menu->vista_blade;
        $slug = $menu->slug;
        $nombre = !empty($menu->nombre_largo)? $menu->nombre_largo : $menu->nombre;

        $vista = 'admin.'.$blade;
                
        if (view()->exists($vista))
        {
            return view($vista)
                    ->with('title',$nombre)
                    ->with('idMenu',$idMenu)
                    ->with('slug',$slug)
                    ->with('blade',$blade);
            
        }else{
            return 'Vista no definida <a href="./">Atras</a>';
        }
        
    }
}
