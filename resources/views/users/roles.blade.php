@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('user.index') }}">&leftarrow; Back to listing</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <h2 class="mt-4">Permissions for: {{ $user->name }}</h2>

                        <form action="{{ route('user.roles.sync', ['user' => $user->id]) }}" method="post"
                              class="mt-4" autocomplete="off">
                            @csrf
                            @method('PUT')

                            @foreach($roles as $role)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="{{ $role->id }}"
                                           name="{{ $role->id }}" {{ ($role->can == '1' ? 'checked' : '') }}>
                                    <label class="custom-control-label"
                                           for="{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-block btn-success mt-4">Sync User</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
