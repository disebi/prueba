<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaleRequest extends Request {

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
            'order_id'=>'required',
            'result'=>'required',
            'iva_10'=>'required',
            'iva_5'=>'required',
            'excento'=>'required',
            'total'=>'required'];
    }

    public function messages()
    {
        return [
            "order_id.required" => 'Favor vuelva a cargar la pagina',
            "result.required" => 'Favor inserte productos a su detalle de Factura',
            "iva_10.required" =>'Favor compruebe si la pagina esta recargada correctamente',
            "iva_5.required" => 'Favor compruebe si la pagina esta recargada correctamente',
            "excento.required" => 'Favor compruebe si la pagina esta recargada correctamente',
            "total.required" => 'Favor compruebe si la pagina esta recargada correctamente'
        ];
    }

}
