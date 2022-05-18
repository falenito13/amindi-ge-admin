<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{

    public function allNews() : Response
    {
        return response(News::orderByDesc('id')->paginate(16),200);
    }

    public function news(Request $request) : Response
    {
        if (isset($request->id)) {
           return response(News::find($request->id),200);
        }
    }

    public function mainPage() : Response
    {
        return response(News::orderByDesc('id')->paginate(8),200);
    }

    public function topNews() : Response
    {
        return response(News::where('top','=',1)->orderByDesc('id')->paginate(16));
    }
}
