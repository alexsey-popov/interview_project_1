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
     * @param string $search_name
     */
    public function search_name(string $search_name)
    {
        $this->builder->where('name', '%'.$search_name.'%');
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
     * @param string $search_mask
     */
    public function search_mask(string $search_mask)
    {
        $this->builder->where('mask', '%'.$search_mask.'%');
    }    
}