<?php

namespace App\Http\Requests;

use App\Traits\ResponseFormatTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BusRequest extends FormRequest
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
        return [
            'unitnumber' => 'required|integer|unique:bus,unitnumber',
            'licenseplate' => 'required|string|max:8|unique:bus,licenseplate',
            'model' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'year' => 'required|date_format:Y',
            'id_carrier' => 'required|integer|exists:carriers,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'unitnumber' => 'Número de Unidad',
            'licenseplate' => 'Placa',
            'model' => 'Modelo',
            'capacity' => 'Capacidad',
            'year' => 'Año',
            'id_carrier' => 'Transportista',
        ];
    }

    public function messages():array
    {
        return [
            'unitnumber.required' => 'El :attribute es obligatorio.',
            'unitnumber.integer' => 'El :attribute debe ser un número entero.',
            'unitnumber.unique' => 'El :attribute ya existe.',
            'licenseplate.required' => 'La :attribute es obligatoria.',
            'licenseplate.string' => 'La :attribute debe ser una cadena de caracteres.',
            'licenseplate.max' => 'La :attribute debe tener máximo 8 caracteres.',
            'licenseplate.unique' => 'La :attribute ya existe.',
            'model.required' => 'El :attribute es obligatorio.',
            'model.string' => 'El :attribute debe ser una cadena de caracteres.',
            'model.max' => 'El :attribute debe tener máximo 255 caracteres.',
            'capacity.required' => 'La :attribute es obligatoria.',
            'capacity.integer' => 'La :attribute debe ser un número entero.',
            'year.required' => 'El :attribute es obligatorio.',
            'year.date_format' => 'El :attribute debe ser un año válido.',
            'id_carrier.required' => 'El :attribute es obligatorio.',
            'id_carrier.integer' => 'El :attribute debe ser un número entero.',
            'id_carrier.exists' => 'El :attribute no existe.',
        ];
    }
}
