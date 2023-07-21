<?php

namespace App\Observers;

use App\Jobs\RoomTouchedJob;
use App\Models\Room;

class RoomObserver
{
    public function created(Room $room): void
    {
        RoomTouchedJob::dispatch($room, 'created');
    }

    public function updated(Room $room): void
    {
        RoomTouchedJob::dispatch($room, 'updated');
    }

    public function deleted(Room $room): void
    {
        RoomTouchedJob::dispatch(null, 'deleted');
    }

    public function restored(Room $room): void
    {
    }

    public function forceDeleted(Room $room): void
    {
    }
}
