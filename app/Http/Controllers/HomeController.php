<?php

namespace App\Http\Controllers;

use App\Movies;
use App\ProjectionSeats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projections = DB::table('projections')
            ->join('movies', 'movies.id', '=', 'projections.movie_id')
            ->join('halls', 'halls.id', '=', 'projections.hall_id')
            ->select('projections.id', 'movies.movie_image', 'movies.movie_name', 'halls.hall_number',
                'movies.duration', 'projections.start_date')
            ->take(3)
            ->get();

        return view('home', compact('projections'));
    }

    public function allProjections()
    {
        $projections = DB::table('projections')
            ->join('movies', 'movies.id', '=', 'projections.movie_id')
            ->join('halls', 'halls.id', '=', 'projections.hall_id')
            ->select('projections.id', 'movies.movie_image', 'movies.movie_name', 'halls.hall_number',
                'movies.duration', 'projections.start_date', 'movies.movie_description')
            ->get();

        return view('all-movies', compact('projections'));
    }

    public function singleProjection($projectionId)
    {
        $projectionSeats = ProjectionSeats::where('projection_id',$projectionId)->get();

        return view('single-projection', compact('projectionSeats'));
    }

    public function reserveSeat($projectionSeatId)
    {
        $projectionSeat = ProjectionSeats::find($projectionSeatId);
        $projectionSeat->avaliable = false;
        $projectionSeat->user_id = Auth::id();
        $projectionSeat->save();

        return back()->with('status', 'Uspješno rezervirano');
    }
}
