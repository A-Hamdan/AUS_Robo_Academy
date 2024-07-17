<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Video;
use App\Http\Resources\VideoResource;

class VideoController extends Controller
{
    public function index(Category $category) {
        $videos = Video::where(['category_id' => $category->id, 'is_active' => true])->get();
        return VideoResource::collection($videos);
    }
}
