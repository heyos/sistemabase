<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserFormRequest extends FormRequest
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
                'accion'=>'in:add,edit',
                'slug'=>'required|string',
                'name'=>'required|string|min:3',
                'email'=>'required|string|email|unique:users,email,deleted_at,NULL',
                'password'=>'required|string|min:6',
                'perfil_id'=>'required|numeric'
        ];

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

    public function attributes(){

        return [
            'name'=>'nombres',
            'perfil_id'=>'perfil',
            'slug'=>'ruta de la vista'
        ] ;
    }

    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422)); 
    }
}
