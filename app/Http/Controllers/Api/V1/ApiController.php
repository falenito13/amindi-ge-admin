<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function allNews()
    {
        return response(News::paginate(16),200);
    }

    public function news(Request $request)
    {
        if (isset($request->id)) {
           return response(News::find($request->id),200);
        }
    }
}
