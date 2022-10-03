@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('role.index') }}">&leftarrow; Back to listing</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <h2 class="mt-4">Permissions for: {{ $role->name }}</h2>

                        <form action="{{ route('role.permissions.sync', ['role' => $role->id]) }}" method="post"
                              class="mt-4" autocomplete="off">
                            @csrf
                            @method('PUT')

                            @foreach($permissions as $permission)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="{{ $permission->id }}"
                                           name="{{ $permission->id }}" {{ ($permission->can == '1' ? 'checked' : '') }}>
                                    <label class="custom-control-label"
                                           for="{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-block btn-success mt-4">Sync Profile</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
