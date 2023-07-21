<?php

namespace App\Http\Controllers\V1;

use App\Contracts\RoomRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    public function __construct(private readonly RoomRepositoryContract $roomRepository)
    {
    }

    public function store(RoomRequest $request, Vendor $vendor): JsonResponse
    {
        $room = $this->roomRepository->create($vendor, $request->validated());

        return new JsonResponse(['message' => 'room created.', 'room' => RoomResource::make($room)]);
    }


    public function update(RoomRequest $request, Vendor $vendor, int $roomId): JsonResponse
    {
        $room = $this->roomRepository->getById($vendor, $roomId);
        $room = $this->roomRepository->update($room, $request->validated());

        return new JsonResponse(['message' => 'room updated.', 'room' => RoomResource::make($room)]);
    }

    public function destroy(Vendor $vendor, int $roomId): JsonResponse
    {
        $room = $this->roomRepository->getById($vendor, $roomId);
        $this->roomRepository->destroy($room);

        return new JsonResponse(['message' => 'room deleted.']);
    }
}
