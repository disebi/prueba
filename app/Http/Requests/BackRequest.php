<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class BackRequest extends Request {

	public function authorize()
	{
		return true;
	}

    public function rules()
    {     return [
                'comments'=> "required",
                "km" => "required",
                "tanque" => "required",
                "out_id" => "required",
            ];
     }

    public function messages()
    {
        return [
            'comments.required' => 'Favor completar el campo comentario',
            'km.required' => 'Favor completar el campo kilometraje',
            'tanque.required' => 'Favor completar el campo tanque',
            'out_id.required' => 'Favor refrescar la pagina'
           ];
    }
}
