<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    public static $wrap = 'errors';   
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $response = parent::toArray($request);
        $message = array_key_exists('message', $response) ? $response['message'] : 'Validation Error!';
        return [
            'success' => false,
            'message' => $message,
            'errors' => parent::toArray($request),
        ];
    }
}
