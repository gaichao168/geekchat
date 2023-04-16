<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'openid'=>$this->openid,
            'subscribe'=>$this->subscribe,
            'key'=>$this->userGptKey?->key,
            'start_at'=>$this->userGptKey?->start_at,
            'end_at'=>$this->userGptKey?->end_at,
            'created_at'=>$this->created_at->toDateTimeString(),
        ];
    }
}
