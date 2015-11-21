<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateRoleRequest extends Request {

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
                'description'=> "required|unique:roles,description,". $this->get('id'),
                "license_list" => "exists:licenses,id"


            ];
        }
        else
        {
            return [
                'description'=> "required|unique:roles,description",
                "license_list" => "required | exists:licenses,id"
            ];
        }

    }
    public function messages()
    {
        return [
            'description.required' => 'Favor completar el campo descripcion',
            "description.unique" => 'La descripcion que ingreso ya es utilizada',
            "license_list.exists" => 'Favor seleccionar un permiso existente',
            "license_list.required" => 'Favor seleccionar un permiso',

        ];
    }

}
