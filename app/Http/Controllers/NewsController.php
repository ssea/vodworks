<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1NmJhYTc2ZWQwYjZmYjMzY2FkMzMwYmQ3ZGMzOTBkZTJlMWE1ZTUyNTY2MmM4Y2Q4ZGM3NDhkMzY3ZWFmNDAxNjMxYzRhYTUwMDczNDEyIn0.eyJhdWQiOiIyIiwianRpIjoiZjU2YmFhNzZlZDBiNmZiMzNjYWQzMzBiZDdkYzM5MGRlMmUxYTVlNTI1NjYyYzhjZDhkYzc0OGQzNjdlYWY0MDE2MzFjNGFhNTAwNzM0MTIiLCJpYXQiOjE1NTgxNTc1MjIsIm5iZiI6MTU1ODE1NzUyMiwiZXhwIjoxNTg5Nzc5OTIyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.JUk5krQFQf7W6tby5qDNE6Go1Bk3gE0zkZ2yotZfQt6wz4cFnDf9pdTVtp5Su5B1Pq5ozRk408melDvKQG_p5pYZenZaCtnLv7LHEpcMDnhtloCDlmCbowgTFcbR25PUWE68fru0gD4Qx9yxdGTLCRzXFrxpWo1J6ULygxIDzScM7vc3nu_1806BGY_1YhvWO-JytdyRt6XDQtHqOP6QDQ4HXkT0-Bsyx72Iz6Ce71NeY6HbJGoCD716eT_TI1oGmM3CdteTEsBcR0B477KcfYdkgxvw-5uqM2G9_u9wEeZ_QC6BMU0nTpOtFByFaJSdZVunnLWwMY1E5mwg0PGWJOgmCpeBkhcISSYopN5F5NJu4atnUhR0pz_6o3v7JjHoNOmxZadPRSVTPRxL3BQjoO6WUJ2ZdN39iZJ9LMnwHHN70MqiE7HhzWrQBoB47cE-sHfHYvZ9H-54OZuK_p2wXcm6zE2xt3FkQ2OZeefcxVrbHFsQx2v3-M5UVkzd5-dMIBysudlFQzcAGIjTqX4dpKc9EoiAcK-kcz4JoBjp1UrFm_9mvN2QYDBAsDVVWfYd5fttGIML_4IA3A-mzQejDABc_dVUwyfQvJy4u3TQC8G1EzHHSAoPqkvAfZ6_MCg9W3nFnNKJnYgGAfalTyLxTI5Br6Ozd561hst6vAdiY6A';
        $client = new Client();

        $Req = $client->get('http://vodworks.test//api/news/', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ]
        ]);
        $response = $Req->getBody()->getContents();
        $news = json_decode($response);

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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1NmJhYTc2ZWQwYjZmYjMzY2FkMzMwYmQ3ZGMzOTBkZTJlMWE1ZTUyNTY2MmM4Y2Q4ZGM3NDhkMzY3ZWFmNDAxNjMxYzRhYTUwMDczNDEyIn0.eyJhdWQiOiIyIiwianRpIjoiZjU2YmFhNzZlZDBiNmZiMzNjYWQzMzBiZDdkYzM5MGRlMmUxYTVlNTI1NjYyYzhjZDhkYzc0OGQzNjdlYWY0MDE2MzFjNGFhNTAwNzM0MTIiLCJpYXQiOjE1NTgxNTc1MjIsIm5iZiI6MTU1ODE1NzUyMiwiZXhwIjoxNTg5Nzc5OTIyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.JUk5krQFQf7W6tby5qDNE6Go1Bk3gE0zkZ2yotZfQt6wz4cFnDf9pdTVtp5Su5B1Pq5ozRk408melDvKQG_p5pYZenZaCtnLv7LHEpcMDnhtloCDlmCbowgTFcbR25PUWE68fru0gD4Qx9yxdGTLCRzXFrxpWo1J6ULygxIDzScM7vc3nu_1806BGY_1YhvWO-JytdyRt6XDQtHqOP6QDQ4HXkT0-Bsyx72Iz6Ce71NeY6HbJGoCD716eT_TI1oGmM3CdteTEsBcR0B477KcfYdkgxvw-5uqM2G9_u9wEeZ_QC6BMU0nTpOtFByFaJSdZVunnLWwMY1E5mwg0PGWJOgmCpeBkhcISSYopN5F5NJu4atnUhR0pz_6o3v7JjHoNOmxZadPRSVTPRxL3BQjoO6WUJ2ZdN39iZJ9LMnwHHN70MqiE7HhzWrQBoB47cE-sHfHYvZ9H-54OZuK_p2wXcm6zE2xt3FkQ2OZeefcxVrbHFsQx2v3-M5UVkzd5-dMIBysudlFQzcAGIjTqX4dpKc9EoiAcK-kcz4JoBjp1UrFm_9mvN2QYDBAsDVVWfYd5fttGIML_4IA3A-mzQejDABc_dVUwyfQvJy4u3TQC8G1EzHHSAoPqkvAfZ6_MCg9W3nFnNKJnYgGAfalTyLxTI5Br6Ozd561hst6vAdiY6A';
        $client = new Client();

        $Req = $client->get('http://vodworks.test//api/news/'.$news->id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ]
        ]);
        $response = $Req->getBody()->getContents();

        $news = json_decode($response);


        return view('news.detail', compact('news'));
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
