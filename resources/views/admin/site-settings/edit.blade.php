@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1">Site Settings</h4>
                            <div class="text-muted">Branding, contact details, social accounts, and maintenance mode</div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-soft-secondary">Back to dashboard</a>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.site-settings.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="fw-semibold">Contact Details</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-location" class="form-label">Address</label>
                                        <input id="settings-location" name="location" class="form-control" value="{{ old('location', $profile->location) }}" placeholder="Address">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-email" class="form-label">Email</label>
                                        <input id="settings-email" type="email" name="email" class="form-control" value="{{ old('email', $profile->email) }}" placeholder="Email">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-phone" class="form-label">Telephone</label>
                                        <input id="settings-phone" name="phone" class="form-control" value="{{ old('phone', $profile->phone) }}" placeholder="Phone">
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="fw-semibold">Branding</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="settings-logo" class="form-label">Logo</label>
                                        <input id="settings-logo" type="file" name="logo" class="form-control" accept="image/*">
                                        @if ($profile->logo)
                                            <div class="mt-2">
                                                <img src="{{ Storage::url($profile->logo) }}" alt="Current logo" style="max-height: 48px;">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="fw-semibold">Social Accounts</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-github" class="form-label">GitHub</label>
                                        <input id="settings-github" name="github_url" class="form-control" value="{{ old('github_url', $profile->github_url) }}" placeholder="https://github.com/username">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-linkedin" class="form-label">LinkedIn</label>
                                        <input id="settings-linkedin" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $profile->linkedin_url) }}" placeholder="https://linkedin.com/in/username">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-twitter" class="form-label">Twitter/X</label>
                                        <input id="settings-twitter" name="twitter_url" class="form-control" value="{{ old('twitter_url', $profile->twitter_url) }}" placeholder="https://x.com/username">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-facebook" class="form-label">Facebook</label>
                                        <input id="settings-facebook" name="facebook_url" class="form-control" value="{{ old('facebook_url', $profile->facebook_url) }}" placeholder="https://facebook.com/page">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-instagram" class="form-label">Instagram</label>
                                        <input id="settings-instagram" name="instagram_url" class="form-control" value="{{ old('instagram_url', $profile->instagram_url) }}" placeholder="https://instagram.com/username">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-youtube" class="form-label">YouTube</label>
                                        <input id="settings-youtube" name="youtube_url" class="form-control" value="{{ old('youtube_url', $profile->youtube_url) }}" placeholder="https://youtube.com/@channel">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-dribbble" class="form-label">Dribbble</label>
                                        <input id="settings-dribbble" name="dribbble_url" class="form-control" value="{{ old('dribbble_url', $profile->dribbble_url) }}" placeholder="https://dribbble.com/username">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="settings-googleplus" class="form-label">Google Plus</label>
                                        <input id="settings-googleplus" name="google_plus_url" class="form-control" value="{{ old('google_plus_url', $profile->google_plus_url) }}" placeholder="https://plus.google.com/...">
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="fw-semibold">Maintenance Mode</div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox" value="1" id="settings-maintenance" name="maintenance_enabled" @checked(old('maintenance_enabled', $profile->maintenance_enabled))>
                                            <label class="form-check-label" for="settings-maintenance">Enable maintenance mode</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <label for="settings-maintenance-message" class="form-label">Maintenance message</label>
                                        <textarea id="settings-maintenance-message" name="maintenance_message" class="form-control" rows="2" placeholder="Optional message to show visitors">{{ old('maintenance_message', $profile->maintenance_message) }}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Save Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

