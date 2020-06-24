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

        $ar = explode('.',$page);
        $slug = $ar[1];

        $vista = 'admin.'.$page;

        if (view()->exists($vista))
        {
            return redirect('admin/'.$slug);
            
        }else{
            return 'Vista no definida <a href="'.url('/').'">Atras</a>';
        }
        
    }
}
