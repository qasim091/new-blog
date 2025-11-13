@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Edit Blog Category Button') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Blog Category Button') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.blog-category-buttons.index') }}">{{ __('Blog Category Buttons') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Edit') }}</div>
                </div>
            </div>
            
            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="instructor__profile-form-wrap mt-4">
                                        <form action="{{ route('admin.blog-category-buttons.update', $blogCategoryButton) }}" method="POST" 
                                              class="instructor__profile-form">
                                            @csrf
                                            @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title', $blogCategoryButton->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                           id="slug" name="slug" value="{{ old('slug', $blogCategoryButton->slug) }}">
                                    <small class="form-text text-muted">Leave empty to auto-generate from title</small>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Blog Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                            id="category_id" name="category_id">
                                        <option value="">Select Category (Optional)</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $blogCategoryButton->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="url">Custom URL</label>
                                    <input type="url" class="form-control @error('url') is-invalid @enderror"
                                           id="url" name="url" value="{{ old('url', $blogCategoryButton->getOriginal('url')) }}">
                                    <small class="form-text text-muted">Leave empty to use category URL</small>
                                    @error('url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bg_color">Background Color <span class="text-danger">*</span></label>
                                    <select class="form-control @error('bg_color') is-invalid @enderror"
                                            id="bg_color" name="bg_color" required>
                                        <option value="bg-primary" {{ old('bg_color', $blogCategoryButton->bg_color) == 'bg-primary' ? 'selected' : '' }}>Primary</option>
                                        <option value="bg-secondary" {{ old('bg_color', $blogCategoryButton->bg_color) == 'bg-secondary' ? 'selected' : '' }}>Secondary</option>
                                        <option value="bg-success" {{ old('bg_color', $blogCategoryButton->bg_color) == 'bg-success' ? 'selected' : '' }}>Success</option>
                                        <option value="bg-danger" {{ old('bg_color', $blogCategoryButton->bg_color) == 'bg-danger' ? 'selected' : '' }}>Danger</option>
                                        <option value="bg-warning" {{ old('bg_color', $blogCategoryButton->bg_color) == 'bg-warning' ? 'selected' : '' }}>Warning</option>
                                        <option value="bg-info" {{ old('bg_color', $blogCategoryButton->bg_color) == 'bg-info' ? 'selected' : '' }}>Info</option>
                                        <option value="bg-dark" {{ old('bg_color', $blogCategoryButton->bg_color) == 'bg-dark' ? 'selected' : '' }}>Dark</option>
                                    </select>
                                    @error('bg_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="text_color">Text Color <span class="text-danger">*</span></label>
                                    <select class="form-control @error('text_color') is-invalid @enderror"
                                            id="text_color" name="text_color" required>
                                        <option value="text-white" {{ old('text_color', $blogCategoryButton->text_color) == 'text-white' ? 'selected' : '' }}>White</option>
                                        <option value="text-dark" {{ old('text_color', $blogCategoryButton->text_color) == 'text-dark' ? 'selected' : '' }}>Dark</option>
                                        <option value="text-primary" {{ old('text_color', $blogCategoryButton->text_color) == 'text-primary' ? 'selected' : '' }}>Primary</option>
                                        <option value="text-secondary" {{ old('text_color', $blogCategoryButton->text_color) == 'text-secondary' ? 'selected' : '' }}>Secondary</option>
                                    </select>
                                    @error('text_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sort_order">Sort Order <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', $blogCategoryButton->sort_order) }}" min="0" required>
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active"
                                               name="is_active" value="1" {{ old('is_active', $blogCategoryButton->is_active) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Button
                        </button>
                        <a href="{{ route('admin.blog-category-buttons.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
});
</script>
@endsection
