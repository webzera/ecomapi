<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'customer' => $this->customer,            
            'review' => $this->review,
            'rating' => $this->star,
            'href' => [
                'link' => route('reviews.show',[ 'product'=> $this->product_id, 'review'=> $this->id]) 
            ],
        ];
        return parent::toArray($request);
    }
}
