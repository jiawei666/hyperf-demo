<?php

namespace App\Resource\Admin;

use Carbon\Carbon;
use Hyperf\Resource\Json\JsonResource;

class UserResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->{$this->resource_name . 'Resource'}();
    }

    public function indexResource()
    {
        return [
            'user_id' => $this->id,
            'phone' => $this->phone,
            'name' => $this->name,
            'gender_readable' => $this->gender_readable,
            'power' => $this->power,
            'pending_power' => $this->pending_power,
            'filecoin' => $this->filecoin,
            'pending_filecoin' => $this->pending_filecoin,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }


    public function showResource()
    {
        $this->withoutWrapping();
        return [
            'user_id' => $this->id,
            'phone' => $this->phone,
            'name' => $this->name,
            'gender_readable' => $this->gender_readable,
            'power' => $this->power,
            'pending_power' => $this->pending_power,
            'filecoin' => $this->filecoin,
            'pending_filecoin' => $this->pending_filecoin,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }

}
