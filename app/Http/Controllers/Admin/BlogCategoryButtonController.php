<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoryButton;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryButtonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buttons = BlogCategoryButton::with('category')->ordered()->get();
        return view('admin.blog-category-buttons.index', compact('buttons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog-category-buttons.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_category_buttons',
            'category_id' => 'nullable|exists:blog_categories,id',
            'url' => 'nullable|url',
            'bg_color' => 'required|string|max:50',
            'text_color' => 'required|string|max:50',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        BlogCategoryButton::create($validated);

        return redirect()->route('admin.blog-category-buttons.index')
            ->with('success', 'Blog category button created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategoryButton $blogCategoryButton)
    {
        return view('admin.blog-category-buttons.show', compact('blogCategoryButton'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategoryButton $blogCategoryButton)
    {
        $categories = BlogCategory::all();
        return view('admin.blog-category-buttons.edit', compact('blogCategoryButton', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategoryButton $blogCategoryButton)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_category_buttons,slug,' . $blogCategoryButton->id,
            'category_id' => 'nullable|exists:blog_categories,id',
            'url' => 'nullable|url',
            'bg_color' => 'required|string|max:50',
            'text_color' => 'required|string|max:50',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $blogCategoryButton->update($validated);

        return redirect()->route('admin.blog-category-buttons.index')
            ->with('success', 'Blog category button updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategoryButton $blogCategoryButton)
    {
        $blogCategoryButton->delete();

        return redirect()->route('admin.blog-category-buttons.index')
            ->with('success', 'Blog category button deleted successfully.');
    }
}
