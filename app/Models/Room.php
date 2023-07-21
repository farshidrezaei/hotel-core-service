<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'price_per_night' => 'decimal',
        'beds_count' => 'integer'
    ];


    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function specialProperties(): BelongsToMany
    {
        return $this->belongsToMany(specialProperty::class, 'room_special_property')
            ->using(RoomSpecialProperty::class)
            ->withPivotValue('value');
    }
}
