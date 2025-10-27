<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('genres.update',$genre->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                @if ($errors->has('name'))
                                @endif
                                @if ($errors->has('parent'))
                                @endif
                            </div>
                        @endif
                        <div class="form-control">
                            <label class="label" for="name">
                                <span class="label-text">Name</span>
                            </label>
                            <input type="text"
                                   name="name" id="name"
                                   placeholder="Username" class="input input-bordered"
                                   value="{{old('name') ?? $genre->name}}">
                        </div>
                        <div class="form-control">
                            <label class="label" for="parent">
                                <span class="label-text">Parent</span>
                            </label>
                            <input type="number"
                                   name="parent" id="parent"
                                   placeholder="Parent" class="input input-bordered"
                                   value="{{old('parent') ?? $genre->parent}}">
                        </div>
                        <div class="py-6">
                            <button class="btn btn-sm btn-primary text-gray-50"
                                    type="submit">Save New Genre
                            </button>
                            <a class="btn btn-sm btn-primary text-gray-50"
                               href="{{ route('genres.index') }}">
                                Back to Genres
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
