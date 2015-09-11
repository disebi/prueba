<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateTaxesRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->method() == 'PATCH')
        {
            return [
                'description'=> "required",
                "valor" =>"required|integer"
            ];
        }
        else
        {
            return [
                'description'=> "required|unique:taxes,description",
                "valor" =>"required|integer"
            ];
        }

    }
    public function messages()
    {
        return [
            'description.required' => 'Favor completar el campo descripcion',
            "description.unique" => 'La descripcion que ingreso ya es utilizada por otro impuesto',
            "valor.integer" => 'El dato de valor que ingreso no es correcto, favor ingresar de vuelta',
            "valor.required" => 'Favor completar el campo valor'

        ];
    }

}
