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
            $rules['nombre'] = 'required|string|min:3|unique:perfil,deleted_at,NULL';
            $rules['is_root'] = 'in:0,1';

        }

        if($input['accion']=='edit'){
            $rules['email'] = 'required|string|unique:users,email,'.$this->user.',id,deleted_at,NULL';
            
            if(!empty($input['password'])){
                $rules['password'] = 'string|min:6';
            }else{
                unset($rules['password']);
            }

        }



        return $rules;
    }

    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422)); 
    }
}
