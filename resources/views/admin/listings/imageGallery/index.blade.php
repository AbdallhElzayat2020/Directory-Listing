@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Image Gallery')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>All Listing Gallery</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item "><a href="{{ route('admin.listings.index') }}">Listings</a></div>
                <div class="breadcrumb-item active"><a href="javascript:void(0)">Image Gallery</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Image Gallery</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Image Gallery - {{$listing->title}}</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.listings.gallery.store', $listing->id) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf

                                {{--                                <input type="hidden" name="listing_id" value="{{request()->id}}"> --}}
                                <div class="form-group">
                                    <label for="images">Images <code>(Multi Image Supported)</code></label>
                                    <input type="file" class="form-control" id="images" name="images[]"
                                           multiple="multiple" accept="image/*">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="section-body">
            <h2 class="section-title">All Images - {{$listing->title}}</h2>

            <div class="row">

                @forelse($images as $image)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                        <div class="card shadow-sm">

                            {{-- img element --}}
                            <img src="{{ asset('listing_images/' . $image->image) }}" class="card-img-top"
                                 style="height:200px;" alt="{{ $listing->title }}">

                            <div class="card-body text-center">

                                {{-- view image --}}
                                <a href="{{ asset('listing_images/' . $image->image) }}" target="_blank"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="{{ route('admin.listings.gallery.destroy', [$listing, $image]) }}"
                                      method="POST" class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this image?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">
                        <div class="alert alert-info">
                            No Images Found.
                        </div>
                    </div>
                @endforelse

            </div>


        </div>
    </section>
@endsection
