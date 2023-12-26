@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Offer list</h4>
                    </div>
                    @if ($offers->count() <=0)
                        <div class="text-center">
                            <h4>Data not found</h4>
                        </div>
                    @else
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No</th>
                                        <th scope="col">Profile</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($offers as $key=> $offer)
                                    
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>
                                                <img class=" w-8 h-8 rounded-full object-cover" src="{{ asset($offer->author->image_url) }}" alt="" height="50 px" width="50 px">
                                            </td>
                                            <td>{{ $offer->author->name }}</td>
                                            <td>
                                                <a href="{{ route('offers.show',$offer) }}"  style=" text-decoration: none;"> <span>{{ $offer->title }}</span></a>
                                            </td>
                                            <td>{{ $offer->description }}</td>
                                            <td>{{ $offer->price }}</td>
                                            <td>{{ getTitles($offer->locations)}}</td>
                                            <td>{{ getTitles($offer->categories) }}</td>
                                            <td>{{ $offer->status }}</td>
                                            <td>
                                                <a href="#" class="btn btn-info">Edit</a>
                                                <a href="#" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $offers->withQueryString()->links('pagination::bootstrap-5') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection