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
     * @param string $serialNumber
     */
    public function serialNumber(string $serialNumber)
    {
        $this->builder->where('serial_number', $serialNumber);
    }

    /**
     * Search from serial_number
     *
     * @param string $searchSerialNumber
     */
    public function searchSerialNumber(string $searchSerialNumber)
    {
        $this->builder->where('serial_number', 'like', '%'.$searchSerialNumber.'%');
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
     * @param string $searchNotes
     */
    public function searchNotes(string $searchNotes)
    {
        $this->builder->where('notes', 'like', '%'.$searchNotes.'%');
    }

    /**
     * Find from equipment type id
     *
     * @param string $equipmentTypeId
     */
    public function equipmentType(string $equipmentTypeId)
    {
        $this->builder->where('equipment_type_id', $equipmentTypeId);
    }

    /**
     * Search from equipment_type name
     *
     * @param string $equipmentTypeName
     */
    public function searchEquipmentType(string $equipmentTypeName)
    {
        $this->builder->whereHas('equipmentType', function ($query) use ($equipmentTypeName) {
            return $query->where('name', 'like', '%'.$equipmentTypeName.'%');
        });
    }

}
