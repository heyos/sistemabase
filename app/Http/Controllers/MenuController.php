<?php

namespace App\Http\Controllers;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        
        $menu = Menu::where('slug',$slug)->first();
        if(!empty($menu->id)){
            $vista = 'home';
            $slug = strtoupper($slug);
            $idMenu = $menu->id;
            $padre = $menu->padre;
            $blade = $menu->vista_blade;
            $title = !empty($menu->nombre_largo)?$menu->nombre_largo:$menu->nombre;

            if (view()->exists($vista))
            {
                return view($vista)
                        ->with('title',$title)
                        ->with('idMenu',$idMenu)
                        ->with('blade',$blade);
                
            }else{
                return 'Vista no definida <a href="./">Atras</a>';
            }


        }else {
            abort(404);
        }
        
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
    public function store(Request $request)
    {
        //
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
