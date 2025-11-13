@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Create Home Ad') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Home Page Advertisement') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.home-ads.index') }}">{{ __('Home Ads') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Create') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Add New Advertisement') }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.home-ads.store') }}" method="POST">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">{{ __('Ad Name') }} <small>(Optional - for identification)</small></label>
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g., Top Banner Ad">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="position">{{ __('Position') }} <code>*</code></label>
                                                <select name="position" id="position" class="form-control @error('position') is-invalid @enderror" required>
                                                    <option value="">{{ __('Select Position') }}</option>
                                                    @foreach($positions as $key => $value)
                                                        <option value="{{ $key }}" {{ old('position') == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('position')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="order">{{ __('Order') }} <small>(Lower number = higher priority)</small></label>
                                                <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" min="0">
                                                @error('order')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="is_active">{{ __('Status') }}</label>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="is_active">{{ __('Active') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="ad_code">{{ __('AdSense Code') }} <code>*</code></label>
                                                <textarea name="ad_code" id="ad_code" rows="10" class="form-control @error('ad_code') is-invalid @enderror" required placeholder="Paste your AdSense code here...">{{ old('ad_code') }}</textarea>
                                                @error('ad_code')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">
                                                    Paste your complete AdSense ad code here, including &lt;script&gt; tags.
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> {{ __('Create Advertisement') }}
                                        </button>
                                        <a href="{{ route('admin.home-ads.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-times"></i> {{ __('Cancel') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Help Card -->
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('How to Get AdSense Code') }}</h4>
                            </div>
                            <div class="card-body">
                                <ol>
                                    <li>Go to your <a href="https://www.google.com/adsense/" target="_blank">Google AdSense Dashboard</a></li>
                                    <li>Click on "Ads" in the left sidebar</li>
                                    <li>Click "By ad unit" tab</li>
                                    <li>Create a new ad unit or select an existing one</li>
                                    <li>Copy the ad code and paste it in the "AdSense Code" field above</li>
                                </ol>
                                <p class="mb-0"><strong>Position Options:</strong></p>
                                <ul>
                                    <li><strong>After Featured Post:</strong> Ad appears right after the featured post section</li>
                                    <li><strong>Before Latest Posts:</strong> Ad appears before the latest articles section</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
