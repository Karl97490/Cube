<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PLAYLISTS') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="table w-full table-zebra">
                            <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>Type</th>
                                <th class="flex justify-between">
                                    <span class="pt-2">Actions</span>
                                    <a href="{{ route('playlists.create') }}"
                                       class="btn btn-sm btn-primary text-gray-50">
                                        Add Playlist
                                    </a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($playlists as $key=>$playlist)
                                <tr class="hover">
                                    <td class="small">{{ $key+1 }}</td>
                                    <td>{{ $playlist->id }}</td>
                                    <td>{{ $playlist->name }}</td>
                                    <td>{{ $playlist->user->name}}</td>
                                    @if( $playlist-> isPrivate == "False")
                                        <td>Public</td>
                                    @else
                                        <td>Private</td>
                                    @endif
                                    <td><a href="{{ url('/admin/playlists/'.$playlist->id) }}"
                                           class="btn btn-sm btn-primary text-gray-50">Details</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
