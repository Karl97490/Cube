<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Playlist Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <dl class="grid grid-cols-6 gap-2">
                        <dt class="col-span-1">ID</dt>
                        <dd class="col-span-5">{{ $playlist->id }}</dd>
                        <dt class="col-span-1">Name</dt>
                        <dd class="col-span-5">{{ $playlist->name }}</dd>
                        <dt class="col-span-1">Owner</dt>
                        <dd class="col-span-5">{{ $playlist->user->name}}</dd>
                        <dt class="col-span-1">Track</dt>
                        <dd class="col-span-5">{{ $trackCount }}</dd>
                        <dt class="col-span-1">Type</dt>
                        @if($playlist->isPrivate == 0)
                            <dd class="col-span-5">Public</dd>
                        @else
                            <dd class="col-span-5">Private</dd>
                        @endif


                        <dd class="col-span-5">
                            <form
                                action="{{ route('playlists.destroy',['playlist'=>$playlist]) }}"
                                method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('playlists.edit', ['playlist'=>$playlist->id]) }}"
                                   class="btn btn-sm btn-primary text-gray-50">Update</a>
                                <button class="btn btn-sm btn-secondary text-gray-50">
                                    Delete
                                </button>
                            </form>
                        </dd>
                    </dl>
                    <p class="pt-6">
                        <a href="{{ url('/admin/playlists') }}"
                           class="btn btn-sm btn-accent">Back to Playlists</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
