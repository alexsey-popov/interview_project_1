<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentType extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['updated_at', 'deleted_at'];

    /**
     * Get equipment for this type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    /**
     * Get regexp by equipment type id
     * @param $equipmentTypeId
     * @return string
     */
    public static function getRegexpById($equipmentTypeId)
    {
        $equipmentType = self::find($equipmentTypeId);
        if(empty($equipmentType)) {
            return '';
        }

        return $equipmentType->convertMask();//'/[A-Z]/';
    }

    /**
     * Convert mask to regexp
     * @return string
     */
    public function convertMask()
    {
        $regexp = '/^';
        foreach (str_split($this->mask) as $char) {
            $regexp .= $this->convertMaskChar($char);
        }
        $regexp .= '$/';

        return $regexp;
    }

    /**
     * Convert mask char to regexp char
     * @param $char
     * @return string|void
     */
    public function convertMaskChar($char)
    {
        switch ($char) {
            case 'N':
                return '[0-9]';
            case 'a':
                return '[a-z]';
            case 'A':
                return '[A-Z]';
            case 'X':
                return '[A-Z0-9]';
            case 'Z':
                return '[-_@]';
        }
    }
}
