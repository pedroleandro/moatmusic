@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Permissions</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a class="text-success" href="{{ route('permission.create') }}">&plus; Register New Permission</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <table class="table table-striped mt-4">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Permission</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td class="d-flex">
                                        <a class="mr-3 btn btn-sm btn-outline-success"
                                           href="{{ route('permission.edit', ['permission' => $permission->id]) }}">Edit</a>
                                        <form
                                            action="{{ route('permission.destroy', ['permission' => $permission->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <input class="btn btn-sm btn-outline-danger" type="submit" value="Remove">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
