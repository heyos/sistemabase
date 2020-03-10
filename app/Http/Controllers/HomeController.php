<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $menu = Menu::where('default',1)->first();
        $idMenu = $menu->id;
        $nombre = !empty($menu->nombre_largo)? $menu->nombre_largo : $menu->nombre;

        $vista = 'home';
                
        if (view()->exists($vista))
        {
            return view($vista)
                    ->with('title',$nombre)
                    ->with('idMenu',$idMenu);
            
        }else{
            return 'Vista no definida <a href="./">Atras</a>';
        }
        // return view('home');
    }
}
