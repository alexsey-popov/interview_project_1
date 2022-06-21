<?php

namespace App\Http\Controllers;

use App\Http\Filters\EquipmentTypeFilter;
use App\Http\Requests\EquipmentType\StoreEquipmentTypeRequest;
use App\Http\Requests\EquipmentType\UpdateEquipmentTypeRequest;
use App\Http\Resources\EquipmentTypeResource;
use App\Models\EquipmentType;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EquipmentTypeFilter $filter)
    {
        return EquipmentTypeResource::collection(EquipmentType::filter($filter)->paginate(5));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EquipmentType\StoreEquipmentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EquipmentType\UpdateEquipmentTypeRequest  $request
     * @param  \App\Models\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEquipmentTypeRequest $request, EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentType $equipmentType)
    {
        //
    }
}
