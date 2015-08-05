<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateLocalRequest extends Request {

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
        if ($this->method() == 'PATCH')
        {
            return [
                'description'=> "required|unique:clients,description,". $this->get('id'),
                "razon" =>"required",
                "ruc" => "required|unique:clients,ruc,". $this->get('id'),
                "direcc" => "required",
                "tel" => "required",
                "nombre" => "required",
                "apellido" => "required"


            ];
        }
        else
        {
            return [
                'description'=> "required|unique:providers,description",
                "razon" =>"required",
                "ruc" => "required|unique:clients,ruc",
                "direcc" => "required",
                "tel" => "required",
                "nombre" => "required",
                "apellido" => "required"



            ];
        }

    }
    public function messages()
    {
        return [
            'description.required' => 'Favor completar el campo descripcion',
            "description.unique" => 'La descripcion que ingreso ya es utilizada por otra empresa',
            "razon.required" =>'Favor completar el campo razon',
            "ruc.required" => 'Favor completar el campo ruc',
            "ruc.unique" => 'El ruc que ingreso ya es utilizado por otra empresa',
            "direcc.required" => 'Favor completar el campo direcc',
            "tel.required" => 'Favor completar el campo tel',
            'nombre.required' => 'Favor completar el campo de nombre',
            'apellido.required' => 'Favor completar el campo de apellido'

        ];
    }


}
