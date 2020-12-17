<?php

namespace App\Resource\Mobile;

use Carbon\Carbon;
use Hyperf\Resource\Json\JsonResource;

class BoardResource extends JsonResource
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
            'board_id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }


    public function showResource()
    {
        $this->withoutWrapping();
        return [
            'board_id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }

}
