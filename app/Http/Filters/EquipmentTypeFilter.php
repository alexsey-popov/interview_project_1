<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class EquipmentTypeFilter extends QueryFilter
{
    /**
     * Find from id
     *
     * @param string $id
     */
    public function id(string $id)
    {
        $this->builder->where('id', $id);
    }

    /**
     * Find from name
     *
     * @param string $name
     */
    public function name(string $name)
    {
        $this->builder->where('name', $name);
    }

    /**
     * Search from name
     *
     * @param string $searchName
     */
    public function searchName(string $searchName)
    {
        $this->builder->where('name', '%'.$searchName.'%');
    }

    /**
     * Find from mask
     *
     * @param string $mask
     */
    public function mask(string $mask)
    {
        $this->builder->where('mask', $mask);
    }

    /**
     * Search from mask
     *
     * @param string $searchMask
     */
    public function searchMask(string $searchMask)
    {
        $this->builder->where('mask', '%'.$searchMask.'%');
    }
}
