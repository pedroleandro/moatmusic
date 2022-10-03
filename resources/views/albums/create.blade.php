@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('album.index') }}">&leftarrow; Back to listing</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('album.store') }}" method="post" class="mt-4" autocomplete="off">
                            @csrf

                            <div class="form-group">
                                <label for="artist">Artist</label>
                                <select name="artist" id="artist" class="form-control">
                                    <option value="no artist">Select an artist</option>
                                    @foreach($artists as $artist)
                                        <option value={{ $artist['name'] }}>{{ $artist['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title"
                                       placeholder="Enter album title"
                                       name="title" value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="title">Year</label>
                                <input type="number" class="form-control" id="year"
                                       placeholder="Enter the year of the album"
                                       name="year" value="{{ old('year') }}">
                            </div>

                            <button type="submit" class="btn btn-block btn-success">Register Album</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
