<?php

namespace App\Services;

use App\Models\Offer;
use Illuminate\Support\Facades\DB;

class OfferService
{

    public function store(array $data,$offer_img)
    {
        DB::transaction(function () use ($data,$offer_img) {
            $data = array_merge([
                'author_id' => auth()->user()->id,
            ], $data);
            /*$request['author_id'] = auth()->user()->id; */
            $offer = Offer::create($data);
            $offer->categories()->sync($data['categories']);
            $offer->locations()->sync($data['locations']);
            if($offer_img){
                $offer
                ->addMedia($offer_img)
                ->toMediaCollection();
            }
        }, 3);
    }
    public function update(Offer $offer, $data,$offer_img)
    {
        DB::transaction(function () use ($offer,$data,$offer_img) {
            $data = array_merge([
                'author_id' => auth()->user()->id,
            ], $data);
            /*$request['author_id'] = auth()->user()->id; */
            $offer = tap($offer)->update($data);
            $offer->categories()->sync($data['categories']);
            $offer->locations()->sync($data['locations']);
            if($offer_img){
                $offer
                ->addMedia($offer_img)
                ->toMediaCollection();
            }
        }, 3);
    }
}
