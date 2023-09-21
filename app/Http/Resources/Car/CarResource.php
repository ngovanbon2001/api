<?php

namespace App\Http\Resources\Car;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource['id'],
            'car_category_id' => $this->resource['car_category_id'],
            'driver_id' =>  $this->resource['driver_id'],
            'name' => $this->resource['name'],
            'color' => $this->resource['color'],
            'status' => $this->resource['status'],
            'license_plates' => $this->resource['license_plates'],
            'description' => $this->resource['description'],
            'created_at' => Carbon::parse($this->resource['created_at'])->format('Y-m-d H:i:s'),
        ];
    }
}
