<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBranchRequest extends Request {

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
                'description'=> "required|unique:branches,description,". $this->get('id'),
                "tel" =>"required",
                "direcc" => "required",
                "mail" => "email"

            ];
        }
        else
        {
            return [
                'description'=> "required|unique:branches,description",
                "tel" =>"required",
                "direcc" => "required",
                "mail" => "email"
            ];
        }

    }
    public function messages()
    {
        return [
            'description.required' => 'Favor completar el campo descripcion',
            "description.unique" => 'La descripcion que ingreso ya es utilizada por otra sucursal',
            "tel.required" =>'Favor complete el campo telefono',
            "mail.email" => 'El email ingresado no es valido, ingreselo de vuelta'
        ];}

}
