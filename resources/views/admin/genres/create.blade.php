<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('genres.store')}}" method="post">
                        @csrf
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
                                   placeholder="Name" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label class="label" for="parent">
                                <span class="label-text">Parent</span>
                            </label>
                            <input type="number"
                                   name="parent" id="parent"
                                   placeholder="Parent" class="input input-bordered">
                        </div>
                        <div class="py-6">
                            <button class="btn btn-sm btn-primary text-gray-50"
                                    type="submit">Save New Genre
                            </button>
                            <a class="btn btn-sm btn-primary text-gray-50"
                               href="{{ route('users.index') }}">
                                Back to Genres
                            </a>
                            <button class="btn btn-sm btn-accent" type="reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
