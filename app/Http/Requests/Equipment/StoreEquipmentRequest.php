<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEquipmentRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = false;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'equipment_type_id' => 'required|exists:equipment_types,id',
            'serial_numbers' => 'required|array|',
            //'serial_numbers.*' => 'required|string|distinct|max:255|unique:equipments,serial_number|serial_number_mask:'.$this->get('equipment_type_id'),
            'notes' => 'nullable|max:255'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'equipment_type_id.required'            => 'Тип оборудования не указан',
            'equipment_type_id.exists'              => 'Тип оборудования не найден',
            'serial_numbers.required'               => 'Серийные номера не указаны',
            'serial_numbers.array'                  => 'На вход должен быть подан массив серийных номеров',
            'serial_numbers.*.unique'               => 'Оборудование с серийным номером :input уже числится в системе',
            'serial_numbers.*.max'                  => 'Превышена максимальная длина серийного номера. Серийный номер должен быть длиной до :max символов',
            'serial_numbers.*.distinct'             => 'Оборудование с серийным номером :input указано несколько раз',
            'serial_numbers.*.serial_number_mask'   => 'Серийный номер :input не соответсвует маске его типа.',
            'notes.max'                             => 'Превышена максимальная длина примечания',
        ];
    }
}
