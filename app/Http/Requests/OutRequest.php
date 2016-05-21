<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class OutRequest extends Request {

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
            'km'=>'required',
            'comments'=>'required',
            'tanque'=>'required',
            'drive_id'=>'required',
            'driver_id'=>'required'];
    }

    public function messages()
    {
        return [
            "km.required" => 'Favor vuelva a cargar la pagina',
            "comments.required" => 'Favor inserte comentarios acerca del estado del vehiculo',
            "drive.required" => 'Favor inserte el vehiculo',
            "driver_.required" => 'Favor inserte el conductor',
            "tanque.required" => 'Favor inserte el tanque'
        ];
    }

}
