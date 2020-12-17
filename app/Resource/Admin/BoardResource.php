<?php

namespace App\Resource\Admin;

use Carbon\Carbon;
use Hyperf\Resource\Json\JsonResource;

class BoardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(): array
    {
        return $this->{$this->resource_name . 'Resource'}();
    }

    public function indexResource()
    {
        return [
            'board_id'       => $this->id,
            'admin_username' => optional($this->admin)->username,
            'title'          => $this->title,
            'content'        => $this->content,
            'created_at'     => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }

    public function showResource()
    {
        $this->withoutWrapping();

        return [
            'board_id'   => $this->id,
            'title'      => $this->title,
            'content'    => $this->content,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
