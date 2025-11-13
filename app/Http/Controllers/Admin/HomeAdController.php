<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeAd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = HomeAd::orderBy('position', 'asc')
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('dashboard.admin.home_ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = HomeAd::positionOptions();
        return view('dashboard.admin.home_ads.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'nullable|string|max:255',
            'position' => 'required|in:after_featured,before_latest,home_after_3rd,home_after_7th,blog_after_3rd,blog_after_7th,blog_before_pagination,blog_detail_after_first_paragraph,blog_detail_middle_content,blog_detail_before_last_2_tags',
            'ad_code' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        HomeAd::create([
            'name' => $request->name,
            'position' => $request->position,
            'ad_code' => $request->ad_code,
            'is_active' => $request->has('is_active') ? true : false,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.home-ads.index')
            ->with('success', 'Advertisement created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = HomeAd::findOrFail($id);
        $positions = HomeAd::positionOptions();
        return view('dashboard.admin.home_ads.edit', compact('ad', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'nullable|string|max:255',
            'position' => 'required|in:after_featured,before_latest,home_after_3rd,home_after_7th,blog_after_3rd,blog_after_7th,blog_before_pagination,blog_detail_after_first_paragraph,blog_detail_middle_content,blog_detail_before_last_2_tags',
            'ad_code' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        $ad = HomeAd::findOrFail($id);
        $ad->update([
            'name' => $request->name,
            'position' => $request->position,
            'ad_code' => $request->ad_code,
            'is_active' => $request->has('is_active') ? true : false,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.home-ads.index')
            ->with('success', 'Advertisement updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = HomeAd::findOrFail($id);
        $ad->delete();

        return redirect()->route('admin.home-ads.index')
            ->with('success', 'Advertisement deleted successfully!');
    }

    /**
     * Toggle active status
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus($id)
    {
        $ad = HomeAd::findOrFail($id);
        $ad->is_active = !$ad->is_active;
        $ad->save();

        return redirect()->route('admin.home-ads.index')
            ->with('success', 'Advertisement status updated successfully!');
    }
}
