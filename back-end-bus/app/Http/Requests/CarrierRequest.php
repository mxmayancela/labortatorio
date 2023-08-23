<?php

namespace App\Http\Requests;

use App\Traits\ResponseFormatTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CarrierRequest extends FormRequest
{
    use ResponseFormatTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator): void
    {
        static::responseFailedValidation($validator->errors());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $rules = [
            'name' => 'required|string|max:255',
            'lastnamefather' => 'required|string|max:255',
            'lastnamemother' => 'required|string|max:255',
            'cedula' => 'required|string|max:13|unique:persons',
            'birthdate' => 'required|date',
            'license' => 'required|string|max:255|unique:carriers',
        ];
        $rulesNull= [
            'name' => 'nullable|string|max:255',
            'lastnamefather' => 'nullable|string|max:255',
            'lastnamemother' => 'nullable|string|max:255',
            'cedula' => 'nullable|string|max:13',
            'birthdate' => 'nullable|date',
            'license' => 'nullable|string|max:255',
        ];
        return match ($this->method()) {
            'POST'=> $rules,
            'PUT'=> $rulesNull,
       };
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'lastnamefather' => 'apellido paterno',
            'lastnamemother' => 'apellido materno',
            'cedula' => 'cedula',
            'birthdate' => 'fecha de nacimiento',
            'license' => 'licencia',
        ];
    }

    public function  messages()
    {
        return [
          'name.required' => 'El campo :attribute es requerido',
            'lastnamefather.required' => 'El campo :attribute es requerido',
            'lastnamemother.required' => 'El campo :attribute es requerido',
            'cedula.required' => 'El campo :attribute es requerido',
            'birthdate.required' => 'El campo :attribute es requerido',
            'license.required' => 'El campo :attribute es requerido',
            'name.string' => 'El :attribute debe ser una cadena de caracteres',
            'lastnamefather.string' => 'El :attribute debe ser una cadena de caracteres',
            'lastnamemother.string' => 'El :attribute debe ser una cadena de caracteres',
            'cedula.string' => 'El :attribute debe ser una cadena de caracteres',
            'birthdate.string' => 'El :attribute debe ser una cadena de caracteres',
            'license.string' => 'El :attribute debe ser una cadena de caracteres',
            'name.max' => 'El :attribute debe tener un máximo de 255 caracteres',
            'lastnamefather.max' => 'El :attribute debe tener un máximo de 255 caracteres',
            'lastnamemother.max' => 'El :attribute debe tener un máximo de 255 caracteres',
            'cedula.max' => 'El :attribute debe tener un máximo de 13 caracteres',
            'license.max' => 'El :attribute debe tener un máximo de 255 caracteres',
            'cedula.unique' => 'El :attribute ya existe',
            'license.unique' => 'El :attribute ya existe',
            'birthdate.date' => 'El :attribute debe ser una fecha',
            'birthdate.date_format' => 'El :attribute debe tener el formato Y-m-d',

        ];
    }
}
