<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticulosFormRequest extends FormRequest
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
        // 1 .QUITAMOS LAS VALIDACIONES (REQUIRED) PARA COMPROBAR QUE FUNCIONE LA TRANSACCIÓN
        return [
            'articulo'=>'required',
            'id_fabrica'=>'required',
            'existencia'=>'required',
            'descripcion',
        ];
    }
}
