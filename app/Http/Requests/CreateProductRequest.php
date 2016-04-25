<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProductRequest extends Request {

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
        if ($this->method() == 'PATCH')
        {
            return [
                'description'=> "required|unique:products,description,". $this->get('id'),
                "compra" =>"required",
                "venta" => "required",
                "contenido" => "required",
                "peso" => "required|numeric",
                "aroma_list" => "exists:aromas,id",
                "presentation_list" => "exists:presentations,id",
                "line_list" => "exists:lines,id",
                "provider_list" => "exists:providers,id",
                "unity_list" => "exists:unities,id",
                "tax_list" => "exists:unities,id"


            ];
        }
        else
        {
            return [
                'description'=> "required|unique:products,description",
                "compra" =>"required",
                "venta" => "required",
                "contenido" => "required",
                "min" => "required",
                "peso" => "required|numeric",
                "aroma_list" => "exists:aromas,id",
                "presentation_list" => "exists:presentations,id",
                "line_list" => "exists:lines,id",
                "provider_list" => "exists:providers,id",
                "unity_list" => "exists:unities,id",
                "tax_list" => "exists:taxes,id"
            ];
        }
    }
    public function messages()
    {
        return [
            'description.required' => 'Favor completar el campo descripcion',
            "description.unique" => 'La descripcion que ingreso ya es utilizada por otra empresa',
            "razon.required" =>'Favor completar el campo razon',
            "min.required" =>'Favor completar el campo Minimo',
            "ruc.required" => 'Favor completar el campo ruc',
            "ruc.unique" => 'El ruc que ingreso ya es utilizado por otra empresa',
            "direcc.required" => 'Favor completar el campo direcc',
            "tel.required" => 'Favor completar el campo tel',
            'nombre.required' => 'Favor completar el campo de nombre',
            'apellido.required' => 'Favor completar el campo de apellido',
            "zone_list.exists" => "Favor elegir una zona",
            "business_list.exists" => "Favor elegir un rubro"

        ];
    }

}
