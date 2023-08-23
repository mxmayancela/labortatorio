<?php

namespace App\Http\Requests;

use App\Traits\ResponseFormatTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RouteRequest extends FormRequest
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
            'id_city_origin' => 'required|integer|exists:citys,id',
            'id_city_destination' => 'required|integer|exists:citys,id',
            'id_bus' => 'required|integer|exists:bus,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'date_end' => 'required|date|after_or_equal:date',
            'end_time' => 'required|date_format:H:i',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_city_origin' => 'Ciudad de origen',
            'id_city_destination' => 'Ciudad de destino',
            'id_bus' => 'Bus',
            'date' => 'Fecha',
            'start_time' => 'Hora de salida',
            'date_end' => 'Fecha de llegada',
            'end_time' => 'Hora de llegada',
        ];
    }

    public function messages(): array
    {
        return [
            'id_city_origin.required' => 'La :attribute es obligatoria.',
            'id_city_origin.integer' => 'La :attribute debe ser un número entero.',
            'id_city_origin.exists' => 'La :attribute no existe en la base de datos.',
            'id_city_destination.required' => 'La :attribute es obligatoria.',
            'id_city_destination.integer' => 'La :attribute debe ser un número entero.',
            'id_city_destination.exists' => 'La :attribute no existe en la base de datos.',
            'id_bus.required' => 'El :attribute es obligatorio.',
            'id_bus.integer' => 'El :attribute debe ser un número entero.',
            'id_bus.exists' => 'El :attribute no existe en la base de datos.',
            'date.required' => 'La :attribute es obligatoria.',
            'date.date' => 'La :attribute debe ser una fecha.',
            'start_time.required' => 'La :attribute es obligatoria.',
            'start_time.date_format' => 'La :attribute debe ser una hora.',
            'end_time.required' => 'La :attribute es obligatoria.',
            'end_time.date_format' => 'La :attribute debe ser una hora.',
            'date_end.required' => 'La :attribute es obligatoria.',
            'date_end.date' => 'La :attribute debe ser una fecha.',
            'date_end.after_or_equal' => 'La :attribute debe ser mayor o igual a la fecha de salida.',
        ];
    }
}
