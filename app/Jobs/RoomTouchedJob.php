<?php

namespace App\Jobs;

use App\Models\Room;
use FarshidRezaei\Larabbitmq\Facades\Larabbitmq;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RoomTouchedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly ?Room $room, private readonly string $changeType)
    {
        $this->onQueue('room-touched');
    }

    public function handle(): void
    {
        $this->room->load('vendor', 'specialProperties');
        Larabbitmq::publish(
            'room_touched',
            'room_touched',
            json_encode([
                'change_type' => $this->changeType,
                'room' => $this->room?->toArray()
            ])
        );
    }
}
