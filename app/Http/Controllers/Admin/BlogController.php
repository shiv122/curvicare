<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUploader;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\BlogTag;
use App\Models\Dietician;

class BlogController extends Controller
{
    public function add()
    {
        $tags = Tag::active()->get();
        $dieticians = Dietician::active()->get();
        return view('content.forms.add-blog', compact('tags', 'dieticians'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags.*' => 'required|exists:tags,id',
            'dietician' => 'nullable|exists:dieticians,id',
        ]);

        $blog =  Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'dietician_id' => $request->dietician ?? 0,
        ]);
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $images[] = [
                    'blog_id' => $blog->id,
                    'image' => FileUploader::uploadFile($image, 'images/blogs'),
                    'created_at' => now(),
                ];
            }
        }
        $blogTags  = [];

        foreach ($request->tags as $tag) {
            $blogTags[] = [
                'blog_id' => $blog->id,
                'tag_id' => $tag,
                'created_at' => now(),
            ];
        }

        BlogImage::insert($images);
        BlogTag::insert($blogTags);

        return response([
            'header' => 'Success',
            'message' => 'Blog added successfully',
            'reload' => true,
        ]);
    }
    public function view()
    {
        $blogs = Blog::with(['image', 'tags', 'dietician'])->get();
        // dd($blogs);
        return view('content.pages.blog-list', compact('blogs'));
    }
    public function status()
    {
    }
}
