@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Profile')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.profile.index') }}">Profile</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Profile</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Avatar Section -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Current Avatar</label>
                                            <div class="mb-3">
                                                @if($profile->avatar)
                                                    <img src="{{ asset('avatars/' . $profile->avatar) }}"
                                                         alt="Current Avatar"
                                                         style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 2px solid #ddd;">
                                                @else
                                                    <div class="text-muted">No avatar uploaded</div>
                                                @endif
                                            </div>
                                            <label for="avatar-input">Change Avatar</label>
                                            <input type="file"
                                                   name="avatar"
                                                   id="avatar-input"
                                                   class="form-control"
                                                   accept="image/*">
                                        </div>
                                    </div>

                                    <!-- Banner Section -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Current Banner</label>
                                            <div class="mb-3">
                                                @if($profile->banner)
                                                    <img src="{{ asset('banners/' . $profile->banner) }}"
                                                         alt="Current Banner"
                                                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px; border: 2px solid #ddd;">
                                                @else
                                                    <div class="text-muted">No banner uploaded</div>
                                                @endif
                                            </div>
                                            <label for="banner-input">Change Banner</label>
                                            <input type="file"
                                                   name="banner"
                                                   id="banner-input"
                                                   class="form-control"
                                                   accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <!-- باقي الحقول -->
                                <div class="row my-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   id="name"
                                                   placeholder="Please enter your name"
                                                   name="name"
                                                   value="{{ $profile->name }}"
                                                   class="form-control">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email"
                                                   id="email"
                                                   placeholder="Please enter your email"
                                                   name="email"
                                                   value="{{ $profile->email }}"
                                                   class="form-control">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text"
                                                   id="phone"
                                                   placeholder="Please enter your phone"
                                                   name="phone"
                                                   value="{{ $profile->phone }}"
                                                   class="form-control">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text"
                                                   id="address"
                                                   placeholder="Please enter your address"
                                                   name="address"
                                                   value="{{ $profile->address }}"
                                                   class="form-control">
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="website">Website</label>
                                            <input type="text"
                                                   id="website"
                                                   placeholder="Please enter your website"
                                                   name="website"
                                                   value="{{ $profile->website }}"
                                                   class="form-control">
                                            @error('website')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="facebook_link">Facebook</label>
                                            <input type="text"
                                                   id="facebook_link"
                                                   placeholder="Please enter your facebook"
                                                   name="facebook_link"
                                                   value="{{ $profile->facebook_link }}"
                                                   class="form-control">
                                            @error('facebook_link')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="x_link">X Link</label>
                                            <input type="text"
                                                   id="x_link"
                                                   placeholder="Please enter your x link"
                                                   name="x_link"
                                                   value="{{ $profile->x_link }}"
                                                   class="form-control">
                                            @error('x_link')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="linkedin_link">LinkedIn Link</label>
                                            <input type="text"
                                                   id="linkedin_link"
                                                   placeholder="Please enter your linkedin link"
                                                   name="linkedin_link"
                                                   value="{{ $profile->linkedin_link }}"
                                                   class="form-control">
                                            @error('linkedin_link')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="instagram_link">Instagram Link</label>
                                            <input type="text"
                                                   id="instagram_link"
                                                   placeholder="Please enter your instagram link"
                                                   name="instagram_link"
                                                   value="{{ $profile->instagram_link }}"
                                                   class="form-control">
                                            @error('instagram_link')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="whatsapp">Whatsapp</label>
                                            <input type="text"
                                                   id="whatsapp"
                                                   placeholder="Please enter your whatsapp"
                                                   name="whatsapp"
                                                   value="{{ $profile->whatsapp }}"
                                                   class="form-control">
                                            @error('whatsapp')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-4">
                                        <div class="form-group">
                                            <label for="about">About</label>
                                            <textarea id="about"
                                                      name="about"
                                                      class="form-control summernote-simple">{{ $profile->about }}</textarea>
                                            @error('about')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
