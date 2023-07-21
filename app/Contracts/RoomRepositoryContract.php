<?php

namespace App\Contracts;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Models\Vendor;

interface RoomRepositoryContract
{

    public function getById(Vendor $vendor, int $roomId): Room;

    public function create(Vendor $vendor, array $attributes): Room;

    public function update(Room $room, array $attributes): Room;

    public function destroy(Room $room): bool;
}