<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WatchLater;

class WatchLaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        WatchLater::create([
            'user_id' => $request['user_id'],
            'movie_id' => $request['movie_id'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $myMovies = WatchLater::where('user_id','=',$id)->get();
        return $myMovies;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $WatchLater = WatchLater::where('movie_id','=',$id);
        $WatchLater->delete();
    }
    
    public function watchLater($id, $movie_id)
    {
        $WatchLater = WatchLater::where('user_id','=',$id)
                    ->where('movie_id','=',$movie_id)
                    ->get();
        return $WatchLater;
    }
}
