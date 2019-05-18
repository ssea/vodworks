<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::get();
        return view('dashboard.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'picture' => 'required|mimes:jpg,jpeg,png',
            'title' => 'required',
            'status' => 'required|numeric',
        ]);

        $input = $request->all();

        $news = News::create($input);

        if ($request->file('picture') != null) {
            // Saving Filename
            $name = time().'.jpg';
            $file = $request->file('picture');
            $image_512 = Image::make($file->getRealPath());
            $image_512->resize(512, 'auto', function ($c) {
                $c->aspectRatio();
                $c->upsize();
            })->save('storage/news/512/'.$name);

            $image_256 = Image::make($file->getRealPath());
            $image_256->resize(256, 'auto', function ($c) {
                $c->aspectRatio();
                $c->upsize();
            })->save('storage/news/256/'.$name);

            $input['picture'] = $name;
        }

        $news->fill($input)->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $res = News::where('id', $news->id)->delete();
        return redirect('/');
    }
}
