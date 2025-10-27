<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;

class TracksController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:track-list|track-create|track-edit|track-delete',
            ['only'=>['index','store']]
        );
        $this->middleware(
            'permission:track-create',
            ['only'=>['create', 'store']]
        );
        $this->middleware(
            'permission:track-edit',
            ['only'=>['update', 'edit']]
        );
        $this->middleware(
            'permission:track-delete',
            ['only'=>['delete', 'destroy']]
        );
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::all();
        return view('admin.tracks.index', compact(['tracks']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Track $track)
    {
        return view('admin.tracks.create', compact('track'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'artist'=>[
                    'required','string','max:225',
                ],
                'album'=>[
                    'required','string','max:225',
                ],
                'genre'=>[
                    'required','string','max:225',
                ],
                'name'=>[
                    'required','string','max:225',
                ],
                'length'=>[
                    'required',
                ],
                'year'=>[
                    'required',
                ],
            ]
        );

        Track::create([
            'artist'=>$request->input('artist'),
            'album'=>$request->input('album'),
            'genre'=>$request->input('genre'),
            'name'=>$request->input('name'),
            'length'=>$request->input('length'),
            'year'=>$request->input('year'),
        ]);
        return redirect(route('tracks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Track $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        return view('admin.tracks.show', compact('track'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Track $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        return view('admin.tracks.update', compact('track'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        $request->validate(
            [
                'artist'=>[
                    'required','string','max:225',
                ],
                'album'=>[
                    'required','string','max:225',
                ],
                'genre'=>[
                    'required','string','max:225',
                ],
                'name'=>[
                    'required','string','max:225',
                ],
                'length'=>[
                    'required',
                ],
                'year'=>[
                    'required',
                ],
            ]
        );



        if($request->input('artist')!==$track->artist){
            $track->artist = $request->input('artist');
        }
        if($request->input('album')!==$track->album){
            $track->album = $request->input('album');
        }
        if($request->input('genre')!==$track->genre){
            $track->genre = $request->input('genre');
        }
        if($request->input('name')!==$track->name){
            $track->name = $request->input('name');
        }
        if($request->input('length')!==$track->length){
            $track->length = $request->input('length');
        }
        if($request->input('year')!==$track->year){
            $track->year = $request->input('year');
        }
        $track->save();

        return redirect(route('tracks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Track $track
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        $track->delete();
        return redirect(route('tracks.index'));
    }
}
