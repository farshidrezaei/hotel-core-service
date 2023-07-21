<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\specialProperty */
class SpecialPropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->resource->title,
            'value' => $this->resource->pivot->value,
        ];
    }
}
