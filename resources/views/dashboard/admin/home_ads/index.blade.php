@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Home Page Ads') }}</title>
@endsection

<div id="alert-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; max-width: 300px;">
    @if (session('success'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #47C363; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #ff0018; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('error') }}
        </div>
    @endif
</div>

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Home Page Advertisements') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Home Ads') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Manage Home Page Ads') }}</h4>
                                <div>
                                    <a href="{{ route('admin.home-ads.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('Add New Ad') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Position') }}</th>
                                                <th>{{ __('Order') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th class="text-center">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ads as $key => $ad)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $ad->name ?? 'N/A' }}</td>
                                                    <td>
                                                        <span class="badge badge-info">
                                                            {{ \App\Models\HomeAd::positionOptions()[$ad->position] }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $ad->order }}</td>
                                                    <td>
                                                        <form action="{{ route('admin.home-ads.toggle-status', $ad->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm {{ $ad->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                                {{ $ad->is_active ? 'Active' : 'Inactive' }}
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.home-ads.edit', $ad->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.home-ads.destroy', $ad->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this ad?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">{{ __('No advertisements found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                
                                @if($ads->hasPages())
                                    <div class="mt-3">
                                        {{ $ads->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert-message');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        });
    }, 5000);
</script>
