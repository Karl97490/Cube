<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class GenreController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:genre-list|genre-create|genre-edit|genre-delete',
            ['only'=>['index','store']]
        );
        $this->middleware(
            'permission:genre-create',
            ['only'=>['create', 'store']]
        );
        $this->middleware(
            'permission:genre-edit',
            ['only'=>['update', 'edit']]
        );
        $this->middleware(
            'permission:genre-delete',
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
        $genres = Genre::all();
        return view('admin.genres.index',compact(['genres']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Genre $genre)
    {
        return view('admin.genres.create', compact('genre'));
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
                'name'=>[
                    'required','string','max:225',
                ],
            ]
        );
        Genre::create([
            'name'=>$request->input('name'),
            'parent'=>$request->input('parent'),
        ]);
        return redirect(route('genres.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return view('admin.genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view('admin.genres.update', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate(
            [
                'name'=>[
                    'required','string','max:225',
                ],
            ]
        );
        if($request->input('name') !== $genre->name){
            $genre->name = $request->input('name');
        }
        if($request->input('parent') !== $genre->parent){
            $genre->parent = $request->input('parent');
        }
        $genre->save();
        return redirect(route('genres.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect(route('genres.index'));
    }
}
