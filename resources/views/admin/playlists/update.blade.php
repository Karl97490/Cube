<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Playlist') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <form action="{{route('playlists.update',$playlist->id)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mt-2 form-control">
                                <label for="name" class="label">
                                    <span class="label-text">Name</span>
                                </label>
                                <input type="text" id="name"
                                       name="name" placeholder="Name" class="input-bordered"
                                       value="{{old('name')??$playlist->name}}">
                            </div>

                            <div class="mt-4">
                                <span class="label-text">Type</span>
                                <div class="mt-2">
                                    <label class="inline-flex items-center" for="public">
                                        <input type="radio"
                                               name="type" id="public"
                                               value="False"
                                               class="form-radio" @if($playlist->isPrivate == "False") checked @endif>
                                        <span class="ml-2">Public</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6" for="private">
                                        <input type="radio"
                                               name="type" id="private"
                                               value="True"
                                               class="form-radio" @if($playlist->isPrivate == "True") checked @endif>
                                        <span class="ml-2">Private</span>
                                    </label>
                                </div>
                                <table class="table w-full table-zebra">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Artist</th>
                                        <th>Name</th>
                                        <th>Length</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tracks as $key=>$track)
                                        <tr class="hover">
                                            <td class="small">{{ $key+1 }}</td>
                                            <td>{{ $track->artist }}</td>
                                            <td>{{ $track->name }}</td>
                                            <td>{{ $track->length }}</td>
                                            <td><input type="checkbox" name="tracks[]" class="form-checkbox"
                                                       value="{{$track->id}}" @if($playlist->tracks->contains('id',$track->id)) checked @endif></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </form>
                        <div class="py-6">
                            <button class="btn btn-sm btn-primary text-gray-50"
                                    type="submit">Save New Playlist
                            </button>
                            <a class="btn btn-sm btn-primary text-gray-50"
                               href="{{ route('playlists.index') }}">
                                Back to Playlists
                            </a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
