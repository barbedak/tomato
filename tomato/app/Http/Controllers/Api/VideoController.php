<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Video\StoreRequest;
use App\Http\Requests\Api\Video\UpdateRequest;
use App\Http\Resources\Video\VideoResource;
use App\Models\Video;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    public function index()
    {
        return VideoResource::collection(Video::all())->resolve();
    }

    public function show(Video $video)
    {
        return VideoResource::make($video)->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $video = Video::create($data);
        return VideoResource::make($video)->resolve();
    }

    public function update(Video $video, UpdateRequest $request)
    {
        $data = $request->validated();
        $video = VideoService::update($video, $data);
        return VideoResource::make($video)->resolve();
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return response(['message' => 'Post destroyed'], Response::HTTP_OK);
    }
}
