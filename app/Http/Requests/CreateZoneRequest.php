<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateZoneRequest extends Request {


	public function authorize()
	{
		return true;
	}

	public function rules()
    {
        if ($this->method() == 'PATCH')
        {
            return [
                'description'=> "required|unique:zones,description,". $this->get('id'),
                "km" =>"required|numeric",

                "comision" => "required|integer"
                //"city_id" => "required"


            ];
        }
        else
        {
            return [
                'description'=> "required|unique:zones,description",
                "km" =>"required|numeric",

                "comision" => "required|integer"
                //"city_id" => "required"


            ];
        }

    }
    public function messages()
    {
        return [
            'description.required' => 'Favor completar el campo descripcion',
            "description.unique" => 'La descripcion que ingreso ya es utilizada por otra zona',
            "km.required" =>'Favor completar el campo km',
            "km.numeric" => 'El dato de km que ingreso no es correcto, favor ingresar de vuelta',
            "comision.integer" => 'El dato de comision que ingreso no es correcto, favor ingresar de vuelta',
            "comision.required" => 'Favor completar el campo comision',
            "city_id.required" => 'Favor elegir una ciudad'

        ];
    }

}
