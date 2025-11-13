@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Edit Home Ad') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Home Page Advertisement') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.home-ads.index') }}">{{ __('Home Ads') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edit') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Edit Advertisement') }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.home-ads.update', $ad->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">{{ __('Ad Name') }} <small>(Optional - for identification)</small></label>
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $ad->name) }}" placeholder="e.g., Top Banner Ad">
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
                                                        <option value="{{ $key }}" {{ old('position', $ad->position) == $key ? 'selected' : '' }}>
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
                                                <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $ad->order) }}" min="0">
                                                @error('order')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="is_active">{{ __('Status') }}</label>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" {{ old('is_active', $ad->is_active) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="is_active">{{ __('Active') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="ad_code">{{ __('AdSense Code') }} <code>*</code></label>
                                                <textarea name="ad_code" id="ad_code" rows="10" class="form-control @error('ad_code') is-invalid @enderror" required placeholder="Paste your AdSense code here...">{{ old('ad_code', $ad->ad_code) }}</textarea>
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
                                            <i class="fa fa-save"></i> {{ __('Update Advertisement') }}
                                        </button>
                                        <a href="{{ route('admin.home-ads.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-times"></i> {{ __('Cancel') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Preview Card -->
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Current Ad Preview') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <strong>Position:</strong> {{ $positions[$ad->position] }}<br>
                                    <strong>Status:</strong> {{ $ad->is_active ? 'Active' : 'Inactive' }}<br>
                                    <strong>Order:</strong> {{ $ad->order }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
