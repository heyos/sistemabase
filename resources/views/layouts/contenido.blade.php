{{-- CUERPO PRINCIPAL --}}
@php
    $submenu = submenudata($idMenu);
    $i = 0;
    $active = '';
@endphp

<div class="card">

    <div class="card-header card-header2">
        <ul class="nav nav-tabs card-header-tabs">

            @foreach ($submenu as $item)
                @php
                    $active = $i==0?'active':'';
                    $cadena = $item->vista_blade;
                    $href = '#';
                    if(!empty($cadena)){
                        $arr_cadena = explode('.',$cadena);
                        $href = $arr_cadena[1];
                    }
                        
                @endphp
                <li class="nav-item">
                    <a class="nav-link {{ $active }}" id="{{ $cadena }}" data-toggle="tab" aria-controls="{{ $href }}"
                    href="{{ '#'.$href }}" aria-expanded="true"><strong>{{ $item->nombre }}</strong></a>
                </li>
                @php
                    $i++
                @endphp 
                
            @endforeach
            
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content px-1 pt-1">
            {{-- CONTENIDO DE LAS VISTAS --}}
            @php
                $i=0;
                $title = '';
            @endphp
            @foreach ($submenu as $item)
                @php
                    $active = $i==0?'active':'';
                    $cadena = $item->vista_blade;
                    $href = '#';
                    if(!empty($cadena)){
                        $arr_cadena = explode('.',$cadena);
                        $href = $arr_cadena[1];
                    }
                    $title = $item->nombre_largo==''?$item->nombre:$item->nombre_largo;
                    $idMenu = $item->id;
                @endphp
                <div role="tabpanel" class="tab-pane {{ $active }}" id="{{ $href }}" aria-expanded="true" aria-labelledby="{{ $cadena }}">
                    @includeIf($cadena,['title'=>$title,'idMenu'=>$idMenu])
                </div>
                
                @php
                    $i++
                @endphp 
            @endforeach
            
        </div>
    </div>
</div>