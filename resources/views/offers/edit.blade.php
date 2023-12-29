<?php
use App\Models\Offer;
use App\Models\Location;
use App\Models\Category;
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Offers</h4>
                    </div>
                    {{-- @if ($errors->all())
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    @endif --}}
                    <div class="card-body">
                        {{-- @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif --}}
                        <div class="row">
                            <form action="{{ route('offers.update', $offer->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title', $offer->title) }}">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Price<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        value="{{ old('price', $offer->price) }}">
                                    @error('price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="categories">Category<span class="text-danger">*</span></label>
                                    <select name="categories[]" id="categories" maltiple class="form-control ">
                                        <option value="">--Select One--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('categories.*')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="locations">Location<span class="text-danger">*</span></label>
                                    <select name="locations[]" id="locations" class="form-control" maltiple>
                                        <option value="">--Location--</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->title }}</option>
                                        @endforeach
                                       
                                    </select>
                                    {{-- @php
                                        $categories = $offer->categories->pluck('id')->toArray();
                                        $categories= implode(',',$categories);
                                    @endphp
                                       
                                        <script>
                                            var selectedCategory = '<?= "[".$categories."]" ?>';
                                            console.log(selectedCategory);
                                        </script> --}}
                                    @error('locations.*')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group image-preview">
                                    <label for="offer_img">Image</label>
                                    <img src="{{ asset($offer->image_url) }}" alt="" height="150" width="150">
                                    <input type="file" id="offer_img" name="offer_img"
                                        class="image-upload-input form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="description" cols="5" rows="5">{{ old('description', $offer->description) }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    $categories = json_encode($offer->categories->pluck('id')->toArray(), true);
    $locations = json_encode($offer->locations->pluck('id')->toArray(), true);
@endphp

@push('script')
    {{-- @include('layouts.image_perview') --}}
    <script>
       
        // $(document).ready(function() {
        //     $('.select2').select2({
        //         placeholder: "--Select One--"
        //     });
        // });
        var selectedValues = JSON.parse('<?= $categories ?>');

        // var selectedValues = selectedCategory;
        // IDs of the initially selected options
        var mySelect = new TomSelect("#categories", {
            allowEmptyOption: true,
            create: true,
            plugins: ['remove_button'],
            maxItems: 5,
            items: selectedValues, // Set the initially selected items
            onItemAdd: function() {
                this.setTextboxValue('');
            }
        });

        var selectedValues = JSON.parse('<?= $locations ?>');
        // IDs of the initially selected options
        var mySelect = new TomSelect("#locations", {
            allowEmptyOption: true,
            create: true,
            plugins: ['remove_button'],
            maxItems: 5,
            items: selectedValues, // Set the initially selected items
            onItemAdd: function() {
                this.setTextboxValue('');
            }
        });

        $('.image-upload-input').change(() => {
            const files = this.files ?? [];
            const file = this.files[0];
            const previewer = $(this).closest('.image-preview'.find('img'));
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    previewer.attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        })
    </script>
@endpush
