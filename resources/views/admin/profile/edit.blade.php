@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Profile</h4>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ old('name', $profile->name) }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Headline</label>
                                        <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bio</label>
                                    <textarea name="bio" rows="4" class="form-control">{{ old('bio', $profile->bio) }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Birthdate</label>
                                        <input type="date" name="birthdate" value="{{ old('birthdate', optional($profile->birthdate)->format('Y-m-d')) }}" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Location</label>
                                        <input type="text" name="location" value="{{ old('location', $profile->location) }}" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Avatar</label>
                                        <input type="file" name="avatar" class="form-control" accept="image/*">
                                        @if ($profile->avatar)
                                            <div class="mt-2">
                                                <img
                                                    src="{{ str_starts_with($profile->avatar, 'http') || str_starts_with($profile->avatar, '/') ? $profile->avatar : Storage::url($profile->avatar) }}"
                                                    alt=""
                                                    style="max-height: 90px;"
                                                >
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">About Photo</label>
                                        <input type="file" name="about_image" class="form-control" accept="image/*">
                                        @if ($profile->about_image)
                                            <div class="mt-2">
                                                <img
                                                    src="{{ str_starts_with($profile->about_image, 'http') || str_starts_with($profile->about_image, '/') ? $profile->about_image : Storage::url($profile->about_image) }}"
                                                    alt=""
                                                    style="max-height: 90px;"
                                                >
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Resume URL</label>
                                        <input type="text" name="resume_url" value="{{ old('resume_url', $profile->resume_url) }}" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">GitHub URL</label>
                                        <input type="text" name="github_url" value="{{ old('github_url', $profile->github_url) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">LinkedIn URL</label>
                                        <input type="text" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url) }}" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Twitter URL</label>
                                        <input type="text" name="twitter_url" value="{{ old('twitter_url', $profile->twitter_url) }}" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
