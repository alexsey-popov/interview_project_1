<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class EquipmentFilter extends QueryFilter
{
    /**
     * Search from serial_number or notes
     * 
     * @param string $search
     */
    public function search(string $search)
    {
        $this->builder->where('serial_number', 'like', '%'.$search.'%')->orWhere('notes', 'like', '%'.$search.'%');
    }

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
     * Find from serial_number
     * 
     * @param string $serial_number
     */
    public function serial_number(string $serial_number)
    {
        $this->builder->where('serial_number', $serial_number);
    }

    /**
     * Search from serial_number
     * 
     * @param string $search_serial_number
     */
    public function search_serial_number(string $search_serial_number)
    {
        $this->builder->where('serial_number', 'like', '%'.$search_serial_number.'%');
    }

    /**
     * Find from notes
     * 
     * @param string $notes
     */
    public function notes(string $notes)
    {
        $this->builder->where('notes', $notes);
    }

    /**
     * Search from notes
     * 
     * @param string $search_notes
     */
    public function search_notes(string $search_notes)
    {
        $this->builder->where('notes', 'like', '%'.$search_notes.'%');
    }
    
    /**
     * Find from equipment type id
     * 
     * @param string $equipment_type
     */
    public function equipment_type(string $equipment_type_id)
    {
        $this->builder->where('equipment_type_id', $equipment_type_id);
    }

    /**
     * Search from equipment_type name
     * 
     * @param string $equipment_type_name
     */
    public function search_equipment_type(string $equipment_type_name)
    {
        $this->builder->whereHas('equipment_type', function ($query) use ($equipment_type_name) {
            return $query->where('name', 'like', '%'.$equipment_type_name.'%');
        });
    }
    
}