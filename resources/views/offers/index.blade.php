<?php 
   use App\Constant\Status;
?>
@extends('layouts.app')

@section('content')
    <div class="container ">
         
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="card p-2">
                    <form action="{{ auth()->user()->isAdmin()?route('offers.index'):route('offers.MyOffers') }}" method="GET">
                        @csrf
                        <div class="row">    
                            <div class="col-md-2">
                                {{-- @foreach (App\Constant\Status::LIST as $status )
                                    <select name="s" id="s" class="select3 form-control">
                                        <option value="1">{{ $status }}</option>
                                    </select>
                                @endforeach --}}
                                <select name="status" id="status" class="select3 form-control" style="width:100%;height:30px;">
                                    <option value=""></option>
                                    <option {{ request()->query('status')== Status::DRAFT?'Selected':'' }} value="{{ Status::DRAFT }}">{{ Status::DRAFT }}</option>
                                    <option value="{{ Status::PUBLISHED }}">{{ Status::PUBLISHED }}</option>
                                </select>
                            </div>
                            <div class="col-md-2" >
                                <select name="category" id="category" class="select3 form-control" style="width:100%;height:30px;"> 
                                    <option value=""></option>
                                    @foreach ($categories as $category)
                                            <option {{ request()->query('category')?'Selected':'' }} value="{{ $category->id }}">{{  $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="location" id="location" class="select3 form-control">
                                    <option value=""></option>
                                    @foreach ($locations as $location)
                                        <option {{ request()->query('location')?'Selected':''}} value="{{ $location->id }}">{{  $location->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="text" value="{{ request()->query('title')?request()->query('title'):'' }}" class="form-control" value="" name="title" id="title" placeholder="Title" style="width:100%;height:30px;">
                            </div>
                            <div class="col-md-2" >
                                <button type="submit" class="btn btn-info" class="form-control " style="width:100%;height:30px;"> Search </button>
                            </div>
                            <div class="col-md-2" >
                                <a href="{{ url()->current() }}" class="btn btn-info" class="form-control " style="width:100%;height:30px;"> Clear filter </a>
                            </div>
                            
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    </div> 
    
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Offer list</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('offers.create') }}">New offer create</a></li>
                            </ol>
                        </nav>
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
                                            <td> {{ getTitles($offer->locations)}}</td>
                                            <td>{{ getTitles($offer->categories) }}</td>
                                            <td>{{ $offer->status }}</td>
                                            <td>
                                                <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-info">Edit</a>
                                                {{-- <form action="{{ route('offers.destroy', $offer->id) }}" method="POST"> 
                                                    @csrf
                                                    @method("DELETE")// delete korer ata akta way
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form> --}} 
                                                <button data-delete-route="{{ route('offers.destroy',$offer->id) }}" class="btn btn-danger delele-btn-item" >Delete</button>
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
@push('script') 
    @include('layouts.deleteScript');
    <script>
        $(document).ready(function() {
            $('.select3').select2({
                placeholder: "--Select One--"
            });
        });
    </script>
@endpush
