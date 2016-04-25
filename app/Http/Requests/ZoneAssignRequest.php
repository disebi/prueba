<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ZoneAssignRequest extends Request {

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
                'staff_list'=> "exists:staff,id",
                "zones_list" => "exists:zones,id"


            ];
   }
    public function messages()
    {
        return [

            "staff_list.exists" => 'Favor seleccionar un Vendedor existente',
            "staff_list.required" => 'Favor seleccionar un Vendedor',
            "zones_list.exists" => 'Favor seleccionar una zona existente',
            "zones_list.required" => 'Favor seleccionar una zona',

        ];
    }
}
