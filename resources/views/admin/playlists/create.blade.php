
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Playlist') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('playlists.store', $playlist->id)}}" method="post">
                        @csrf
                        <div class="form-control">
                            <label class="label" for="name">
                                <span class="label-text">Name</span>
                            </label>
                            <input type="text"
                                   name="name" id="name"
                                   placeholder="Name" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label for="tracks" class="label">
                                <span class="label-text">Choose tracks</span>
                            </label>
                            <select name="tracks[]" class="form-select block w-full mt-1" multiple>
                                @foreach($tracks as $track)
                                    <option value="{{$track->id}}">{{$track->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <span class="label-text">Type</span>
                            <div class="mt-2">
                                <label class="inline-flex items-center" for="public">
                                    <input type="radio"
                                           name="type" id="public"
                                           value="False"
                                           class="form-radio">
                                    <span class="ml-2">Public</span>
                                </label>
                                <label class="inline-flex items-center ml-6" for="private">
                                    <input type="radio"
                                           name="type" id="private"
                                           value="True"
                                           class="form-radio">
                                    <span class="ml-2">Private</span>
                                </label>
                            </div>
                        </div>
                        <div class="py-6">
                            <button class="btn btn-sm btn-primary text-gray-50"
                                    type="submit">Save New Playlist
                            </button>
                            <a class="btn btn-sm btn-primary text-gray-50"
                               href="{{ route('playlists.index') }}">
                                Back to Playlists
                            </a>
                            <button class="btn btn-sm btn-accent" type="reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
