<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditUserRequest extends Request {

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
                "email" => "required|email|unique:users,email,". $this->get('id'),
                "name" => "required|unique:users,name,". $this->get('id'),
               "password" => "required|min:8",
              "password2" => "required|min:8|same:password"
            ];
        }
        else
        {
            return [
                "email" => "required|email|unique:users,email",
                "name" => "required|unique:users,name",
                "password" => "required|min:8",
                "password2" => "required|min:8|same:password"
            ];
        }

    }
    public function messages()
    {
        return [
            'name.required' => 'Favor completar el campo nombre',
            "email.required" => 'Favor completar el campo email',
            "name.required" => 'Favor completar el campo nick',
            "email.email" => 'Favor completar con un email validio',
            "email.unique" => 'El correo ingresado ya esta siendo usado por otro usuario',
            "name.unique" => 'El nick ingresado ya esta siendo usado por otro usuario',
            "password.required" => 'Favor completar con clave',
            "password.min" => 'La clave debe tener minimo 8 letras',
            "password2.min" => 'La clave debe tener minimo 8 letras',
            "password2.required" => 'Favor completar ambas clave',
            "password2.same" => 'Ambas claves deben de ser iguales'
        ];
    }
}
