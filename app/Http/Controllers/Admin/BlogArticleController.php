<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogArticle;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogArticleController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($id)
  {
    // Get category by id
    $category = BlogCategory::where('id', $id)->first();
    // Get all data
    $articles = BlogArticle::where('category_id', $id)->paginate(05);

    return view('dashboard.admin.blog_article.index', ['articles' => $articles, 'category' => $category]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
    // Get category by id
    $category = BlogCategory::where('id', $id)->first();
    return view('dashboard.admin.blog_article.add', ['category' => $category]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $id)
  {
    // Validate data
    $this->validate($request, [
      'title'  => 'required|string',
      'image'  => 'image|mimes:jpeg,png,jpg,gif,svg',
      'status' => 'required',
    ]);

    if ($request->hasFile('image')) {
      // Generate image name based on title or slug
      $titleSlug = Str::slug($request->title, '-');
      $fileData = $request->file('image');
      $fileNameToStore = 'blog/article/' . $this->uploadImage($fileData, $titleSlug, '/public/blog/article');
    } else {
      $fileNameToStore = 'blog/article/no_img.jpg';
    }

    $data = [
      'category_id' => $id,
      'page_title'  => $request->page_title,
      'meta_desc'   => $request->meta_desc,
      'title'       => $request->title,
      'slug'        => Str::slug($request->title, '-'),
      'description' => $request->description,
      'image'       => $fileNameToStore,
      'status'      => $request->status,
      'author_id'   => Auth::id(), // Set the author ID as the logged-in user's ID
    ];

    $article = BlogArticle::create($data);

    if ($article) {
    return redirect()->route('blog.article.view', ['id' => $id])
    ->with('success', 'Article Created Successfully.');
}
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\BlogArticle  $blogArticle
   * @return \Illuminate\Http\Response
   */
  public function show(BlogArticle $blogArticle)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\BlogArticle  $blogArticle
   * @return \Illuminate\Http\Response
   */
  public function edit(BlogArticle $blogArticle, $id)
  {
    // Get single blog category details
    $article = BlogArticle::where('id', $id)->first();

    // Get single blog category details
    $category = BlogCategory::where('id', $article->category_id)->first();

    return view('dashboard.admin.blog_article.edit', ['article' => $article, 'category' => $category]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\BlogArticle  $blogArticle
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, BlogArticle $blogArticle, $id)
  {
      // Validate data
      $this->validate($request, [
          'title'  => 'required|string',
          'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
          'status' => 'required',
      ]);

      // Get the current article
      $article = $blogArticle->where('id', $id)->first();

      // Set the default image (keep the existing image if no new image is uploaded)
      $fileNameToStore = $article->image;

      if ($request->hasFile('image')) {
          // Define storage location
          $loc = 'public/blog/article';
          $fileData = $request->file('image');
          $titleSlug = Str::slug($request->title, '-');

          // Upload the new image using your existing function
          $fileNameToStore = 'blog/article/' . $this->uploadImage($fileData, $titleSlug, $loc);

          // Delete the old image (if it's not the default no_img.jpg)
          if ($article->image !== 'blog/article/no_img.jpg') {
              Storage::delete('public/' . $article->image);
          }
      }
      // If no new image, keep the existing image path
      // No need to rename or move the file

      $data = [
          'page_title'  => $request->page_title,
          'meta_desc'   => $request->meta_desc,
          'title'       => $request->title,
          'slug'        => Str::slug($request->title, '-'),
          'description' => $request->description,
          'image'       => $fileNameToStore, // Already includes full path
          'status'      => $request->status,
          'author_id'   => Auth::id(),
      ];

      // Update data in the database
      $updated = $blogArticle->where('id', $id)->update($data);

      if ($updated) {
          return redirect()->route('blog.article.view', ['id' => $request->category_id])
              ->with('success', 'Article Updated Successfully.');
      }
  }



  /**
   * Generate a unique file name for the image.
   *
   * @param string $fileName
   * @param string $fileExtension
   * @param string $directory
   * @return string
   */
  private function generateUniqueFileName($fileName, $fileExtension, $directory)
  {
      $counter = 1;
      $fileNameToStore = $fileName . '.' . $fileExtension;

      while (Storage::exists($directory . '/' . $fileNameToStore)) {
          $fileNameToStore = $fileName . '-' . $counter . '.' . $fileExtension;
          $counter++;
      }

      return $fileNameToStore;
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\BlogArticle  $blogArticle
   * @return \Illuminate\Http\Response
   */
  public function destroy(BlogArticle $blogArticle, $id)
  {
    // delete category image
    $article = $blogArticle->select('id', 'category_id', 'image')->where('id', $id)->first();
    if ($article->image != 'blog/article/no_img.jpg') {
      Storage::delete('public/' . $article->image);
    }

    //Delete user data
    $result = $blogArticle->destroy($id);

    if ($result) {
        return redirect()->route('blog.article.view', ['id' => $article->category_id])
    ->with('success', 'Article Deleted Successfully.');
    }
  }

  /**
   * Image upload.
   *
   * @param string $field
   * @param string $loc
   * @return \Illuminate\Http\Response
   */
  public function uploadImage($fileData, $titleSlug, $loc)
  {
    $extension = $fileData->extension();
    $fileName = $titleSlug;
    $counter = 0;

    // Ensure the file name is unique
    while (Storage::exists($loc . '/' . $fileName . ($counter ? "-$counter" : '') . '.' . $extension)) {
      $counter++;
    }

    $finalFileName = $fileName . ($counter ? "-$counter" : '') . '.' . $extension;
    $fileData->storeAs($loc, $finalFileName);

    return $finalFileName;
  }


  public function updateStatus(Request $request)
  {
      $article = BlogArticle::find($request->article_id);

      if ($article) {
          $article->status = $request->status == 1 ? 1 : 0; // Ensure boolean value
          $article->save();
          return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
      }

      return response()->json(['success' => false, 'message' => 'Article not found.']);
  }

  public function updateApproval(Request $request)
  {
      $article = BlogArticle::find($request->article_id);

      if ($article) {
          // Ensure that the approval status matches allowed ENUM values
          $allowedStatuses = ['Pending', 'Approved', 'Failed'];
          if (!in_array($request->approval, $allowedStatuses)) {
              return response()->json(['success' => false, 'message' => 'Invalid approval status.']);
          }

          $article->approval = $request->approval;
          $article->save();

          return response()->json(['success' => true, 'message' => 'Approval status updated successfully.']);
      }

      return response()->json(['success' => false, 'message' => 'Article not found.']);
  }


}
