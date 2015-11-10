<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateDriveRequest extends Request {


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
                "chapa" =>"required|unique:drives,chapa,". $this->get('id'),
                "chasis" => "required|unique:drives,chasis,". $this->get('id'),
                "year" => "required|digits:4",
                "brand_list" => "exists:brands,id"
            ];
        }
        else
        {
            return [
                'description'=> "required",
                'chapa'=> "required|unique:drives,chapa",
                'chasis'=> "required|unique:drives,chasis",
                "year" => "required|digits:4",
                "brand_list" => "exists:brands,id"
            ];
        }

    }
    public function messages()
    {
        return [
            'description.required' => 'Favor completar el campo descripcion',
            "chapa.required" =>'Favor completar el campo chapa',
            "chapa.unique" => 'La chapa que ingreso ya es utilizado por otro vehiculo',
            "chasis.required" => 'Favor completar el campo chasis',
            "chasis.unique" => 'El numero de chasis que ingreso ya es utilizado por otro vehículo',
            "year.required" => 'Favor completar el campo año',
            "brand_list.exists" => 'Favor seleccionar una marca',
            "year.digits" => 'El año debe se numerico y tenter 4 digitos'

        ];
    }}