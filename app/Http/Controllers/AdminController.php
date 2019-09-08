<?php


namespace App\Http\Controllers;


use App\Halls;
use App\Movies;
use App\Projections;
use App\ProjectionSeats;
use App\Roles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AdminController  extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function allHals()
    {
        $halls = Halls::all();

        return view('admin.hall.all-hals', compact('halls'));
    }

    public function renderCreateHall()
    {
        return view('admin.hall.create-hall');
    }

    public function createHall(Request $request)
    {
        $hall = new Halls();
        $hall->hall_number = $request->hall_number;
        $hall->hall_description = $request->hall_description;
        $hall->seat_number = $request->seat_number;
        $hall->save();

        return back();
    }

    public function deleteHall($hallId)
    {

        $hall = Halls::find($hallId);

        $hall->delete();

        return back();
    }

    public function singleHall($hallId)
    {
        $hall = Halls::find($hallId);

        return view('admin.hall.single-hall', compact('hall'));
    }

    public function updateHall(Request $request, $hallId)
    {
        $hall = Halls::find($hallId);

        $hall->fill($request->all());
        $hall->save();

        return back();
    }

    public function allMovies()
    {

        $movies = Movies::all();

        return view('admin.movies.all-movies', compact('movies'));
    }

    public function renderCreateMovie()
    {
        return view('admin.movies.create-movie');
    }

    public function createMovie(Request $request)
    {
        if ($request->hasFile('movie_image')) {
            $image = Input::file('movie_image');
            $imageFileName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageFileName);
        }else {
            $imageFileName = 'noImage.jpg';
        }

        $movie = new Movies();
        $movie->movie_name = $request->movie_name;
        $movie->duration = $request->duration;
        $movie->release_year = $request->release_year;
        $movie->movie_image = $imageFileName;
        $movie->movie_description = $request->movie_description;
        $movie->save();

        return back();
    }

    public function deleteMovie($movieId) {
        $movie = Movies::find($movieId);
        $movie->delete();

        return back();
    }

    public function singleMovie($movieId) {
        $movie = Movies::find($movieId);

        return view('admin.movies.single-movie', compact('movie'));
    }

    public function updateMovie(Request $request, $movieId) {
        $movie = Movies::find($movieId);

        if ($request->hasFile('movie_image')) {
            $destinationPath = public_path('/images');
            $oldFile = $destinationPath."/".$movie->movie_image;
            File::delete($oldFile);

            $image = Input::file('movie_image');
            $imageFileName = time().'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageFileName);
        }else {
            $imageFilename = $movie->movie_image;

        }

        $movie->movie_name = $request->movie_name;
        $movie->duration = $request->duration;
        $movie->release_year = $request->release_year;
        $movie->movie_image = $imageFileName;
        $movie->movie_description = $request->movie_description;
        $movie->save();

        return back();
    }

    public function allProjections()
    {
        $projections = DB::table('projections')
                        ->join('movies', 'movies.id', '=', 'projections.movie_id')
                        ->join('halls', 'halls.id', '=', 'projections.hall_id')
                        ->select('projections.id', 'movies.movie_image', 'movies.movie_name', 'halls.hall_number',
                            'movies.duration', 'projections.start_date')
                        ->get();

        return view('admin.projections.all-projections', compact('projections'));
    }

    public function renderCreateProjection()
    {
        $movies = Movies::all();
        $halls = Halls::all();

        return view('admin.projections.create-projection', compact('movies','halls'));
    }

    public function createProjection(Request $request)
    {
        $projection = new Projections();

        $projection->fill($request->all());
        $projection->save();

        $hall = Halls::find($request->hall_id);
        $seatNumber = $hall->seat_number;

        for($i=1; $i<=$seatNumber; $i++) {
            $seat = new ProjectionSeats();
            $seat->seat_number = $i;
            $seat->avaliable = true;
            $seat->projection_id = $projection->id;
            $seat->save();
        }

        return back();
    }

    public function deleteProjection($projectionId)
    {
        $projection = Projections::find($projectionId);
        $projection->delete();

        ProjectionSeats::where('projection_id', $projectionId)->delete();

        return back();
    }

    public function allUsers()
    {
        $users = User::all();
        $roles = Roles::all();

        return view('admin.users.all-users', compact('users', 'roles'));
    }

    public function changeUserRole($userId, Request $request)
    {
        $user = User::find($userId);
        $user->role_id = $request->role_id;

        $user->save();

        return back();
    }

    public function allReservations()
    {
        $reservations = DB::table('projection_seats')
            ->join('users', 'users.id', '=', 'projection_seats.user_id')
            ->join('projections', 'projections.id', '=', 'projection_seats.projection_id')
            ->join('movies', 'movies.id', '=', 'projections.movie_id')
            ->join('halls', 'halls.id', '=', 'projections.hall_id')
            ->select('projection_seats.id', 'movies.movie_image', 'movies.movie_name', 'halls.hall_number',
                'movies.duration', 'projections.start_date', 'users.name', 'users.email')
            ->where('projection_seats.avaliable', '=', 0)
            ->get();

        return view('admin.reservations.all-reservations', compact('reservations'));
    }

    public function deleteReservations($reservationSeatId)
    {
        $projectionSeat = ProjectionSeats::find($reservationSeatId);
        $projectionSeat->avaliable = true;
        $projectionSeat->user_id = 0;
        $projectionSeat->save();

        return back()->with('status','Rezervacija uspješno poništena');
    }
}
