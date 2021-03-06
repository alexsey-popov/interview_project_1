<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateEquipmentRequest extends FormRequest
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
            'equipment_type.id' => 'required|exists:equipment_types,id',
            'serial_number' => 'required|max:255|unique:equipments,serial_number,'.$this->id.'|serial_number_mask:'.$this->get('equipment_type')['id'],
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
            'equipment_type.id.required'        => 'Тип оборудования не указан',
            'equipment_type.id.exists'          => 'Тип оборудования не найден',
            'serial_number.required'            => 'Серийный номер не указан',
            'serial_number.unique'              => 'Оборудование с серийным номером :input уже числится в системе',
            'serial_number.max'                 => 'Превышена максимальная длина серийного номера',
            'serial_number.serial_number_mask'  => 'Серийный номер :input не соответсвует маске его типа.',
            'notes.max'                         => 'Превышена максимальная длина примечания',
        ];
    }
}
