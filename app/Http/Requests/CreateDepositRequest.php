<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateDepositRequest extends Request {

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
                'description'=> "required|unique:deposits,description,". $this->get('id'),
                "branch_list" => "exists:branches,id"
            ];
        }
        else
        {
            return [
                'description'=> "required|unique:deposits,description",
                "branch_list" => "exists:branches,id"
            ];
        }

    }
    public function messages()
    {
        return [
            'description.required' => 'Favor completar el campo descripcion',
            "description.unique" => 'La descripcion que ingreso ya es utilizada por otra zona',

            "city_list.exists" => 'Favor seleccionar una sucursal',

        ];
    }

}
