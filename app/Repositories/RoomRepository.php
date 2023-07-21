<?php

namespace App\Repositories;

use App\Contracts\RoomRepositoryContract;
use App\Models\Room;
use App\Models\Vendor;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomRepository extends AbstractRepository implements RoomRepositoryContract
{
    public function __construct(protected Room $model)
    {
    }


    public function getById(Vendor $vendor, int $roomId): Room
    {
        return $vendor->rooms()->with('vendor')->findOrFail($roomId);
    }

    /**
     * @throws Exception
     */
    public function create(Vendor $vendor, array $attributes): Room
    {
        try {
            DB::beginTransaction();

            /** @var Room $room */
            $room = $vendor->rooms()->create(Arr::except($attributes, 'special_properties')); // create a room for vendor
            $this->assignSpecialProperties($attributes, $room);

            DB::commit();
            return $room;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical('room creation failed.', [
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'vendor_id' => $vendor->id,
            ]);
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    public function update(Room $room, array $attributes): Room
    {
        try {
            DB::beginTransaction();

            $room->update(Arr::except($attributes, 'special_properties')); // update the room
            $this->assignSpecialProperties($attributes, $room);

            DB::commit();
            return $room;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical('room update failed.', [
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'room_id' => $room->id,
                'vendor_id' => $room->vendor->id,
            ]);
            throw $exception;
        }
    }

    public function destroy(Room $room): bool
    {
        try {
            DB::beginTransaction();

            $room->delete(); // delete the room
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical('room deletion failed.', [
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'room_id' => $room->id,
                'vendor_id' => $room->vendor->id,
            ]);
            throw $exception;
        }
    }


    private function assignSpecialProperties(array $attributes, Room $room): void
    {
        if (array_key_exists('special_properties', $attributes)) {
            // assign special properties is any special properties is exists
            $room->specialProperties()
                ->syncWithoutDetaching(Arr::pluck($attributes['special_properties'], 'value', 'id'));
        }
    }


}