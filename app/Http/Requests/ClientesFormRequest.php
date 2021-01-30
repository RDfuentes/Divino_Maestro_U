<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesFormRequest extends FormRequest
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
        return [
            'codigo_unico'=>'required',
            'nombre'=>'required',
            'apellido'=>'required',
            'id_envio'=>'required',
            'saldo'=>'required|min:0',
            'credito'=>'required|max:4',
            'descuento'=>'required',
        ];
    }
}
