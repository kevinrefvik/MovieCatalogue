<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Movie;
use App\Format;
use App\Category;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($sort = null)
    {
        if($sort == 'category') {
            $movies = Movie::orderBy('category_id')->get();

            $movies = $movies->sortBy(function($movie) {
                return $movie->category->name . $movie->title;
            });
        } elseif ($sort == 'format') {
            $movies = Movie::orderBy('format')->orderBy('title')->get();
        } else {
            $movies = Movie::orderBy('title')->get();
        }

        $with['movies'] = $movies;
        $with['formats'] = Format::all();
        $with['categories'] = Category::all();

        return \View::make('movie.list')->with($with);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $movie = new Movie;
        $movie->title = $request->title;
        $movie->secondary_title = $request->secondary_title;
        $movie->favourite = $request->input('favourite', 0);
        $movie->watched = $request->input('watched', 0);
        $movie->format_id = $request->format;
        $movie->category_id = $request->category;
        $movie->save();

        return redirect('movie');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
