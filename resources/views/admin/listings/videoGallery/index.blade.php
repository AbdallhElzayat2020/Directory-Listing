@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Video Gallery')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>All Listing Video Gallery</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item "><a href="{{ route('admin.listings.index') }}">Listings</a></div>
                <div class="breadcrumb-item active"><a href="javascript:void(0)">Video Gallery</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Video Gallery</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Video Gallery</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.listings.videos-gallery.store', $listing) }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>YouTube Video URL</label>

                                    <textarea type="url" class="form-control"
                                              name="video_url"
                                              placeholder="If you have a YouTube video link, paste it here.">{{ old('video_url') }}</textarea>

                                    @error('video_url')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <small class="text-muted">
                                        Paste the YouTube video link (Public or Unlisted).
                                    </small>
                                </div>

                                <button class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Add Video
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="section-body">
            <h2 class="section-title">All Videos</h2>

            <div class="row">

                @forelse($videos as $video)

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                        <div class="card shadow-sm">

                            {{-- img element --}}
                            <img
                                src="https://img.youtube.com/vi/{{ $video->video_url }}/hqdefault.jpg"
                                class="card-img-top"
                                style="height:200px;object-fit:cover;">

                            <div class="card-body text-center">

                                {{-- view Video --}}
                                <a
                                    href="https://www.youtube.com/watch?v={{ $video->video_url }}"
                                    target="_blank"
                                    class="btn btn-info btn-sm">

                                    <i class="fas fa-play"></i>

                                </a>

                                <form action="{{ route('admin.listings.videos-gallery.destroy', [$listing,$video]) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this video?')">

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

