<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNewsRequest;
use App\Http\Requests\Admin\UpdateNewsRequest;
use App\Http\Resources\Admin\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(15);
        return NewsResource::collection($news);
    }

    public function store(StoreNewsRequest $request)
    {
        $news = News::create($request->validated());
        return new NewsResource($news);
    }

    public function show(News $news)
    {
        return new NewsResource($news);
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        $news->update($request->validated());
        return new NewsResource($news);
    }

    public function destroy(News $news)
    {
        $news->delete();
        return response()->json(['message' => 'News deleted successfully'], 204);
    }
}
