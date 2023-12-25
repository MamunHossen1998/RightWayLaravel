<?php
    use App\Models\User;
?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <p>
                            Image: <img src="{{ $offer->image_url }}" alt="" height="100 px" width="100 px">
                        </p>
                       
                        <p><strong>Title :</strong> {{ $offer->title }}</p> 
                        <p><strong>Price :</strong> {{ $offer->price }}</p> 
                        <p><strong>Description :</strong>{{ $offer->description }}</p>
                        <p><strong>Status :</strong>{{ $offer->status }}</p>
                        <p><strong>Category :</strong>{{getTitles($offer->categories) }}</p>
                        <p><strong>Location :</strong>{{ getTitles($offer->locations) }}</p>
                        <p><strong>Author :</strong>{{ @$offer->author->name  }}</p>
                        <p><strong>Created at :</strong>{{ $offer->created_at }}</p>
                        <p><strong>Updated at :</strong>{{ $offer->updated_at }}</p>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection