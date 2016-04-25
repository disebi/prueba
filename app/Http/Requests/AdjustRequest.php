<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdjustRequest extends Request {

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
            'result'=>'required'

        ];
    }

    public function messages()
    {
        return [
            "result.required" => 'Favor inserte productos a su detalle de Devolucion'

        ];
    }


}
