<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreditRequest extends Request {

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
            'sale_id'=>'required',
            'result'=>'required',
            'excento'=>'required',
            'total'=>'required'];
    }

    public function messages()
    {
        return [
            "sale_id.required" => 'Favor vuelva a cargar la pagina',
            "result.required" => 'Favor inserte productos a su detalle de Factura',
            "total.required" => 'Favor compruebe si la pagina esta recargada correctamente'
        ];
    }

}
