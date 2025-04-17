<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EquipmentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return EquipmentResource::collection(Equipment::with('equipmentType')->get());
    }

    public function store(StoreEquipmentRequest $request): EquipmentResource
    {
        return new EquipmentResource(Equipment::create($request->validated()));
    }

    public function show(Equipment $equipment): EquipmentResource
    {
        return new EquipmentResource($equipment->load('equipmentType'));
    }

    public function update(UpdateEquipmentRequest $request, Equipment $equipment): EquipmentResource
    {
        $equipment->update($request->validated());
        return new EquipmentResource($equipment);
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return response()->noContent();
    }
}
