<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;

class PlaylistsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:playlist-list|playlist-create|playlist-edit|playlist-delete',
            ['only'=>['index','store']]
        );
        $this->middleware(
            'permission:playlist-create',
            ['only'=>['create', 'store']]
        );
        $this->middleware(
            'permission:playlist-edit',
            ['only'=>['update', 'edit']]
        );
        $this->middleware(
            'permission:playlist-delete',
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
        if(!auth()){
            return redirect()->route('/dashboard');
        }

        $user = auth()->user();
        $roleName = $user->getRoleNames()[0];
        if($roleName === "astronaut"){
            $playlists = Playlist::whereUserId($user->id)->orwhere('isPrivate','False')->get();
        }
        if($roleName === "manager"){
            $playlists = Playlist::whereUserId($user->id)->orwhere('isPrivate','False')->get();
        }
        if($roleName === "admin"){
            $playlists = Playlist::all();
        }
        return view('admin.playlists.index', compact('playlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Playlist $playlist)
    {
        $tracks = Track::all();
        return view('admin.playlists.create', compact(['playlist','tracks']));
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
                'name'=>['required','string','max:225'],
                'type'=>['in:True,False','required'],
                'tracks'=>['required'],
            ]
        );
        $playlist = Playlist::create([
                'name'=>$request->input('name'),
                'user_id'=>auth()->user()->id,
                'isPrivate'=>$request->input('type'),
            ]
        );
        $selectedTracks = $request->get('tracks');
        $playlist->tracks()->sync($selectedTracks);
        return redirect()->route('playlists.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        $tracks = $playlist->tracks;
        $trackCount = $tracks->count();
        return view('admin.playlists.show',compact(['playlist','trackCount']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        $user = auth()->user();
        $roleName = $user->getRoleNames()[0];
        if($roleName === "astronaut"){
            if($playlist->isPrivate === "False" & $playlist->user_id !== $user->id){
                return redirect(route('playlists.index'));
            }else{
                $tracks=Track::all();
                $users=User::all();
                return view('admin.playlists.update',compact(['playlist','tracks','users']));
            }
        }else{
            $tracks=Track::all();
            $users=User::all();
            return view('admin.playlists.update',compact(['playlist','tracks','users']));
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Playlist $playlist)
    {
        $request->validate(
            [
                'name'=>[
                    'required','string','max:225',
                ],
                'type'=>[
                    'in:True,False','required',
                ]
            ]
        );

        if($request->input('name')!==$playlist->name){
            $playlist->name = $request->input('name');
        }
        if($request->input('type')!==$playlist->isPrivate){
            $playlist->isPrivate = $request->input('type');
        }
        $checkboxes = $request->get('tracks');
        $playlist->tracks()->sync($checkboxes);
        $playlist->save();
        return redirect()->route('playlists.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Playlist $playlist)
    {
        $authUser = auth()->user();
        $roleName = $authUser->getRoleNames()[0];
        if($roleName === "astronaut"){
            if($playlist->user_id === $authUser->id){
                $playlist->delete();
            }else{
                return redirect(route('playlists.index'));
            }
        }else{
            $playlist->delete();
        }
        return redirect(route('playlists.index'));
    }
}
