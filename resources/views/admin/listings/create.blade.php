@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Create Listing')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.listings.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Create Listing</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.listings.index') }}">Listings</a>
                </div>
                <div class="breadcrumb-item">Create Listing</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create New Listing</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Listing Information</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.listings.store') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="row">

                                    {{-- Images --}}
                                    <div class="col-lg-12">
                                        <div class="row">

                                            {{--  Main Image --}}
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Main Image <span class="text-danger">*</span></label>
                                                    <input type="file" name="image"
                                                           class="form-control"
                                                           accept="image/*">
                                                    <small class="text-muted">Recommended: 800x600px</small>
                                                    @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{--  Thumbnail Image --}}
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Thumbnail Image <span class="text-danger">*</span></label>
                                                    <input type="file" name="thumbnail_image"
                                                           class="form-control"
                                                           accept="image/*">
                                                    <small class="text-muted">Recommended: 300x300px</small>
                                                    @error('thumbnail_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Category --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Category <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Location --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Location <span class="text-danger">*</span></label>
                                            <select name="location_id" class="form-control">
                                                <option value="">Select Location</option>
                                                @foreach($locations as $location)
                                                    <option value="{{ $location->id }}" @selected(old('location_id') == $location->id)>
                                                        {{ $location->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('location_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Title --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   name="title"
                                                   class="form-control"
                                                   placeholder="Enter listing title"
                                                   value="{{ old('title') }}">
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea name="description" rows="6" class="form-control summernote"
                                                      placeholder="Enter detailed description">{{ old('description') }}</textarea>
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    {{-- Contact Information --}}
                                    <div class="col-lg-12">
                                        <div class="row">

                                            {{--  Phone --}}
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                           name="phone"
                                                           class="form-control"
                                                           placeholder="Enter phone number"
                                                           value="{{ old('phone') }}">
                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{--  Email --}}
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Email <span class="text-danger">*</span></label>
                                                    <input type="email"
                                                           name="email"
                                                           class="form-control"
                                                           placeholder="Enter email address"
                                                           value="{{ old('email') }}">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{--  Website --}}
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Website (Optional)</label>
                                                    <input type="url"
                                                           name="website"
                                                           class="form-control"
                                                           placeholder="https://example.com"
                                                           value="{{ old('website') }}">
                                                    @error('website')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Address <span class="text-danger">*</span></label>
                                            <textarea name="address" rows="2" class="form-control"
                                                      placeholder="Enter full address">{{ old('address') }}</textarea>
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Social Media Links --}}
                                    <div class="col-lg-12">
                                        <h6 class="mt-3 mb-3">Social Media Links</h6>
                                        <div class="row">

                                            {{--  Facebook Link --}}
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Facebook Link</label>
                                                    <input type="url" name="facebook_link"
                                                           class="form-control"
                                                           placeholder="https://facebook.com/..."
                                                           value="{{ old('facebook_link') }}">
                                                    @error('facebook_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{--  X (Twitter) Link --}}
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>X (Twitter) Link</label>
                                                    <input type="url" name="x_link"
                                                           class="form-control"
                                                           placeholder="https://x.com/..."
                                                           value="{{ old('x_link') }}">
                                                    @error('x_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{--  Instagram Link --}}
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Instagram Link</label>
                                                    <input type="url" name="instagram_link"
                                                           class="form-control"
                                                           placeholder="https://instagram.com/..."
                                                           value="{{ old('instagram_link') }}">
                                                    @error('instagram_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{--  LinkedIn Link --}}
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>LinkedIn Link</label>
                                                    <input type="url" name="linkedin_link"
                                                           class="form-control"
                                                           placeholder="https://linkedin.com/..."
                                                           value="{{ old('linkedin_link') }}">
                                                    @error('linkedin_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{--  WhatsApp Link --}}
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>WhatsApp Link</label>
                                                    <input type="url" name="whatsapp_link"
                                                           class="form-control"
                                                           placeholder="https://wa.me/..."
                                                           value="{{ old('whatsapp_link') }}">
                                                    @error('whatsapp_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{--  google_map_embed_code Link --}}
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Google Map Embed Code <sapn class="text-danger">1000 * 400</sapn></label>
                                                    <textarea name="google_map_embed_code" rows="2" class="form-control"
                                                              placeholder="<iframe src='...'></iframe>">{{ old('google_map_embed_code') }}</textarea>
                                                    @error('google_map_embed_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- attachments Files --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Attachments Files</label>
                                            <input type="file" name="attachments" class="form-control">
                                            @error('attachments')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    {{-- Amenities Section --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Amenities</label>
                                                <select class="form-control select2" multiple name="amenities[]">
                                                    @foreach($amenities as $amenity)

                                                        <option value="{{ $amenity->id }}" @selected(in_array($amenity->id, old('amenities', [])))>
                                                            {{ $amenity->title }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('amenities')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Expired Date --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Expired Date <span class="text-danger">*</span></label>
                                            <input type="date" name="expired_date"
                                                   class="form-control"
                                                   value="{{ old('expired_date') }}">
                                            @error('expired_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="active" @selected(old('status') == 'active')>Active</option>
                                                <option value="inactive" @selected(old('status') == 'inactive')>Inactive</option>
                                            </select>
                                            @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Verified --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Verified <span class="text-danger">*</span></label>
                                            <select name="is_verified" class="form-control">
                                                <option value="no" @selected(old('is_verified') == 'no')>No</option>
                                                <option value="yes" @selected(old('is_verified') == 'yes')>Yes</option>
                                            </select>
                                            @error('is_verified')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Featured --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Featured <span class="text-danger">*</span></label>
                                            <select name="is_featured" class="form-control">
                                                <option value="no" @selected(old('is_featured') == 'no')>No</option>
                                                <option value="yes" @selected(old('is_featured') == 'yes')>Yes</option>
                                            </select>
                                            @error('is_featured')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- SEO Section --}}
                                    <div class="col-lg-12">
                                        <h6 class="mt-3 mb-3">SEO Information</h6>
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>SEO Title</label>
                                                    <input type="text" name="seo_title"
                                                           class="form-control"
                                                           placeholder="Meta title (max 255 chars)"
                                                           value="{{ old('seo_title') }}">
                                                    @error('seo_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>SEO Description</label>
                                                    <input type="text" name="seo_description"
                                                           class="form-control"
                                                           placeholder="Meta description (max 255 chars)"
                                                           value="{{ old('seo_description') }}">
                                                    @error('seo_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-save"></i> Create Listing
                                    </button>
                                    <a href="{{ route('admin.listings.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
@endpush
