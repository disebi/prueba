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

}
