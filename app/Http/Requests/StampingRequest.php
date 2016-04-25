<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StampingRequest extends Request {


	public function authorize()
	{
		return true;
	}


    public function rules()
    {
           return [
                "from" =>"required",
                "to" =>"required",
                "do" =>"required|date"

            ];
        }
    public function messages()
    {
        return [
            'from.required' => 'Favor completar el campo desde',
            'to.required' => 'Favor completar el campo hasta',
            'do.required' => 'Favor completar el campo fecha de vencimiento',
            'do.date' => 'Favor completar el campo fecha de vencimiento con una fecha valida'
        ];
    }
}
