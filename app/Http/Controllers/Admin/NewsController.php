<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNewsRequest;
use App\Http\Requests\MassDestroyProjectRequest;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\News;
use App\Project;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(StoreNewsRequest $request)
    {
        if ($request->hasFile("photo")) {
            $request->file("photo")[0]->move(public_path().'/images/', $img = 'img_'.Str::random(15));
            News::create([
                'title' => $request->title,
                'description' => $request->description,
                'photo' => 'images/' . $img
            ]);
        }
        return redirect()->route('admin.news.index');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        if ($request->hasFile("photo")) {
            $request->file("photo")[0]->move(public_path().'/images/', $img = 'img_'.Str::random(15));
            $news->update([
                'title' => $request->title,
                'description' => $request->description,
                'photo' => 'images/' . $img
            ]);
        }
        else {
            $news->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }
        return redirect()->route('admin.news.index');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function destroy(News $news)
    {
        $news->delete();
        return back();
    }

    public function massDestroy(MassDestroyNewsRequest $request)
    {
        News::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
