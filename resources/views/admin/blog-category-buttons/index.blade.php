@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Blog Category Buttons') }}</title>
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
                <h1>{{ __('Blog Category Buttons') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Blog Category Buttons') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Blog Category Buttons List') }}</h4>
                                <div>
                                    <a href="{{ route('admin.blog-category-buttons.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('Add New Button') }}
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('ID') }}</th>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Category') }}</th>
                                                <th>{{ __('URL') }}</th>
                                                <th>{{ __('Colors') }}</th>
                                                <th>{{ __('Sort Order') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($buttons as $button)
                                                <tr>
                                                    <td>{{ $button->id }}</td>
                                                    <td>{{ $button->title }}</td>
                                                    <td>
                                                        @if($button->category)
                                                            <span class="badge badge-info">{{ $button->category->name }}</span>
                                                        @else
                                                            <span class="text-muted">{{ __('No Category') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ $button->url }}" target="_blank" class="text-primary">
                                                            {{ Str::limit($button->url, 30) }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span class="badge {{ $button->bg_color }} {{ $button->text_color }}">
                                                            {{ __('Preview') }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $button->sort_order }}</td>
                                                    <td>
                                                        @if($button->is_active)
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.blog-category-buttons.edit', $button) }}"
                                                               class="btn btn-sm btn-warning">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('admin.blog-category-buttons.destroy', $button) }}"
                                                                  method="POST" class="d-inline"
                                                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this button?') }}')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">{{ __('No buttons found.') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
