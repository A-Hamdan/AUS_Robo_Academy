<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use Auth;

class VideoController extends Controller
{
    public function index(Category $category) {
        $user = Auth::user();

        $videos = Video::where('category_id', $category->id)
        ->when($user->hasRole('teacher') || $user->hasRole('parent'), function ($query) {
            return $query->where('is_active', true);
        })
        ->get();
        $title = 'Videos';
        return view('backend.videos.list', compact('title','videos'));
    }

    public function show(Video $video) {
        return $video;
    }

    public function create() {
        $title = 'Upload New Video';
        return view('backend.videos.form', compact('title'));
    }

    public function store(StoreVideoRequest $request) {
        $image = $request->file('image')->store('admin/media/feature_image', 'public');
        $video = $request->file('video')->store('admin/media/videos', 'public');

        $video = Video::create([
            'category_id' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'storage/'.$image,
            'video' => 'storage/'.$video,

        ]);
        return redirect()->route('videos.index',$video->category_id)->with('success', $request->title .' has been added successfully.');
    }

    public function edit(Video $video) {
        $title = 'Update ' . $video->title;
        return view('backend.videos.form', compact('title','video'));
    }
    // kamran ali

    public function showVideo_category() {
        // dd('yes');
        $categories = Category::where('type','video')->get();
        $title = 'Vedio Category';
        // dd($categories);
        return view('backend.categories.student.vedio_category', compact('title','categories'));
    }
    public function show_video(Category $category) {
        $videos = Video::where('category_id',$category->id)->get();
        $title = 'Videos';
        // dd($videos);
        return view('backend.categories.student.vedio_list', compact('title','videos'));
    }


    public function update(UpdateVideoRequest $request, Video $video) {

        if($request->has('image')) {
            $image = $request->file('image')->store('admin/media/feature_image', 'public');
        }

        if($request->has('video')) {
            $videoFile = $request->file('video')->store('admin/media/videos', 'public');
        }

        $video->update([
            'category_id' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            $request->has('image') ? 'image' : '' => $request->has('image') ? 'storage/'.$image : '',
            $request->has('video') ? 'video' : '' => $request->has('video') ? 'storage/'.$videoFile : '',
        ]);
        return redirect()->route('videos.index',$video->category_id)->with('success', $request->title .' has been updated successfully.');
    }

    public function status(Video $video) {
        $status = $video->is_active == 1 ? 0 : 1;
        $video->update(['is_active' => $status]);
        return back()->with('success', $status == 1 ? $video->title.' has been changed to Enabled.' : $video->title. ' has been changed to Disabled.');
    }

    public function destroy(Video $video) {
        $video->delete();
        return back()->with('success', $video->title . ' has been deleted successfully.');
    }
}
