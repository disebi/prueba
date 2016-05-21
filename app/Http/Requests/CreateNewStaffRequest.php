<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateNewStaffRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}


    public function rules()
    {
        if ($this->method() == 'PATCH')
        {

            return [

                "name" =>"required",
                "last_name" => "required",
                "ci" => "required|unique:staff,ci,". $this->get('id'),
                "direcc" => "required",
                "birth_date" => "required|date",
                "tel" => "required",
                "email" => "required|email|unique:users,email,". $this->get('user_id'),
                "nick" => "required|unique:users,name,". $this->get('user_id'),
//                "password" => "required|min:8",
//                "password2" => "required|min:8|same:password",
                "branch_list" => "exists:branches,id",
                "position_list" => "exists:cities,id"



            ];
        }
        else
        {
            return [
                "name" =>"required",
                "last_name" => "required",
                "direcc" => "required",
                "birth_date" => "required|date",
                "tel" => "required",
                "email" => "required|email|unique:users,email",
                "nick" => "required|unique:users,name",
                "ci" => "required|unique:staff,ci",
                "password" => "required|min:8",
                "password2" => "required|min:8|same:password",
                "branch_list" => "exists:branches,id",
                "position_list" => "exists:cities,id"
            ];
        }

    }
    public function messages()
    {
        return [
            'name.required' => 'Favor completar el campo nombre',
            "last_name.required" => 'Favor completar el campo nombre',
            "birth_date.required" => 'Favor completar el campo fecha de nacimiento',
            "birth_date.date" => 'La fecha de nacimiento ingresada no es valida',
            "ci.required" =>'Favor completar el campo ci',
            "direcc.required" => 'Favor completar el campo direccion',
            "email.required" => 'Favor completar el campo email',
            "nick.required" => 'Favor completar el campo nick',
            "email.email" => 'Favor completar con un email validio',
            "email.unique" => 'El correo ingresado ya esta siendo usado por otro usuario',
            "nick.unique" => 'El nick ingresado ya esta siendo usado por otro usuario',
            "password.required" => 'Favor completar con clave',
            "password.min" => 'La clave debe tener minimo 8 letras',
            "password2.min" => 'La clave debe tener minimo 8 letras',
            "password2.required" => 'Favor completar ambas clave',
            "password2.same" => 'Ambas claves deben de ser iguales',
            "branch_list.required" => 'Favor seleccione una sucursal',
            "position_list.required" => 'Favor seleccione un cargo'
        ];
    }

}
