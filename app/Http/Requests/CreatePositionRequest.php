<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePositionRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}



	public function rules()
	{


        if ($this->method() == 'PATCH')
        {
            return [
                'description'=> "required|unique:positions,description,". $this->get('id'),
                "periodo" =>"required",
                "monto" => "required|numeric"


            ];
        }
        else
        {
            return [
                'description'=> "required|unique:positions,description",
                "periodo" =>"required",
                "monto" => "required|numeric"
            ];
        }

    }
    public function messages()
    {
        return [
            'description.required' => 'Favor completar el campo descripcion',
            "description.unique" => 'La descripcion que ingreso ya es utilizada por otro cargo',
            "periodo.required" =>'Favor elija un periodo',
            "monto.required" => 'Favor completar el campo monto',
            "monto.numeric" => 'Favor ingresar un numero valido de monto de sueldo'

        ];}
}
