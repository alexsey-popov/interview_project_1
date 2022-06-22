<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Http\Requests\Equipment\StoreEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ValidatedInput;

class Equipment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'equipments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['equipment_type_id', 'serial_number', 'notes', 'created_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['updated_at', 'deleted_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['equipment_type_name', 'equipment_type_mask'];

    /**
     * Get the EquipmentType that owns the Equipment.
     *
     * @return App\Models\EquipmentType
     */
    public function equipmentType()
    {
        return $this->belongsTo(EquipmentType::class);
    }

    /**
     * Create equipments in serial_numbers array
     * @param StoreEquipmentRequest $request
     * @return array
     */
    public static function createMany(StoreEquipmentRequest $request)
    {
        $equipmentTypeId = $request->safe()->offsetGet('equipment_type_id');
        $notes = $request->safe()->offsetGet('notes');

        $result = [];

        foreach ($request->safe()->offsetGet('serial_numbers') as $serialNumber) {
            $item = [
                'equipment_type_id' => $equipmentTypeId,
                'serial_number' => $serialNumber,
                'notes' => $notes,
            ];

            $validation = self::validate($item);

            $result[] = [
                'created'   => $validation->passes(),
                'item'      => $validation->passes() ? Equipment::createEquipment($validation->validated()) : $item,
                'messages'  => $validation->errors()
            ];

        }

        return $result;
    }

    /**
     * Validation before create equipment
     * @param array $item
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validate($item)
    {
        $rules = [
            'equipment_type_id' => 'required|exists:equipment_types,id',
            'serial_number' => 'required|string|max:255|unique:equipments,serial_number|serial_number_mask:'.$item['equipment_type_id'],
            'notes' => 'nullable|max:255'
        ];
        $messages = [
            'equipment_type_id.required'        => 'Тип оборудования не указан',
            'equipment_type_id.exists'          => 'Тип оборудования не найден',
            'serial_number.required'            => 'Серийный номер не указан',
            'serial_number.unique'              => 'Оборудование с серийным номером :input уже числится в системе',
            'serial_number.max'                 => 'Превышена максимальная длина серийного номера. Серийный номер должен быть длиной до :max символов',
            'serial_number.serial_number_mask'  => 'Серийный номер :input не соответсвует маске его типа.',
            'notes.max'                         => 'Превышена максимальная длина примечания',
        ];

        return Validator::make($item, $rules, $messages);
    }

    /**
     * Create equipment and return EquipmentResource
     * @param array $item
     * @return EquipmentResource
     */
    public static function createEquipment(array $item) {

        return new EquipmentResource(self::create($item));
    }
}
