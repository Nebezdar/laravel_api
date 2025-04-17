<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentTypeRequest;
use App\Http\Requests\UpdateEquipmentTypeRequest;
use App\Http\Resources\EquipmentTypeResource;
use App\Models\EquipmentType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EquipmentTypeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return EquipmentTypeResource::collection(EquipmentType::all());
    }

    public function store(StoreEquipmentTypeRequest $request): EquipmentTypeResource
    {
        return new EquipmentTypeResource(EquipmentType::create($request->validated()));
    }

    public function show(EquipmentType $equipmentType): EquipmentTypeResource
    {
        return new EquipmentTypeResource($equipmentType);
    }

    public function update(UpdateEquipmentTypeRequest $request, EquipmentType $equipmentType): EquipmentTypeResource
    {
        $equipmentType->update($request->validated());
        return new EquipmentTypeResource($equipmentType);
    }

    public function destroy(EquipmentType $equipmentType)
    {
        $equipmentType->delete();
        return response()->noContent();
    }
}
