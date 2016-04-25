<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateReturnRequest extends Request {

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
            'result'=>'required',
            'client_list'=>'required|exists:clients,id',
            ];
    }

    public function messages()
    {
        return [
            "result.required" => 'Favor inserte productos a su detalle de Devolucion',
            "client_list.required" => 'Favor seleccione un cliente',
            "client_list.exists" => 'Favor seleccione un cliente existente'
        ];
    }

}
