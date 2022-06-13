<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

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
    public function equipment_type()
    {
        return $this->belongsTo(EquipmentType::class);
    }

    /**
     * Get equipment type name
     * 
     * @return string
     */
    public function getEquipmentTypeNameAttribute() 
    {
        return $this->equipment_type->name;
    }

    /**
     * Get equipment type mask
     * 
     * @return string
     */
    public function getEquipmentTypeMaskAttribute() 
    {
        return $this->equipment_type->mask;
    }
}
