<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Track') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{route('tracks.store')}}" method="post">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>Fields required to be fill.</li>
                                    @endforeach
                                </ul>
                                @if ($errors->has('artist'))
                                @endif
                                @if ($errors->has('album'))
                                @endif
                                @if ($errors->has('genre'))
                                @endif
                                @if ($errors->has('name'))
                                @endif
                                @if ($errors->has('length'))
                                @endif
                                @if ($errors->has('year'))
                                @endif
                            </div>
                        @endif
                        <div class="form-control">
                            <label class="label" for="artist">
                                <span class="label-text">Artist</span>
                            </label>
                            <input type="text"
                                   name="artist" id="artist"
                                   placeholder="Artist" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label class="label" for="album">
                                <span class="label-text">Album</span>
                            </label>
                            <input type="text"
                                   name="album" id="album"
                                   placeholder="Album" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label class="label" for="genre">
                                <span class="label-text">Genre</span>
                            </label>
                            <input type="text"
                                   name="genre" id="genre"
                                   placeholder="Genre" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label class="label" for="name">
                                <span class="label-text">Name</span>
                            </label>
                            <input type="text"
                                   name="name" id="name"
                                   placeholder="Name" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label class="label" for="length">
                                <span class="label-text">Length</span>
                            </label>
                            <input type="text"
                                   name="length" id="length"
                                   placeholder="Length" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label class="label" for="year">
                                <span class="label-text">Year</span>
                            </label>
                            <input type="number"
                                   min="1000"
                                   name="year" id="year"
                                   placeholder="Year" class="input input-bordered">
                        </div>
                        <div class="py-6">
                            <button class="btn btn-sm btn-primary text-gray-50"
                                    type="submit">Save New Track
                            </button>
                            <a class="btn btn-sm btn-primary text-gray-50"
                               href="{{ route('tracks.index') }}">
                                Back to Tracks
                            </a>
                            <button class="btn btn-sm btn-accent" type="reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
