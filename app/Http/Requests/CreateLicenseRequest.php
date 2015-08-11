<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateLicenseRequest extends Request {

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
                'description'=> "required|unique:licenses,description,". $this->get('id'),
                "info" =>"required",
            ];
        }
        else
        {
            return [
                'description'=> "required|unique:licenses,description",
                "info" =>"required"


            ];
        }

    }
    public function messages()
    {
        return [
            'description.required' => 'Favor completar el campo descripcion',
            "description.unique" => 'La descripcion que ingreso ya es utilizada por otro permiso',
            "info.required" =>'Favor completar el campo informacion'

        ];
    }

}