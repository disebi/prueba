<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateNewPurchaseRequest extends Request {

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
                        'stamping'=>'required',
                        'result'=>'required',
                        'iva_10'=>'required',
                        'provider_list'=>'required|exists:providers,id',
                        'iva_5'=>'required',
                        'excento'=>'required',
                        'total'=>'required'];
	}

    public function messages()
    {
        return [
            'stamping.required' => 'Favor completar el campo timbrado',
            "result.required" => 'Favor inserte productos a su detalle de Factura',
            "provider_list.required" => 'Favor seleccione un proveedor',
            "provider_list.exists" => 'Favor seleccione un proveedor existente',
            "iva_10.required" =>'Favor compruebe si la pagina esta recargada correctamente',
            "iva_5.required" => 'Favor compruebe si la pagina esta recargada correctamente',
            "excento.required" => 'Favor compruebe si la pagina esta recargada correctamente',
            "total.required" => 'Favor compruebe si la pagina esta recargada correctamente'
        ];
    }

}
