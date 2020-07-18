<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PerfilFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();

        $rules = [
            'accion'=>'in:add,edit,start',
            'slug'=>'required|string'
        ];

        if($input['accion']=='start'){
            $rules['page_default'] = 'required|string';
        }else{
            $rules['nombre'] = 'required|string|min:3|unique:perfil,nombre,deleted_at,NULL';
            
        }

        if($input['accion']=='edit'){
            $rules['nombre'] = 'required|string|unique:perfil,nombre,'.$this->perfil.',id,deleted_at,NULL';

        }



        return $rules;
    }

    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422)); 
    }
}
