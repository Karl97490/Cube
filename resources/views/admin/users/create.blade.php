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
                    <form action="{{route('users.store')}}" method="post">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                @if ($errors->has('username'))
                                @endif
                                @if ($errors->has('email'))
                                @endif
                                @if ($errors->has('password'))
                                @endif
                            </div>
                        @endif
                        <div class="form-control">
                            <label class="label" for="username">
                                <span class="label-text">Username</span>
                            </label>
                            <input type="text"
                                   name="username" id="username"
                                   placeholder="Username" class="input input-bordered"
                                   value="{{old('name')}}">
                        </div>
                        <div class="form-control">
                            <label class="label" for="email">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="text"
                                   name="email" id="email"
                                   placeholder="Email" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label class="label" for="password">
                                <span class="label-text">Password</span>
                            </label>
                            <input type="password"
                                   name="password" id="password"
                                   placeholder="Password" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label class="label" for="confirm_password">
                                <span class="label-text">Confirm Password</span>
                            </label>
                            <input type="password"
                                   name="confirm_password" id="confirm_password"
                                   placeholder="Confirm Password" class="input input-bordered">
                        </div>
                        <div class="py-6">
                            <button class="btn btn-sm btn-primary text-gray-50"
                                    type="submit">Save New User
                            </button>
                            <a class="btn btn-sm btn-primary text-gray-50"
                               href="{{ route('users.index') }}">
                                Back to Users
                            </a>
                            <button class="btn btn-sm btn-accent" type="reset">Reset</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
