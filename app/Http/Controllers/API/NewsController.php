<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
//List all news records
public function getNews(){
    return response()->json(News::get());
}

//Get a single news record
public function getNewsById($id){
    return response()->json(News::find($id));
}
}
