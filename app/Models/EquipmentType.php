<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get equipment for this type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
